<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $coupons = Coupon::paginate(5);
        return view('livewire.admin.admin-coupon-component',['coupons' => $coupons])
            ->layout('layouts.base');
    }

    public function delete($itemId)
    {
        $model = Coupon::where('id',$itemId)->first();
        $model->delete();
        session()->flash('message','Coupon has been deleted successfully!');
    }
}
