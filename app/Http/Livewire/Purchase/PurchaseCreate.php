<?php

namespace App\Http\Livewire\Purchase;

use Livewire\Component;
use App\Models\Provider;
use App\Models\Purchase;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class PurchaseCreate extends Component
{
    public Purchase $editing;

    public $searchProduct = '';
    public $products = [];
    public $statuses = [];
    public $methods = [];
    public $types = [];
    public $providers = [];
    public $cart = [];
    
    public $pf = [];

    public $total;
    public $totalDiscount = 0;
    public $totalOG = 0;

    public $serial = '';
    public $correlative = '';
    public $another = false;
    protected $listeners = ['refreshListModals'];

    public function rules()
    {
        return [
            'editing.code_purchase' => ['required', 'min:6', 'max:6', Rule::unique('purchases', 'code_purchase')->ignore($this->editing)],
            'editing.status' =>
            'required|in:' .
                collect(Purchase::STATUSES)
                ->keys()
                ->implode(','),
            'editing.provider_id' => 'required',
            'editing.method_payment' => 'required|in:' .
                collect(Purchase::METHOD_PAYMENTS)
                ->keys()
                ->implode(','),
            'editing.type_cpe' => 'required|in:' .
                collect(Purchase::TYPE_CPE)
                ->keys()
                ->implode(','),
            'editing.date_purchase' => 'required',
            'editing.nro_cpe' => 'required',
            'editing.total' => 'nullable',
            'editing.observation' => 'nullable',
            'serial' => 'required',
            'correlative' => 'required',
        ];
    }

    protected $messages = [
        'editing.code_purchase.min' => 'El código no debe tener menos de 6 chares',
        'editing.code_purchase.max' => 'El código no debe tener más de 6 caracteres',
        'editing.code_purchase.required' => 'El código es obligatorio',
        'editing.code_purchase.unique' => 'Ya existe una compra con este código',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.method_payment.required' => 'El metodo de pago es obligatorio',
        'editing.method_payment.in' => 'El valor es inválido',
        'editing.type_cpe.required' => 'El tipo de cpe es obligatorio',
        'editing.type_cpe.in' => 'El valor es inválido',
        'editing.nro_cpe.required' => 'El numero de cpe es obligatorio',
        'editing.provider_id.required' => 'El valor es inválido',
        'editing.date_purchase.required' => 'La fecha de compra es obligatorio',
        'serial.required' => 'La serie de cpe es obligatorio',
        'correlative.required' => 'El correlativo de cpe es obligatorio',
    ];

    public function code_random($lenght)
    {
        $countPurchase = Purchase::count();
        $code = str_pad($countPurchase + 1, $lenght, '0', STR_PAD_LEFT);
        return 'C' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankFields();
        } // para preservar cambios en los inputs for create
        $this->editing->date_purchase = Carbon::now()->format('d-m-Y');
        $this->editing->code_purchase = $this->code_random(5);
        $this->statuses = Purchase::STATUSES;
        $this->methods = Purchase::METHOD_PAYMENTS;
        $this->types = Purchase::TYPE_CPE;
        $this->providers = Provider::where('status', 'activo')->pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchProduct) {
            $this->products = Product::query()
                ->when($this->searchProduct, fn ($q, $searchProduct) => $q->where('name', 'like', '%' . $searchProduct . '%')->orWhere('code', $searchProduct))
                ->get();
        } else {
            $this->products = [];
        }

        if ($this->editing->provider_id > 0) {
            $this->cart = Cart::session($this->editing->provider->name)->getContent()->sortBy('name');
            $this->updateCartOptions();
        } else {
            $this->cart = [];
        }

        return view('livewire.purchase.purchase-create')
            ->extends('layouts.admin.app')
            ->section('content');
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->editing->provider->name)->getTotal();
        $this->calculeTotal();
    }

    public function refreshListModals()
    {
        $this->providers = Provider::where('status', 'activo')->pluck('name', 'id');
        $this->products = Product::query()->get();
    }

    public function makeBlankFields()
    {
        return Purchase::make(['status' => 'pendiente', 'method_payment' => 'efectivo']);
    } /*para dejar vacios los inpust*/

    public function updatedEditingProviderId($value){
        $this->pf = Provider::find($value);
    }

    public function updatedEditingTypeCpe($value)
    {
        if ($value == 'boleta') {
            $this->serial = 'B00';
        } else {
            $this->serial = 'F00';
        }
    }

    public function updatedSerial($value)
    {
        $this->editing->nro_cpe = $value . ' - ' . $this->correlative;
    }

    public function updatedCorrelative($value)
    {
        $this->editing->nro_cpe = $this->serial . ' - ' . $value;
    }

    public function addProduct(Product $product, $cant = 1, $discount = 0)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }

        Cart::session($this->editing->provider->name)->add($product->id, $product->name, $product->purchase_price, $cant, ['discount' => $discount]);
        $this->searchProduct = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la compra');
    }

    public function updatePriceCart(Product $product, $price)
    {
        Cart::session($this->editing->provider->name)->update($product->id, ['price' => $price]);
        $this->updateCartOptions();
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0)
    {
        if ($cant > 0) {
            $price_cart_exist = Cart::session($this->editing->provider->name)->get($product->id)->price;
            $this->removeItem($product->id);
            Cart::session($this->editing->provider->name)->add($product->id, $product->name, $price_cart_exist, $cant, ['discount' => $discount]);
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
    }

    public function updateDiscountCart(Product $product, $discount)
    {
        if ($discount > 0) {
            Cart::session($this->editing->provider->name)->update($product->id, ['attributes' => ['discount' => $discount]]);
        } else {
            Cart::session($this->editing->provider->name)->update($product->id, ['attributes' => ['discount' => 0]]);
        }
        $this->updateCartOptions();
    }

    public function removeItem($productId)
    {
        Cart::session($this->editing->provider->name)->remove($productId);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de productos reiniciado');
    }

    public function calculeTotal()
    {
        $this->totalDiscount = 0;
        $this->cart = Cart::session($this->editing->provider->name)->getContent();
        foreach ($this->cart as $c) {
            $this->totalDiscount += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        $this->totalOG = $this->totalDiscount / 1.18;
    }

    public function cancel()
    {
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        return redirect()->route('compras');
    }

    public function changeAnother()
    {
        $this->another = true;
    }

    public function save()
    {
        if (count($this->cart) == 0) {
            $this->emit('error_alert', 'No hay productos en la venta');
        } else {
            $this->saveLogic();
            if ($this->another) {
                return redirect()->route('compras.crear');
            } else {
                return redirect()->route('compras');
            }
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function saveLogic()
    {
        $this->validate();
        $this->calculeTotal();
        $this->editing->total = $this->totalDiscount;
        $this->editing->date_purchase = Carbon::parse($this->editing->date_purchase)->format('Y-m-d');
        $this->editing->save();
        foreach ($this->cart as $item) {
            PurchaseDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'discount' => $item->attributes['discount'],
                'product_id' => $item->id,
                'purchase_id' => $this->editing->id,
            ]);

            if ($this->editing->status == 'recibido') {
                $product = Product::find($item->id);
                $product->stock += $item->quantity;
                if ($product->purchase_price == 0) {
                    $product->purchase_price = $item->price;
                }
                $product->save();
            }
        }
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Compra registrada');
    }
}
