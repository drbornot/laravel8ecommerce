<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::query()->where('slug', $this->slug)->first();
        $popular_products = Product::query()->inRandomOrder()->limit(4)->get();
        $related_products = Product::query()->where('category_id',$product->category_id)->limit(5)->get();
        $sale = Sale::query()->get()->first();

        return view('livewire.details-component', [
            'product' => $product,
            'populars' => $popular_products,
            'related' => $related_products,
            'sale' => $sale
        ])
            ->layout('layouts.base');
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
}
