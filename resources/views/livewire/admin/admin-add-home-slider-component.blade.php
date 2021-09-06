{{--@section('custom_css')--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">--}}
{{--@endsection--}}
<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Slide
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.homeslider') }}" class="btn btn-success pull-right">All Slides</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="store">
                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-4">
                                    <input type="text" id="title" placeholder="Title" class="form-control input-md" wire:model="title">
                                    @error('title') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sub-title" class="col-md-4 control-label">Subtitle</label>
                                <div class="col-md-4">
                                    <input type="text" id="sub-title" placeholder="Subtitle" class="form-control input-md" wire:model="subtitle">
                                    @error('subtitle') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-4">
                                    <input type="text" id="price" placeholder="Price" class="form-control input-md" wire:model="price">
                                    @error('price') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Link</label>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-addon" id="basic-addon3" style="font-size: 10px;">{{ config('app.url') }}/</span>
                                        <input type="text" class="form-control input-md" id="link" aria-describedby="basic-addon3" wire:model="link">
                                    </div>
                                    {{--<input type="text" id="link" placeholder="Link" class="form-control input-md" wire:model="link">--}}
                                    @error('link') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image</label>
                                <div class="col-md-4" wire:key="image-slide-{{ time() }}">
                                    <input type="file" id="image" class="input-file" wire:model="image">
                                    <div class="{{ $image ? '' : 'invisible' }}" style="width: 120px;{{ !$image ? 'height: 60px;' : '' }}" >
                                        <img src="{{ $image ? $image->temporaryUrl() : '' }}" width="120" alt="">
                                    </div>
                                    @error('image') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-4">
                                    <select name="" id="status" class="form-control" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                    @error('status') <div class="error" style="color: red;">{{ $message }}</div> @enderror
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
</div>

{{--@section('custom_scripts')--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}
{{--@endsection--}}
