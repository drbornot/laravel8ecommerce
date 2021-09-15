<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add New Coupon
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.coupons') }}" class="btn btn-success pull-right">All Coupons</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form action="" class="form-horizontal" wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="coupon_code" class="col-md-4 control-label">Code</label>
                            <div class="col-md-4" wire:key="input-name-2">
                                <input type="text" placeholder="Coupon Code" id="coupon_code" class="form-control input-md" wire:model.lazy="code">
                                @error('code') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type" class="col-md-4 control-label">Type</label>
                            <div class="col-md-4">
                                <select name="" class="form-control" id="coupon_type" wire:model.lazy="type">
                                    <option value="">Select</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent</option>
                                </select>
                                @error('type') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coupon_value" class="col-md-4 control-label">Value</label>
                            <div class="col-md-4" wire:key="input-name-2">
                                <input type="text" placeholder="Coupon Value" id="coupon_value" class="form-control input-md" wire:model.lazy="value">
                                @error('value') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coupon_cart_value" class="col-md-4 control-label">Cart Value</label>
                            <div class="col-md-4" wire:key="input-name-2">
                                <input type="text" placeholder="Coupon Cart Value" id="coupon_cart_value" class="form-control input-md" wire:model.lazy="cart_value">
                                @error('cart_value') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

