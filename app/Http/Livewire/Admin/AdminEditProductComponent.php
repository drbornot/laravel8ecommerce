<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public Product $product;

    public $name, $slug, $short_description, $description, $regular_price, $sale_price, $SKU, $stock_status, $featured,
        $quantity, $newImage, $prevImage, $category_id;

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', Rule::unique('products')->ignore($this->product->id)],
            'short_description' => ['nullable'],
            'description' => ['required'],
            'regular_price' => ['required', 'numeric'],
            'sale_price' => ['nullable','numeric'],
            'SKU' => ['required', Rule::unique('products')->ignore($this->product->id)],
            'stock_status' => ['required', 'in:instock,outofstock'],
            'featured' => ['boolean'],
            'quantity' => ['present', 'numeric'],
            'category_id' => ['nullable']
        ];
    }

    public function mount($product_slug)
    {
        $this->product = Product::where('slug', $product_slug)->first();
        $this->loadData();
    }

    public function render()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('livewire.admin.admin-edit-product-component', ['categories' => $categories])
            ->layout('layouts.base');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function loadData()
    {
        if ($this->product) {
            $this->name = $this->product->name;
            $this->slug = $this->product->slug;
            $this->short_description = $this->product->short_description;
            $this->description = $this->product->description;
            $this->regular_price = $this->product->regular_price;
            $this->sale_price = $this->product->sale_price;
            $this->SKU = $this->product->SKU;
            $this->stock_status = $this->product->stock_status;
            $this->featured = $this->product->featured;
            $this->quantity = $this->product->quantity;
            $this->prevImage = $this->product->image;
            $this->category_id = $this->product->category_id;
        }
    }

    public function getData()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'regular_price' => $this->regular_price,
            'sale_price' => !empty($this->sale_price) ? $this->sale_price : 0.00,
            'SKU' => $this->SKU,
            'stock_status' => $this->stock_status,
            'featured' => $this->featured,
            'quantity' => $this->quantity,
            'category_id' => $this->category_id
        ];
    }

    public function store()
    {
        $validation = Validator::make($this->getData(),$this->rules())->validate();
        if ($this->newImage) {
            $validateImage = Validator::validate(['image' => $this->newImage],['image' => ['image']]);
            $image_name = $this->newImage->getClientOriginalName();
            $this->newImage->storeAs('products', $image_name);
            $validation = array_merge($validation,['image' => $image_name]);
        }
        if (count($validation)) {
            $this->product->update($validation);
            $this->resetErrorBag();
            session()->flash('message','Product has been updated successfully!');
        }
    }

    public function clearVars()
    {
        $this->name = null;
        $this->slug = null;
        $this->short_description = null;
        $this->description = null;
        $this->regular_price = null;
        $this->sale_price = null;
        $this->SKU = null;
        $this->stock_status = null;
        $this->featured = null;
        $this->quantity = null;
        $this->prevImage = null;
        $this->newImage = null;
        $this->category_id = null;
    }
}
