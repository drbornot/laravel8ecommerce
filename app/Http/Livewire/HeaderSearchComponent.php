<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;
    public $product_cat;
    public $product_cat_name;

    public function mount()
    {
        $this->search = request()->has('search') ? request()->get('search') : null;
        $this->product_cat = request()->has('product-cate') ? request()->get('product-cate') : null;
        if ($this->product_cat) {
            $category = Category::query()->whereKey($this->product_cat)->first();
            $this->product_cat_name = $category->name;
        } else $this->product_cat_name = "All Category";
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.header-search-component',['categories' => $categories]);
    }

}
