<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date, $status;

    public Sale $sale;

    public function rules()
    {
        return [
            'sale_date' => ['required'],
            'status' => ['required','in:0,1']
        ];
    }

    public function mount()
    {
        $this->sale = Sale::query()->get()->first();
        $this->sale_date = $this->sale->sale_date->format('Y-m-d H:i:s');
        $this->status = $this->sale->status;
    }

    public function render()
    {
        return view('livewire.admin.admin-sale-component')
            ->layout('layouts.base');
    }

    public function updatedSaleDate($value)
    {
        if (!$value) {
            $this->sale_date = now()->format('Y-m-d H:i:s');
        }
    }

    public function updateSale()
    {
        $validator = Validator::make(['sale_date' => $this->sale_date, 'status' => $this->status],$this->rules())->validate();
        if (count($validator)) {
            $this->sale->update($validator);
            session()->flash('message','Record has been updated successfully!');
            $this->loadData();
        }
    }

    public function loadData()
    {
        $this->sale->refresh();
        $this->sale_date = $this->sale->sale_date->format('Y-m-d H:i:s');
        $this->status = $this->sale->status;
    }
}
