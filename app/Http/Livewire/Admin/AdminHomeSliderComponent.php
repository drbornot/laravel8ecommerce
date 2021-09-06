<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::all();
        return view('livewire.admin.admin-home-slider-component',['sliders' => $sliders])
            ->layout('layouts.base');
    }

    public function delete($item_id)
    {
        $model = HomeSlider::whereKey($item_id)->first();
        if ($model) {
            $model->delete();
            session()->flash('message','Home Slide has been deleted successfully!');
        }
    }
}
