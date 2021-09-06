<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
    public Category $category;
    public $name, $slug;

    public function rules()
    {
        return [
            'name' => ['required','string'],
            'slug' => ['required','string',Rule::unique('categories')->ignore($this->category->id)]
        ];
    }

    public function mount($category_slug)
    {
        if ($category_slug) {
            $this->category = Category::where('slug',$category_slug)->first();
            $this->name = $this->category->name;
            $this->slug = $this->category->slug;
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')
            ->layout('layouts.base');
    }

    public function validateData()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function edit()
    {
        $validation = Validator::make($this->validateData(),$this->rules())->validate();
        if (count($validation)) {
            $this->category->update($validation);
            session()->flash('message','Category has been updated successfully!');
        }
    }
}
