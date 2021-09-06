<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public $categories;
    public $sorting;
    public $pagesize;

    public $min_price, $max_price;

    protected $listeners = [
        'noUiSliderUpdate'
    ];

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 3;
        $this->categories = Category::all();
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function render()
    {
        return view('livewire.shop-component',['products' => $this->loadData()])
            ->layout('layouts.base');
    }

    public function noUiSliderUpdate($value)
    {
        if ($value) {
            $this->min_price = $value[0];
            $this->max_price = $value[1];
        }
    }

    public function loadData()
    {
        if ($this->sorting == 'date')
            return Product::query()->whereBetween('regular_price', [$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price')
            return Product::query()->whereBetween('regular_price', [$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price-desc')
            return Product::query()->whereBetween('regular_price', [$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        else
            return Product::query()->whereBetween('regular_price', [$this->min_price,$this->max_price])->paginate($this->pagesize);
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('partials.wish-qty-component','refresh');
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
