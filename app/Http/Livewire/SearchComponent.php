<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $categories;
    public $sorting;
    public $pagesize;

    public $search, $product_cat;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->categories = Category::all();
        $this->search = request()->has('search') ? request()->get('search') : null;
        $this->product_cat = request()->has('product-cate') ? request()->get('product-cate') : null;
    }

    public function render()
    {
        return view('livewire.search-component',['products' => $this->loadData()])
            ->layout('layouts.base');
    }

    public function loadData()
    {
        if ($this->sorting == 'date')
            return Product::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->where('category_id','like','%' . $this->product_cat . '%')
                ->orderBy('created_at','DESC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price')
            return Product::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->where('category_id','like','%' . $this->product_cat . '%')
                ->orderBy('regular_price','ASC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price-desc')
            return Product::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->where('category_id','like','%' . $this->product_cat . '%')
                ->orderBy('regular_price','DESC')->paginate($this->pagesize);
        else
            return Product::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->where('category_id','like','%' . $this->product_cat . '%')
                ->paginate($this->pagesize);
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
}
