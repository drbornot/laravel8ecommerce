<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->getCartProduct($slug);
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

    public function getCartProduct($slug)
    {
        $product = Product::query()->where('slug', $this->slug)->first();
        if (Cart::instance('cart')->count()) {
            foreach (Cart::instance('cart')->content() as $item) {
                if ($item->model->id == $product->id) {
                    $this->qty = $item->qty;
                }
            }
        }
    }

    public function increaseQty()
    {
        $this->qty++;
    }

    public function decreaseQty()
    {
        if ($this->qty > 1)
            $this->qty--;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
}
