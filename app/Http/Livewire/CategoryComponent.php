<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public Category $category;
    public $categories;
    public $sorting;
    public $pagesize;

    public function mount($category)
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->categories = Category::all();
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.category-component',['products' => $this->loadData()])
            ->layout('layouts.base');
    }

    public function loadData()
    {
        if ($this->sorting == 'date')
            return Product::query()->where('category_id',$this->category->id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price')
            return Product::query()->where('category_id',$this->category->id)->orderBy('regular_price','ASC')->paginate($this->pagesize);
        elseif ($this->sorting == 'price-desc')
            return Product::query()->where('category_id',$this->category->id)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        else
            return Product::query()->where('category_id',$this->category->id)->paginate($this->pagesize);
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
}
