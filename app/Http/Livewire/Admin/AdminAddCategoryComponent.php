<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{

    public $name, $slug;

    protected $rules = [
        'name' => ['required','string'],
        'slug' => ['required','string','unique:categories']
    ];

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')
            ->layout('layouts.base');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => ['required','string'],
            'slug' => ['required','string','unique:categories']
        ]);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store()
    {
        $model = Category::create($this->validate());
        if ($model) {
            session()->flash('message','Category has been created successfully!');
            $this->clearVars();
        }
    }

    public function clearVars()
    {
        $this->name = null;
        $this->slug = null;
    }

}
