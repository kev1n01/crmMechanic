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
    public $providers = [];

    public $subtotal;
    public $total;
    public $itemsQuantity;

    public $another = false;

    public function rules()
    {
        return [
            'editing.code_purchase' => ['required', 'min:5', 'max:5', Rule::unique('purchases', 'code_purchase')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Purchase::STATUSES)->keys()->implode(','),
            'editing.provider_id' => 'required',
            'editing.date_purchase' => 'required',
            'editing.total' => 'nullable',
            'editing.observation' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code_purchase.min' => 'El código no debe tener menos de 5 chares',
        'editing.code_purchase.max' => 'El código no debe tener más de 5 caracteres',
        'editing.code_purchase.required' => 'El código es obligatorio',
        'editing.code_purchase.unique' => 'Ya existe una compra con este código',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.provider_id.required' => 'El valor es inválido',
        'editing.date_purchase.required' => 'La fecha de compra es obligatorio',
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
        return 'C' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code_purchase = $this->code_random(4);
        $this->statuses = Purchase::STATUSES;
        $this->providers = Provider::pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchProduct) {
            $this->products = Product::query()->when(
                $this->searchProduct,
                fn ($q, $searchProduct) =>
                $q->where('name', 'like', '%' . $searchProduct . '%')->orWhere('code', $searchProduct)
            )->get();
        } else {
            $this->products = [];
        }

        if($this->editing->provider_id > 0){
            $cart = Cart::session($this->editing->provider->name)->getContent()->sortBy('name');
            // dd($this->editing->provider->name);
            $this->updateCartOptions();
        }else{
            $cart = [];
        }

        return view('livewire.purchase.purchase-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updateCartOptions()
    {
        $this->subtotal = Cart::session($this->editing->provider->name)->getSubTotal();
        $this->total = Cart::session($this->editing->provider->name)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->provider->name)->getTotalQuantity();
    }
    
    public function makeBlankFields()
    {
        return Purchase::make(['status' => 'pendiente']);
    } /*para dejar vacios los inpust*/

    public function addProduct(Product $product, $cant = 1)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }

        Cart::session($this->editing->provider->name)->add($product->id, $product->name, $product->purchase_price, $cant);
        $this->searchProduct = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la compra');
    }

    public function updateQuantityCart(Product $product, $cant)
    {
        if ($cant > 0) {
            $this->removeItem($product->id);
            Cart::session($this->editing->provider->name)->add($product->id, $product->name, $product->purchase_price, $cant);
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
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
        $this->emit('success_alert', 'Lista de compra reiniciado');
    }

    public function cancel()
    {
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        return redirect()->route('compras');
    }

    public function changeAnother(){
        $this->another = true;
    }
    public function save()
    {
        $this->saveLogic();
        if($this->another){
            return redirect()->route('compras.crear');
        }else{
            return redirect()->route('compras');
        }
    }

    public function saveLogic()
    {
        $this->validate();
        $this->editing->total = $this->total;
        $this->editing->total = $this->total;
        $this->editing->date_purchase = Carbon::parse($this->editing->date_purchase)->format('Y-m-d') ;
        $this->editing->save();
        $cartItems = Cart::session($this->editing->provider->name)->getContent();
        foreach ($cartItems as $item) {
            PurchaseDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'product_id' => $item->id,
                'purchase_id' => $this->editing->id,
            ]);

            //update stock of product purchased
            $product = Product::find($item->id);
            $product->stock += $item->quantity;
            $product->save();
        }
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Compra registrada');
    }
}
