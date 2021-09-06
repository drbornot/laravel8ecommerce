<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {

        $sliders = HomeSlider::where('status',true)->get();
        $latests = Product::orderBy('created_at','DESC')->get()->take(8);
        $categories_pluck = HomeCategory::all()->pluck('sel_categories');
        $categories = Category::query()->whereIn('id',$categories_pluck)->get();
        $sale_products = Product::query()->where('sale_price','>',0.00)->get()->take(8);
        $sale = Sale::query()->get()->first();

        return view('livewire.home-component',[
            'sliders' => $sliders,
            'latests' => $latests,
            'categories' => $categories,
            'sale_products' => $sale_products,
            'sale' => $sale
        ])->layout('layouts.base');
    }
}
