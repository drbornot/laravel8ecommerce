<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->alertBaseLayoutQtyChange();
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->alertBaseLayoutQtyChange();
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->alertBaseLayoutQtyChange();
        session()->flash('success_message', 'Items has been removed');
    }

    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->alertBaseLayoutQtyChange();
    }

    public function alertBaseLayoutQtyChange()
    {
        $this->emitTo('partials.cart-qty-component','refresh');
    }

}
