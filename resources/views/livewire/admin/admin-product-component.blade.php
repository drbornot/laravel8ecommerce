<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Products
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.add.product') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($products as $item)
                                <tbody>
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="{{ asset('assets/images/products') }}/{{ $item->image }}" width="60" alt=""></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock_status }}</td>
                                    <td>{{ $item->regular_price }}</td>
                                    <td>{{ $item->sale_price }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit.product',['product_slug' => $item->slug]) }}" style="font-size: 10px;">
                                            <i class="fa fa-edit fa-2x"></i>
                                        </a>
                                        <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation();" wire:click.prevent="delete({{ $item->id }})" style="font-size: 10px;margin-left: 10px;">
                                            <i class="fa fa-times fa-2x text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        {{ $products->links('vendor.livewire.simple-tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
