<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiry_date;

    public $coupon_id;

    public function rules()
    {
        return [
            'code' => ['required',Rule::unique('coupons')->ignore($this->coupon_id,'id')],
            'type' => ['required'],
            'value' => ['required','numeric'],
            'cart_value' => ['required','numeric'],
            'expiry_date' => ['required','date']
        ];
    }

    public function mount($coupon_id)
    {
        $this->coupon_id = $coupon_id;
        $this->getCoupon($this->coupon_id);
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-coupon-component')
            ->layout('layouts.base');
    }

    public function getCoupon($coupon_id)
    {
        $model = Coupon::where('id',$coupon_id)->first();
        $this->code = $model->code;
        $this->type = $model->type;
        $this->value = $model->value;
        $this->cart_value = $model->cart_value;
        $this->expiry_date = $model->expiry_date;
    }

    public function store()
    {
        // some check if value change
        $data = [];
        $validateData = [];

        $validator = Validator::make([
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'cart_value' => $this->cart_value,
            'expiry_date' => $this->expiry_date,
        ], $this->rules())->validate();

        if (count($validator)) {
            $model = Coupon::where('id',$this->coupon_id)->first();
            $model->update($validator);
            session()->flash('message','Coupon has been updated successfully!');
        }
    }

}
