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
            'editing.code_purchase' => ['required', 'min:6', 'max:6', Rule::unique('purchases', 'code_purchase')->ignore($this->editing)],
            'editing.status' => 'required|in:' . collect(Purchase::STATUSES)->keys()->implode(','),
            'editing.provider_id' => 'required',
            'editing.date_purchase' => 'required',
            'editing.total' => 'nullable',
            'editing.observation' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code_purchase.min' => 'El código no debe tener menos de 6 chares',
        'editing.code_purchase.max' => 'El código no debe tener más de 6 caracteres',
        'editing.code_purchase.required' => 'El código es obligatorio',
        'editing.code_purchase.unique' => 'Ya existe una compra con este código',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.provider_id.required' => 'El valor es inválido',
        'editing.date_purchase.required' => 'La fecha de compra es obligatorio',
    ];

    public function code_random($lenght)
    {
        $countPurchase = Purchase::count();
        $code = str_pad($countPurchase + 1, $lenght, "0", STR_PAD_LEFT);
        return 'C' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code_purchase = $this->code_random(5);
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

        if ($this->editing->provider_id > 0) {
            $cart = Cart::session($this->editing->provider->name)->getContent()->sortBy('name');
            $this->updateCartOptions();
        } else {
            $cart = [];
        }

        return view('livewire.purchase.purchase-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->editing->provider->name)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->provider->name)->getTotalQuantity();
    }

    public function makeBlankFields()
    {
        return Purchase::make(['status' => 'pendiente']);
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

        Cart::session($this->editing->provider->name)->add($product->id, $product->name, $product->purchase_price, $cant, array('discount' => $discount));
        $this->searchProduct = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la compra');
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0)
    {
        if ($product->stock < $cant) {
            $this->emit('info_alert', 'Este producto no tiene suficiento stock');
            return;
        }
        if ($cant > 0) {
            $this->removeItem($product->id);
            Cart::session($this->editing->provider->name)->add($product->id, $product->name, $product->purchase_price, $cant, array('discount' => $discount));
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
    }

    public function updateDiscountCart(Product $product, $discount)
    {
        if ($discount > 0) {
            Cart::session($this->editing->provider->name)->update($product->id, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($this->editing->provider->name)->update($product->id, array('attributes' => array('discount' => 0)));
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
        $this->emit('success_alert', 'Lista de compra reiniciado');
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
        $this->saveLogic();
        if ($this->another) {
            return redirect()->route('compras.crear');
        } else {
            return redirect()->route('compras');
        }
    }
    
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function saveLogic()
    {
        $this->validate();
        $cartItems = Cart::session($this->editing->provider->name)->getContent();
        $totalDiscount = 0;
        foreach ($cartItems as $c) {
            $totalDiscount += ($c->price * $c->quantity) - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        $this->editing->total = $totalDiscount;
        $this->editing->date_purchase = Carbon::parse($this->editing->date_purchase)->format('Y-m-d');
        $this->editing->save();
        foreach ($cartItems as $item) {
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
                $product->save();
            }
        }
        Cart::session($this->editing->provider->name)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Compra registrada');
    }
}
