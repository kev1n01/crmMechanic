<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Termwind\Components\Dd;

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
            'editing.code_sale' => ['required', 'min:5', 'max:5', Rule::unique('sales', 'code_sale')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Sale::STATUSES)->keys()->implode(','),
            'editing.customer_id' => 'required',
            'editing.date_sale' => 'required',
            'editing.total' => 'nullable',
            // 'editing.observation' => 'nullable',
            'editing.user_id' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code_sale.min' => 'El código no debe tener menos de 5 chares',
        'editing.code_sale.max' => 'El código no debe tener más de 5 caracteres',
        'editing.code_sale.required' => 'El código es obligatorio',
        'editing.code_sale.unique' => 'Ya existe una compra con este código',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.customer_id.required' => 'El valor es inválido',
        'editing.date_sale.required' => 'La fecha de compra es obligatorio',
    ];

    public function code_random($lenght)
    {
        $code = "";
        $char = true;
        for ($i = 1; $i <= $lenght; $i++) {
            if ($char) {
                $string_random = chr(rand(ord("a"), ord("z")));
                $string_random = strtoupper($string_random);
                $code .= $string_random;
                $char = false;
            } else {
                $number_random = rand(0, 9);
                $code .= $number_random;
                $char = true;
            }
        }
        return 'V' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code_sale = $this->code_random(4);
        $this->statuses = Sale::STATUSES;
        $this->customers = User::pluck('name', 'id');
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
        if($this->editing->customer_id > 0){
            $cart = Cart::session($this->editing->customer_id)->getContent()->sortBy('name');
            $this->updateCartOptions();
        }else{
            $cart = [];
        }
        return view('livewire.sale.sale-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updateCartOptions()
    {
        $this->subtotal = Cart::session($this->editing->customer_id)->getSubTotal();
        $this->total = Cart::session($this->editing->customer_id)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->customer_id)->getTotalQuantity();
    }
    
    public function makeBlankFields()
    {
        return Sale::make(['status' => 'pendiente']);
    } /*para dejar vacios los inpust*/

    public function addProduct(Product $product, $cant = 1)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }

        Cart::session($this->editing->customer_id)->add($product->id, $product->name, $product->sale_price, $cant);
        $this->searchProduct = '';
        $this->updateCartOptions();


        $this->emit('success_alert', 'Producto agregado a la venta');
    }

    public function updateQuantityCart(Product $product, $cant)
    {
        if ($cant > 0) {
            $this->removeItem($product->id);
            Cart::session($this->editing->customer_id)->add($product->id, $product->name, $product->sale_price, $cant);
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
    }

    public function updatedCash()
    {
        if ($this->cash == "") {
            $this->change = 0;
        } else {
            $this->change = $this->cash - $this->total;
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

    public function saveLogic()
    {
        $this->validate();
        $this->editing->total = $this->total;
        $this->editing->user_id = 10;
        $this->editing->cash = $this->cash;
        $this->editing->change = $this->change;
        $this->editing->quantity = $this->itemsQuantity;
        $this->editing->save();
        $cartItems = Cart::session($this->editing->customer_id)->getContent();
        foreach ($cartItems as $item) {
            SaleDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'product_id' => $item->id,
                'sale_id' => $this->editing->id,
            ]);

            //update stock of product saled
            $product = Product::find($item->id);
            $product->stock -= $item->quantity;
            $product->save();
        }
        Cart::session($this->editing->customer_id)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Venta registrada');
    }
}
