<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AdminHomeCategories extends Component
{
    public $sel_categories;
    public $no_of_products;

    public function rules()
    {
        return [
            'sel_categories' => ['required'],
            'no_of_products' => ['required','numeric']
        ];
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-categories',['categories' => $categories])
            ->layout('layouts.base');
    }

    public function updated()
    {
        $this->resetErrorBag();
        if (session()->has('message'))
            session()->forget('message');
    }

    public function updatedSelCategories($value)
    {
        if ($value) {
            $model = HomeCategory::where('sel_categories',$value)->first();
            if ($model)
                $this->no_of_products = $model->no_of_products;
            else
                $this->no_of_products = null;
        } else {
            $this->no_of_products = null;
        }
    }

    public function getData()
    {
        return [
            'sel_categories' => $this->sel_categories,
            'no_of_products' => $this->no_of_products
        ];
    }

    public function save()
    {
        $flag = false;
        $validation = Validator::make($this->getData(),$this->rules())->validate();
        if (count($validation)) {
            $model = HomeCategory::where('sel_categories',$this->sel_categories)->first();
            if ($model) {
                $model->update($validation);
                session()->flash('message','Home Categories has been updated successfully!');
            } else {
                HomeCategory::create($validation);
                session()->flash('message','Home Categories has been created successfully!');
            }

        }
    }

}
