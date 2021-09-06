<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;

    public HomeSlider $slider;

    public $title, $subtitle, $link, $price, $newImage, $prevImage, $status;

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

    public function mount($slide_id)
    {
        $this->slider = HomeSlider::where('id',$slide_id)->first();

        if ($this->slider) {
            $this->title = $this->slider->title;
            $this->subtitle = $this->slider->subtitle;
            $this->link = $this->slider->link;
            $this->price = $this->slider->price;
            $this->status = $this->slider->status;
            $this->prevImage = $this->slider->image;
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')
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
        if ($this->newImage) {
            $validateImage = Validator::make(['image' => $this->newImage],['image' => ['required','image']])->validate();
            $image_name = $this->newImage->getClientOriginalName();
            $this->newImage->storeAs('sliders', $image_name);
            $validation = array_merge($validation,['image' => $image_name]);
        }
        if (count($validation)) {
            $this->slider->update($validation);
            $this->resetErrorBag();
            session()->flash('message','Home Slide has been updated successfully!');
        }
    }

}
