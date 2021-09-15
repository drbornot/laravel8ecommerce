<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{
    public function render()
    {
        return view('livewire.wishlist-component')
            ->layout('layouts.base');
    }

    public function moveProductFromWishlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
        $this->emitTo('partials.wish-qty-component','refresh');
        $this->emitTo('partials.cart-qty-component','refresh');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $wItem) {
            if ($wItem->id == $product_id) {
                Cart::instance('wishlist')->remove($wItem->rowId);
                $this->emitTo('partials.wish-qty-component','refresh');
                return ;
            }
        }
    }
}
