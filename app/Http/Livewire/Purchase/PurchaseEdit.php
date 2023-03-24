<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class PurchaseEdit extends Component
{
    public Purchase $editing;

    public $searchProduct = '';
    public $dtp = [];
    public $cart = [];
    public $products = [];
    public $statuses = [];
    public $methods = [];
    public $types = [];
    public $providers = [];

    public $totalCart;
    public $totalOG;
    public $total;
    public $totalDiscount;

    public $serial = '';
    public $correlative = '';

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

    public function mount($code)
    {
        $purchase = Purchase::where('code_purchase', $code)->first();
        $this->editing = $this->makeBlankFields();
        if ($this->editing->isNot($purchase)) $this->editing = $purchase; // para preservar cambios en los inputs
        $this->editing->date_purchase = Carbon::parse($this->editing->date_purchase)->format('d-m-Y');
        $this->statuses = Purchase::STATUSES;
        $this->methods = Purchase::METHOD_PAYMENTS;
        $this->types = Purchase::TYPE_CPE;
        $this->serial = substr($this->editing->nro_cpe, 0, 4);
        $this->correlative = substr($this->editing->nro_cpe, 7);
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

        $this->cart = Cart::session($this->editing->code_purchase)->getContent()->sortBy('name');
        if (count($this->cart) == 0) {
            $this->cart = [];
        }

        $this->dtp = PurchaseDetail::where('purchase_id', $this->editing->id)->select('id', 'product_id', 'price', 'discount', 'quantity')->get();
        if (count($this->dtp) == 0) {
            $this->dtp = [];
        }

        $this->updateCartOptions();

        return view('livewire.purchase.purchase-edit')
            ->extends('layouts.admin.app')
            ->section('content');
    }

    public function updateCartOptions()
    {
        $this->totalCart = Cart::session($this->editing->code_purchase)->getTotal();
        $this->calculeTotal();
    }

    public function refreshListModals()
    {
        $this->providers = Provider::where('status', 'activo')->pluck('name', 'id');
        $this->products = Product::query()->get();
    }

    public function makeBlankFields()
    {
        return Purchase::make();
    } /*para dejar vacios los inpust*/

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
        Cart::session($this->editing->code_purchase)->add($product->id, $product->name, $product->purchase_price, $cant, ['discount' => $discount]);
        $this->searchProduct = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la compra');
    }

    public function updatePriceCart(Product $product, $price)
    {
        Cart::session($this->editing->code_purchase)->update($product->id, ['price' => $price]);
        $this->updateCartOptions();
    }

    public function updatePriceDp(PurchaseDetail $dp, $price)
    {
        $dp->update(['price' => $price]);
        $this->updateCartOptions();
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0)
    {
        if ($cant > 0) {
            $price_cart_exist = Cart::session($this->editing->code_purchase)->get($product->id)->price;
            $this->removeItem($product->id);
            Cart::session($this->editing->code_purchase)->add($product->id, $product->name, $price_cart_exist, $cant, ['discount' => $discount]);
            $this->updateCartOptions();
        } else {
            $this->removeItem($product->id);
        }
    }
    public function updateQuantityDp(PurchaseDetail $dp, $cant, $discount = 0)
    {
        if ($cant > 0) {
            $dp->update(['quantity' => $cant, 'discount' => $discount, 'price' => $dp->price]);
        } else {
            $this->removeItemDp($dp->id);
        }
        $this->updateCartOptions();
    }

    public function updateDiscountCart(Product $product, $discount)
    {
        if ($discount > 0) {
            Cart::session($this->editing->code_purchase)->update($product->id, ['attributes' => ['discount' => $discount]]);
        } else {
            Cart::session($this->editing->code_purchase)->update($product->id, ['attributes' => ['discount' => 0]]);
        }
        $this->updateCartOptions();
    }

    public function updateDiscountDp(PurchaseDetail $dp, $discount)
    {
        if ($discount > 0) {
            $dp->update(['discount' => $discount]);
        } else {
            $dp->update(['discount' => 0]);
        }
        $this->updateCartOptions();
    }

    public function removeItem($productId)
    {
        Cart::session($this->editing->code_purchase)->remove($productId);
        $this->updateCartOptions();
    }

    public function removeItemDp(PurchaseDetail $dp)
    {
        $dp->delete();
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->code_purchase)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de compra reiniciado');
    }

    public function calculeTotal()
    {
        $totalDiscountCart = 0;
        $totalDiscountDp = 0;
        $totalCartOG = 0;
        $totalDpOG = 0;
        $totalDp = 0;
        $this->cart = Cart::session($this->editing->code_purchase)->getContent();
        foreach ($this->cart as $c) {
            $totalDiscountCart += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        foreach ($this->dtp as $p) {
            $totalDiscountDp += $p->price * $p->quantity - (($p->quantity * $p->price) * ($p->discount / 100));
            $totalDp += $p->price * $p->quantity;
        }
        $totalCartOG = $totalDiscountCart / 1.18;
        $totalDpOG = $totalDiscountDp / 1.18;
        $this->totalOG = $totalCartOG + $totalDpOG;
        $this->total = $this->totalCart + $totalDp;
        $this->totalDiscount = $totalDiscountCart + $totalDiscountDp;
    }

    public function cancel()
    {
        Cart::session($this->editing->code_purchase)->clear();
        $this->updateCartOptions();
        return redirect()->route('compras');
    }

    public function save()
    {
        $this->saveLogic();
        return redirect()->route('compras');
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
        Cart::session($this->editing->code_purchase)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Compra actualizada');
    }
}
