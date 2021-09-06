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
