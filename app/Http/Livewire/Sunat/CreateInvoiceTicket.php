<?php

namespace App\Http\Livewire\Sunat;

use App\Http\Requests\RequestComprobant;
use App\Models\Company;
use App\Models\Comprobant;
use App\Models\Concept;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sunat;
use App\Services\ProductService;
use App\Traits\WithFacturaSunat;
use Carbon\Carbon;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Luecano\NumeroALetras\NumeroALetras;

class CreateInvoiceTicket extends Component
{
    use WithFacturaSunat;

    public $typescpe,
        $typescurrency,
        $typespayments,
        $company,
        $sunat,
        $customers,
        $customer,
        $selectCustomer,
        $json = [],
        $searchProductService = '',
        $concepts = [],
        $products = [],
        $cart = [],
        $total,
        $totalOG = 0,
        $totalOE = 0,
        $totaligvgrav = 0;

    public Comprobant $comprobant;

    public function mount()
    {
        $this->sunat = Sunat::first();
        $this->company = Company::first();
        $this->comprobant = $this->makeBlankFields();
        $this->typescurrency = Comprobant::TYPE_CURRENCY;
        $this->typespayments = Comprobant::TYPE_PAYMENTS;
        $this->typescpe = Comprobant::TYPE_CPE;
        $this->customers = Customer::pluck('name', 'id');
    }

    public function serieComprobant($lenght, $letter = '')
    {
        $num_serie = str_pad(1, $lenght, '0', STR_PAD_LEFT);
        return $letter . '' . $num_serie;
    }

    public function countComprobant($lenght, $type_cc)
    {
        $cc = Comprobant::where('tipoDoc', $type_cc)->count();
        $num_serie = str_pad($cc + 1, $lenght, '0', STR_PAD_LEFT);
        return $num_serie;
    }

    public function makeBlankFields()
    {
        return Comprobant::make(['fechaEmision' => Carbon::now()->format('d-m-Y'), 'moneda' => 'PEN', 'tipoPago' => 'Contado']); /*para dejar v acios los inpust*/
    }

    public function rules(): array
    {
        return (new RequestComprobant())->rules();
    }
   
    public function messages(): array
    {
        return (new RequestComprobant())->messages();
    }

    public function updatedSelectCustomer($value)
    {
        $this->customer = $value > 0 ? Customer::find($value) : [];
    }

    public function updatedComprobantTipoDoc($value)
    {
        $value == '01' ? ($this->comprobant->serie = $this->serieComprobant(3, 'F')) : ($this->comprobant->serie = $this->serieComprobant(3, 'B'));
        $value == '01' ? ($this->comprobant->correlativo = $this->countComprobant(4, '01')) : ($this->comprobant->correlativo = $this->countComprobant(4, '03'));
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->customer->phone)->getTotal();
        $this->calculeTotal();
    }

    public function addConcept(Concept $concept, $porcentIgv = 0, $typeAfectIgv = 20)
    {
        $service_added = Cart::session($this->customer->phone)->get(intval($concept->code));

        if ($service_added) {
            $this->updateQuantityCart($concept->code, $service_added->quantity + 1);
        } else {
            Cart::session($this->customer->phone)->add(intval($concept->code), $concept->name, 0, 1, ['porcentIgv' => $porcentIgv, 'typeAfectIgv' => $typeAfectIgv]);
        }
        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Servicio agregado');
    }

    public function addProduct(Product $product, $porcentIgv = 0, $typeAfectIgv = 20)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }
        if ($product->stock <= 0) {
            $this->emit('error_alert', 'Este producto no tiene suficiente stock');
            return;
        }
        $item_added = Cart::session($this->customer->phone)->get(intval($product->code));
        if ($item_added) {
            $this->updateQuantityCart($product->code, $item_added->quantity + 1);
        } else {
            Cart::session($this->customer->phone)->add(intval($product->code), $product->name, $product->sale_price, 1, ['porcentIgv' => $porcentIgv, 'typeAfectIgv' => $typeAfectIgv]);
        }
        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado');
    }

    public function updateQuantityCart($id, $cant)
    {
        if (strlen($id) > 4) {
            $product = (new ProductService())->productByCode($id);
            if ($cant > $product->stock) {
                $this->emit('error_alert', 'No hay suficiente stock para este producto');
                return;
            }
        }
        $code = intval($id);
        $item = Cart::session($this->customer->phone)->get($code);
        if ($cant > 0) {
            $this->removeItem($code);
            Cart::session($this->customer->phone)->add($code, $item->name, $item->price, $cant, ['porcentIgv' => $item->attributes['porcentIgv'], 'typeAfectIgv' => $item->attributes['typeAfectIgv']]);
        } else {
            $this->removeItem($code);
        }
        $this->updateCartOptions();
    }

    public function updatePriceCart($id, $price = 0)
    {
        $code = intval($id);
        if ($price > 0) {
            Cart::session($this->customer->phone)->update(intval($code), ['price' => $price]);
        } else {
            Cart::session($this->customer->phone)->update(intval($code), ['price' => 0]);
        }
        $this->updateCartOptions();
    }

    public function updateAfectIgvCart($id, $af)
    {
        $code = intval($id);
        if ($af == 20) {
            $typeAfectIgv = 10;
            $porcentIgv = 18;
        }

        if ($af == 10) {
            $typeAfectIgv = 20;
            $porcentIgv = 0;
        }
        Cart::session($this->customer->phone)->update($code, ['attributes' => ['typeAfectIgv' => $typeAfectIgv, 'porcentIgv' => $porcentIgv]]);
        $this->updateCartOptions();
    }

    public function calculeTotal()
    {
        $this->totalOE = 0;
        $this->totalOG = 0;
        $this->totaligvgrav = 0;

        $this->cart = Cart::session($this->customer->phone)->getContent();

        $afectGravada = $this->cart->filter(function ($i) {
            return $i->attributes['typeAfectIgv'] === 10;
        });

        $afectExonerada = $this->cart->filter(function ($i) {
            return $i->attributes['typeAfectIgv'] === 20;
        });

        foreach ($afectExonerada as $ae) {
            $this->totalOE += $ae->price * $ae->quantity;
        }

        foreach ($afectGravada as $ag) {
            $this->totalOG += $ag->price * $ag->quantity;
            $this->totaligvgrav += $ag->price * $ag->quantity * 0.18;
        }
    }

    public function removeItem($id)
    {
        Cart::session($this->customer->phone)->remove($id);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->customer->phone)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de servicios y productos eliminados');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages());
    }

    public function save()
    {
        if (!$this->customer) {
            return $this->emit('info_alert', 'Debe seleccionar un cliente');
        }
        if (\collect($this->cart)->count() == 0) {
            return $this->emit('info_alert', 'Selecciona uno o más servicios y/o repuestos');
        }
        $products = [];
        $this->calculeTotal();
        foreach ($this->cart as $item) {
            array_push($products, [
                'codProducto' => $item->id,
                'unidad' => 'NIU',
                'descripcion' => $item->name,
                'cantidad' => $item->quantity,
                'mtoValorUnitario' => $item->price,
                'mtoValorVenta' => $item->quantity * $item->price, //cantidad*mtoValorUnitario
                'mtoBaseIgv' => $item->quantity * $item->price, //cantidad*mtoValorUnitario
                'porcentajeIgv' => $item->attributes['porcentIgv'],
                'igv' => $item->quantity * $item->price * ($item->attributes['porcentIgv'] / 100), //mtoValorVenta*(porcentajeIgv/100)
                'tipAfeIgv' => $item->attributes['typeAfectIgv'], //gravada
                'totalImpuestos' => $item->quantity * $item->price * ($item->attributes['porcentIgv'] / 100), //mtoValorVenta*(porcentajeIgv/100)
                'mtoPrecioUnitario' => $item->price * (1 + $item->attributes['porcentIgv'] / 100), //mtoValorUnitario*(1+(porcentajeIgv/100)
            ]);
        }

        // dd($products);

        $this->json = [
            'ublVersion' => '2.1',
            'fecVencimiento' => date(Carbon::parse($this->comprobant->fechaEmision)->format('Y-m-d') . '\TH:i:sP'),
            'tipoOperacion' => '0101',
            'tipoDoc' => $this->comprobant->tipoDoc,
            'serie' => $this->comprobant->serie,
            'correlativo' => $this->comprobant->correlativo,
            'fechaEmision' => date(Carbon::parse($this->comprobant->fechaEmision)->format('Y-m-d') . '\TH:i:sP'),
            'formaPago' => [
                'moneda' => $this->comprobant->moneda,
                'tipo' => $this->comprobant->tipoPago,
            ],
            'tipoMoneda' => $this->comprobant->moneda,
            'client' => [
                'tipoDoc' => '6',
                'numDoc' => $this->customer->num_doc,
                'rznSocial' => $this->customer->name,
                'address' => [
                    'direccion' => $this->customer->address,
                    'provincia' => '',
                    'departamento' => '',
                    'distrito' => '',
                    'ubigueo' => '',
                ],
            ],
            'company' => [
                'ruc' => $this->sunat->ruc,
                'razonSocial' => $this->sunat->social_reason,
                'nombreComercial' => $this->company->name,
                'address' => [
                    'direccion' => $this->sunat->address,
                    'provincia' => $this->company->province,
                    'departamento' => $this->company->department,
                    'distrito' => $this->company->district,
                    'ubigueo' => $this->company->ubigeous,
                ],
            ],
            'mtoOperGravadas' => $this->totalOG, //sumatoria de los mtoValorVenta de los items gravados
            'mtoOperExoneradas' => $this->totalOE, //sumatoria de los mtoValorVenta de los items exonerados
            'mtoIGV' => $this->totaligvgrav, //sumatoria de los igv de los items gravados
            'totalImpuestos' => $this->totaligvgrav, //sumatoria de los igv de los items gravados
            'valorVenta' => $this->total, //sumatoria de los mtoValorVenta de los items gravados y exonerados
            'subTotal' => $this->total + $this->totaligvgrav, //sumatoria de los mtoValorVenta de los items gravados y exonerados + sumatoria de los igv de los items gravados
            'mtoImpVenta' => $this->total + $this->totaligvgrav, //sumatoria de los mtoValorVenta de los items gravados y exonerados + sumatoria de los igv de los items gravados
            'details' => $products,
            'legends' => [
                0 => [
                    'code' => '1000',
                    'value' => (new NumeroALetras())->toInvoice($this->total + $this->totaligvgrav, 2, 'soles'),
                ],
            ],
        ];

        if ($this->sendComprobant($this->json)) {
            $this->emit('success_alert', 'Factura validada correctamente');
            $this->comprobant->cliente = json_encode([
                'tipoDoc' => '6',
                'numDoc' => $this->customer->num_doc,
                'rznSocial' => $this->customer->name,
                'address' => [
                    'direccion' => $this->customer->address,
                    'provincia' => '',
                    'departamento' => '',
                    'distrito' => '',
                    'ubigueo' => '',
                ],
            ]);

            $this->comprobant->empresa = json_encode([
                'ruc' => $this->sunat->ruc,
                'razonSocial' => $this->sunat->social_reason,
                'nombreComercial' => $this->company->name,
                'address' => [
                    'direccion' => $this->sunat->address,
                    'provincia' => $this->company->province,
                    'departamento' => $this->company->department,
                    'distrito' => $this->company->district,
                    'ubigueo' => $this->company->ubigeous,
                ],
            ]);

            $this->comprobant->items = json_encode($products);
            $this->comprobant->fechaEmision = Carbon::parse($this->comprobant->fechaEmision)->format('Y-m-d');

            $this->comprobant->save();
            // return response()->streamDownload(function () {
            //     echo $this->getComprobantPdf($this->json);
            // }, 'invoice.pdf');
        } else {
            $this->emit('error_alert', 'Error al validar la factura');
        }
    }

    public function render()
    {
        if ($this->searchProductService) {
            $this->concepts = Concept::query()
                ->when($this->searchProductService, fn ($q, $searchProductService) => $q->where('name', 'like', '%' . $searchProductService . '%'))
                ->get();
            $this->products = (new ProductService())->searchProducts($this->searchProductService);
        } else {
            $this->concepts = [];
            $this->products = [];
        }

        if ($this->customer) {
            $this->cart = Cart::session($this->customer->phone)
                ->getContent()
                ->sortBy('name');
            // dd($this->cart->toArray());
            $this->updateCartOptions();
        } else {
            $this->cart = [];
        }

        return view('livewire.sunat.create-invoice-ticket')
            ->extends('layouts.admin.app')
            ->section('content');
    }
}

