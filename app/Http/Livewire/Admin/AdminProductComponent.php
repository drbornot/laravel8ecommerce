<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.admin-product-component', ['products' => $products])
            ->layout('layouts.base');
    }

    public function delete($item_id)
    {
        $model = Product::find($item_id);
        $model->delete();
        session()->flash('message','Product has been deleted successfully!');
    }
}
