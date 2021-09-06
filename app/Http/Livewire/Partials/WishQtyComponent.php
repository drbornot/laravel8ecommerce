<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;

class WishQtyComponent extends Component
{
    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.partials.wish-qty-component');
    }
}
