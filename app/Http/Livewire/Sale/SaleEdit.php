<?php

namespace App\Http\Livewire\Sale;

use App\Models\Customer;
use App\Models\DuePay;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SaleEdit extends Component
{
    public Sale $editing;

    public $searchProduct = '';
    public $products = [];
    public $statuses = [];
    public $methods_payment = [];
    public $types_payment = [];
    public $customers = [];
    public $dts = [];
    public $cart = [];

    public $change = 0;
    public $totalCart = 0;
    public $totalOG = 0;
    public $total = 0;
    public $totalDiscount;
    protected $listeners = ['refreshListModals'];

    public function rules()
    {
        return [
            'editing.code_sale' => ['required', 'min:6', 'max:6', Rule::unique('sales', 'code_sale')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Sale::STATUSES)->keys()->implode(','),
            'editing.method_payment' => 'required|in:' . collect(Sale::METHOD_PAYMENTS)->keys()->implode(','),
            'editing.type_payment' => 'required|in:' . collect(Sale::TYPE_PAYMENTS)->keys()->implode(','),
            'editing.customer_id' => 'required',
            'editing.date_sale' => 'required',
            'editing.cash' => 'nullable',
            'editing.type_sale' => 'nullable',
            'editing.total' => 'nullable',
            'editing.observation' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code_sale.min' => 'El código no debe tener menos de 6 chares',
        'editing.code_sale.max' => 'El código no debe tener más de 6 caracteres',
        'editing.code_sale.required' => 'El código es obligatorio',
        'editing.code_sale.unique' => 'Ya existe una compra con este código',
        'editing.type_payment.required' => 'El tipo de pago es obligatorio',
        'editing.type_payment.in' => 'El valor es inválido',
        'editing.method_payment.required' => 'El metodo de pago es obligatorio',
        'editing.method_payment.in' => 'El valor es inválido',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.customer_id.required' => 'El cliente es obligatorio',
        'editing.date_sale.required' => 'La fecha de compra es obligatorio',
    ];

    public function mount($code)
    {
        $sale = Sale::where('code_sale', $code)->first();
        $this->editing = $this->makeBlankFields();
        if ($this->editing->isNot($sale)) $this->editing = $sale; // para preservar cambios en los inputs for create
        $this->editing->date_sale = Carbon::parse($this->editing->date_sale)->format('d-m-Y');
        $this->statuses = Sale::STATUSES;
        $this->methods_payment = Sale::METHOD_PAYMENTS;
        $this->types_payment = Sale::TYPE_PAYMENTS;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchProduct) {
            $this->products = Product::query()
                ->where('stock', '>', 0)
                ->when(
                    $this->searchProduct,
                    fn ($q, $searchProduct) =>
                    $q->where('name', 'like', '%' . $searchProduct . '%')->orWhere('code', $searchProduct)
                )
                ->get();
        } else {
            $this->products = [];
        }

        $this->cart = Cart::session($this->editing->code_sale)->getContent()->sortBy('name');
        if ($this->cart->isempty()) {
            $this->cart = [];
        }

        $this->dts = SaleDetail::where('sale_id', $this->editing->id)->get()->sortBy('name');
        if (count($this->dts) == 0) {
            $this->dts = [];
        }
        $this->updateCartOptions();
        return view('livewire.sale.sale-edit')
            ->extends('layouts.admin.app')->section('content');
    }

    public function updateCartOptions()
    {
        $this->totalCart = Cart::session($this->editing->code_sale)->getTotal();
        $this->calculeTotal();
    }

    public function refreshListModals()
    {
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->products = Product::query()
            ->where('stock', '>', 0)
            ->get();
    }

    public function makeBlankFields()
    {
        return Sale::make();
    } /*para dejar vacios los inpust*/

    public function addProduct(Product $product, $cant = 1, $discount = 0)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }
        if ($product->stock <= 0) {
            $this->emit('error_alert', 'Este producto no tiene suficiento stock');
            return;
        }

        Cart::session($this->editing->code_sale)->add($product->id, $product->name, $product->sale_price, $cant, array('discount' => $discount));
        $this->searchProduct = '';
        $this->updateCartOptions();

        $this->emit('success_alert', 'Producto agregado a la venta');
    }

    public function updatePriceCart(Product $product, $price)
    {
        Cart::session($this->editing->code_sale)->update($product->id, ['price' => $price]);
        $this->updateCartOptions();
    }

    public function updatePriceDs(SaleDetail $ds, $price)
    {
        $ds->update(['price' => $price]);
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0)
    {
        if ($cant > $product->stock) {
            $this->emit('info_alert', 'Este producto no tiene suficiento stock');
            return;
        }
        if ($cant > 0) {
            $this->removeItem($product->id);
            Cart::session($this->editing->code_sale)->add($product->id, $product->name, $product->sale_price, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($product->id);
        }
        $this->updateCartOptions();
    }

    public function updateQuantityDs(SaleDetail $ds, $cant, $discount = 0)
    {
        $product = Product::find($ds->product_id);
        if ($cant > $product->stock) {
            $this->emit('info_alert', 'Este producto no tiene suficiente stock');
            return;
        }
        if ($cant > 0) {
            $ds->update(['quantity' => $cant, 'discount' => $discount, 'price' => $ds->price]);
        } else {
            $this->removeItemDp($ds->id);
        }
        $this->updateCartOptions();
    }

    public function updateDiscountCart(Product $product, $discount = 0)
    {
        if ($discount > 0) {
            Cart::session($this->editing->code_sale)->update($product->id, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($this->editing->code_sale)->update($product->id, array('attributes' => array('discount' => 0)));
        }
        $this->updateCartOptions();
    }

    public function updateDiscountDs(SaleDetail $ds, $discount)
    {
        if ($discount > 0) {
            $ds->update(['discount' => $discount]);
        } else {
            $ds->update(['discount' => 0]);
        }
        $this->updateCartOptions();
    }

    public function updatedEditingTypePayment($value)
    {
        if ($value == 'credito') {
            $this->editing->status = 'no pagado';
        }
        if ($value == 'contado') {
            $this->editing->status = 'pagado';
        }
    }

    public function updatedEditingCash($value)
    {
        if ($value < $this->totalDiscount) {
            $this->change = 0;
        } else {
            $this->change = $value - $this->totalDiscount;
        }
    }

    public function removeItem($productId)
    {
        Cart::session($this->editing->code_sale)->remove($productId);
        $this->updateCartOptions();
    }

    public function removeItemDs(SaleDetail $ds)
    {
        $ds->delete();
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->code_sale)->clear();
        foreach ($this->dts as $ds) {
            $ds->delete();
        }
        $this->editing->date_sale = Carbon::parse($this->editing->date_sale)->format('Y-m-d');
        $this->editing->update(['total' => 0]);
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de productos reiniciado');
    }

    public function cancel()
    {
        Cart::session($this->editing->code_sale)->clear();
        $this->updateCartOptions();
        return redirect()->route('ventas');
    }

    public function save()
    {
        if (count($this->cart) == 0 && count($this->dts) == 0) {
            $this->emit('error_alert', 'No hay productos en la venta');
            return;
        } else {
            $this->saveLogic();
            return redirect()->route('ventas');
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function calculeTotal()
    {
        $this->totalDiscount = 0;
        $this->cart = Cart::session($this->editing->code_sale)->getContent();
        $totalDiscountCart = 0;
        $totalDiscountDp = 0;
        $totalCartOG = 0;
        $totalDpOG = 0;
        $totalDp = 0;
        foreach ($this->cart as $c) {
            $totalDiscountCart += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        foreach ($this->dts as $p) {
            $totalDiscountDp += $p->price * $p->quantity - (($p->quantity * $p->price) * ($p->discount / 100));
            $totalDp += $p->price * $p->quantity;
        }
        $totalCartOG = $totalDiscountCart / 1.18;
        $totalDpOG = $totalDiscountDp / 1.18;
        $this->totalOG = $totalCartOG + $totalDpOG;
        $this->total = $this->totalCart + $totalDp;
        $this->totalDiscount = $totalDiscountCart + $totalDiscountDp;
    }

    public function saveLogic()
    {
        $this->validate();
        if ($this->editing->cash == 0 && $this->editing->method_payment == 'contado') {
            $this->emit('error_alert', 'Debe ingresar el monto en efectivo');
        } else {
            $this->calculeTotal();
            $this->editing->total = $this->totalDiscount;
            $this->editing->date_sale = Carbon::parse($this->editing->date_sale)->format('Y-m-d');
            $this->editing->save();
            foreach ($this->cart as $item) {
                SaleDetail::create([
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'discount' => $item->attributes['discount'],
                    'product_id' => $item->id,
                    'sale_id' => $this->editing->id,
                ]);

                //update stock of product saled
                $product = Product::find($item->id);
                $product->stock -= $item->quantity;
                $product->save();
            }

            if ($this->editing->type_payment == 'credito') {
                $this->editing->cash = 0;
                $duepay = DuePay::where('description', $this->editing->code_sale)->first();
                if (count($duepay) == 0) {
                    DuePay::create([
                        'description' => $this->editing->code_sale,
                        'person_owed' => $this->editing->customer->name,
                        'amount_owed' => $this->totalDiscount,
                        'amount_paid' => 0,
                        'reason' => 'venta comercial'
                    ]);
                }else{
                    $duepay->update([
                        'amount_owed' => $this->totalDiscount,
                    ]);
                }
            }

            if ($this->editing->type_payment == 'contado') {
                $duepay = DuePay::where('description', $this->editing->code_sale)->first();
                $duepay->delete();
            }

            Cart::session($this->editing->code_sale)->clear();
            $this->updateCartOptions();
            $this->editing->cash < $this->totalDiscount ?
                $this->emit('success_alert', 'Venta actualizada con deuda')
                :
                $this->emit('success_alert', 'Venta actualizada y pagada');
        }
    }
}
