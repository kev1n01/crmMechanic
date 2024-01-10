<?php

namespace App\Traits;

use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;

trait WithCart
{
    public $session;

    public function cartInit()
    {
        return Cart::session($this->session)->getContent()->sortBy('name');
    }

    public function is($code)
    {
    }

    public function addProduct(Product $product, $cant = 1, $discount = 0, $session)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }
        if ($product->stock <= 0) {
            $this->emit('error_alert', 'Este producto no tiene suficiento stock');
            return;
        }

        Cart::session($session)->add($product->id, $product->name, $product->sale_price, $cant, array('discount' => $discount));

        $this->updateCartOptions();

        $this->emit('success_alert', 'Producto agregado a la venta');
    }

    public function updatePriceCart(Product $product, $price, $session)
    {
        Cart::session($session)->update($product->id, ['price' => $price]);
        $this->updateCartOptions();
    }

    public function updateQuantityCart(Product $product, $cant, $discount = 0, $session)
    {
        if ($cant > $product->stock) {
            $this->emit('info_alert', 'Este producto no tiene suficiento stock');
            return;
        }
        if ($cant > 0) {
            $price_cart_exist = Cart::session($session)->get($product->id)->price;
            $this->removeItem($product->id);
            Cart::session($session)->add($product->id, $product->name, $price_cart_exist, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($product->id);
        }
        $this->updateCartOptions();
    }

    public function updateDiscountCart(Product $product, $discount = 0, $session)
    {
        if ($discount > 0) {
            Cart::session($session)->update($product->id, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($session)->update($product->id, array('attributes' => array('discount' => 0)));
        }
        $this->updateCartOptions();
    }
}
