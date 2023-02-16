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

class SaleCreate extends Component
{
    public Sale $editing;

    public $searchProduct = '';
    public $products = [];
    public $statuses = [];
    public $customers = [];

    public $subtotal;
    public $total;
    public $cash = 0;
    public $change = 0;
    public $itemsQuantity;

    public $another = false;

    public function rules()
    {
        return [
            'editing.code_sale' => ['required', 'min:6', 'max:6', Rule::unique('sales', 'code_sale')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Sale::STATUSES)->keys()->implode(','),
            'editing.customer_id' => 'required',
            'editing.date_sale' => 'required',
            'editing.total' => 'nullable',
            'editing.observation' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code_sale.min' => 'El código no debe tener menos de 6 chares',
        'editing.code_sale.max' => 'El código no debe tener más de 6 caracteres',
        'editing.code_sale.required' => 'El código es obligatorio',
        'editing.code_sale.unique' => 'Ya existe una compra con este código',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.customer_id.required' => 'El cliente es obligatorio',
        'editing.date_sale.required' => 'La fecha de compra es obligatorio',
    ];

    public function code_random($lenght)
    {
        $countSale = Sale::count();
        $code = str_pad($countSale + 1, $lenght, "0", STR_PAD_LEFT);
        return 'V' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code_sale = $this->code_random(5);
        $this->statuses = Sale::STATUSES;
        $this->customers = Customer::pluck('name', 'id');
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
        if ($this->editing->customer_id > 0) {
            $cart = Cart::session($this->editing->customer_id)->getContent()->sortBy('name');
            $this->updateCartOptions();
        } else {
            $cart = [];
        }
        return view('livewire.sale.sale-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->editing->customer_id)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->customer_id)->getTotalQuantity();
    }

    public function makeBlankFields()
    {
        return Sale::make(['status' => 'pagado']);
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

        Cart::session($this->editing->customer_id)->add($product->id, $product->name, $product->sale_price, $cant, array('discount' => $discount));
        $this->searchProduct = '';
        $this->updateCartOptions();

        $this->emit('success_alert', 'Producto agregado a la venta');
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0)
    {
        if ($cant > $product->stock) {
            $this->emit('info_alert', 'Este producto no tiene suficiento stock');
            return;
        }
        if ($cant > 0) {
            $this->removeItem($product->id);
            Cart::session($this->editing->customer_id)->add($product->id, $product->name, $product->sale_price, $cant, array('discount' => $discount));
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
    }

    public function updateDiscountCart(Product $product, $discount = 0)
    {
        if ($discount > 0) {
            Cart::session($this->editing->customer_id)->update($product->id, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($this->editing->customer_id)->update($product->id, array('attributes' => array('discount' => 0)));
        }
        $this->updateCartOptions();
    }

    public function updatedEditingStatus()
    {
        $this->cash = 0;
    }

    public function updatedCash($value)
    {
        $cartItems = Cart::session($this->editing->customer_id)->getContent();
        $totalDiscount = 0;
        foreach ($cartItems as $c) {
            $totalDiscount += ($c->price * $c->quantity) - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        if ($value == "" || $value < $totalDiscount) {
            $this->change = 0;
        } else {
            $this->change = $this->cash - $totalDiscount;
        }
    }

    public function removeItem($productId)
    {
        Cart::session($this->editing->customer_id)->remove($productId);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->customer_id)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de productos reiniciado');
    }

    public function cancel()
    {
        Cart::session($this->editing->customer_id)->clear();
        $this->updateCartOptions();
        return redirect()->route('ventas');
    }

    public function changeAnother()
    {
        $this->another = true;
    }

    public function save()
    {
        $this->saveLogic();
        if ($this->another) {
            return redirect()->route('ventas.crear');
        } else {
            return redirect()->route('ventas');
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function saveLogic()
    {
        $this->validate();
        $cartItems = Cart::session($this->editing->customer_id)->getContent();
        $totalDiscount = 0;
        foreach ($cartItems as $c) {
            $totalDiscount += ($c->price * $c->quantity) - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }

        $this->editing->total = $totalDiscount;
        $this->editing->date_sale = Carbon::parse($this->editing->date_sale)->format('Y-m-d');
        $this->editing->cash = $this->cash;
        $this->editing->change = $this->change;
        $this->editing->save();
            foreach ($cartItems as $item) {
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

        DuePay::create([
            'description' => $this->editing->code_sale,
            'person_owed' => $this->editing->customer->name,
            'amount_owed' => $totalDiscount,
            'amount_paid' => $this->cash,
            'reason' => 'venta',
        ]);

        Cart::session($this->editing->customer_id)->clear();
        $this->updateCartOptions();
        $this->cash < $totalDiscount ?
            $this->emit('success_alert', 'Venta registrada con deuda')
        :
            $this->emit('success_alert', 'Venta registrada y pagada');

    }
}
