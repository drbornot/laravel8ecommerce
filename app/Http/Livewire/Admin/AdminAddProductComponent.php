<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $short_description, $description, $regular_price, $sale_price, $SKU, $stock_status, $featured,
        $quantity, $image, $category_id;

    public function rules()
    {
        return [
            'name' => ['required','string'],
            'slug' => ['required','unique:products'],
            'short_description' => ['nullable'],
            'description' => ['required'],
            'regular_price' => ['required','numeric'],
            'sale_price' => ['nullable','numeric'],
            'SKU' => ['required','unique:products'],
            'stock_status' => ['required','in:instock,outofstock'],
            'featured' => ['boolean'],
            'quantity' => ['present','numeric'],
//            'image' => ['nullable','image'],
            'category_id' => ['nullable']
        ];
    }

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function render()
    {
        $categories = Category::all()->pluck('name','id');
        return view('livewire.admin.admin-add-product-component',['categories' => $categories])
            ->layout('layouts.base');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,$this->rules());
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
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
//            'image' => $this->image,
            'category_id' => $this->category_id
        ];
    }

    public function store()
    {
        $validation = Validator::make($this->getData(),$this->rules())->validate();

        if (count($validation)) {
            if ($this->image) {
                $validateImage = Validator::validate(['image' => $this->image],['image' => ['image']]);
                $image_name = $this->image->getClientOriginalName();
                $this->image->storeAs('products', $image_name);
                $validation = array_merge($validation,['image' => $image_name]);
            }
            $model = Product::create($validation);
            if ($model) {
                $this->clearVars();
                session()->flash('message','Product has been created successfully!');
            }
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
        $this->image = null;
        $this->category_id = null;
    }
}
