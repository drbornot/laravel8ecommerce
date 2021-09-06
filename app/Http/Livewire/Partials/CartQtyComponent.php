<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;

class CartQtyComponent extends Component
{

    protected $listeners = [
        'refresh' => '$refresh'
    ];
    public function render()
    {
        return view('livewire.partials.cart-qty-component');
    }
}
