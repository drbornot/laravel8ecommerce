<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;

    public function rules()
    {
        return [
            'code' => ['required','unique:coupons'],
            'type' => ['required'],
            'value' => ['required','numeric'],
            'cart_value' => ['required','numeric']
        ];
    }

    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component')
            ->layout('layouts.base');
    }

    public function updated($properties)
    {
        $this->resetValidation();
        $this->validateOnly($properties,$this->rules());
    }

    public function getValues()
    {
        return [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'cart_value' => $this->cart_value
        ];
    }

    public function store()
    {
        $validator = Validator::make($this->getValues(),$this->rules())->validate();
        if (count($validator)) {
            Coupon::create($validator);
            $this->clearVars();
            session()->flash('message','Coupon has been created successfully!');
        }
    }

    public function clearVars()
    {
        $this->code = null;
        $this->type = null;
        $this->value = null;
        $this->cart_value = null;
    }

}
