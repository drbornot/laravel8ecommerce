<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;

    public $title, $subtitle, $link, $price, $image, $status;

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'subtitle' => ['required', 'string'],
            'link' => ['required'],
            'price' => ['required','numeric'],
            'status' => ['in:0,1']
        ];
    }

    public function mount()
    {
        $this->status = 0;
    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')
            ->layout('layouts.base');
    }

    public function getData()
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'link' => $this->link,
            'price' => $this->price,
            'status' => $this->status
        ];
    }

    public function store()
    {
        $validation = Validator::make($this->getData(),$this->rules())->validate();
        if (count($validation)) {
            if ($this->image) {
                $validateImage = Validator::make(['image' => $this->image],['image' => ['required','image']])->validate();
                $image_name = $this->image->getClientOriginalName();
                $this->image->storeAs('sliders', $image_name);
                $validation = array_merge($validation,['image' => $image_name]);
            }
            $model = HomeSlider::create($validation);
            $this->cleanVars();
            session()->flash('message','Home Slide has been created successfully!');
        }
    }

    public function cleanVars()
    {
        $this->title = null;
        $this->subtitle = null;
        $this->link = null;
        $this->price = null;
        $this->image = null;
        $this->status = null;
    }
}
