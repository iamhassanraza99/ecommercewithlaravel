@extends('admin/layout/layout')
@if($product_id > 0)
@section('page_title','Edit Product')
@else
@section('page_title','New Product')
@endif
@section('product_active','active')

@if($product_id > 0)
{{$product_image_class=''}}
@else
{{$product_image_class='required'}}
@endif
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($product_id > 0)
            Edit Product
            @else
            New Product
            @endif
        </h1>
        <a href="{{url('/admin/products')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/product/manage_product')}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <label for="product_name" class="control-label mb-1">Product Name</label>
                        <input id="product_name" name="product_name" type="text" value="{{$product_name}}"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('product_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_slug" class="control-label mb-1">Product Slug</label>
                        <input id="product_slug" name="product_slug" type="text" value="{{$product_slug}}"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('product_slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_image" class="control-label mb-1">Product Image</label>
                        <input id="product_image" name="product_image" type="file" class="form-control"
                            aria-required="true" aria-invalid="false" {{$product_image_class}}>
                        @error('product_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category_id" class="control-label mb-1">Product Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($category as $cat)
                                    @if($category_id == $cat->id)
                                    <option selected value="{{$cat->id}}">
                                        @else
                                    <option value="{{$cat->id}}">
                                        @endif
                                        {{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="product_brand" class="control-label mb-1">Product Brand</label>
                                <input id="product_brand" name="product_brand" type="text" value="{{$product_brand}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-4">
                                <label for="product_model" class="control-label mb-1">Product Model</label>
                                <input id="product_model" name="product_model" type="text" value="{{$product_model}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                        <textarea name="short_desc" id="short_desc" value="{{$short_desc}}" cols="30" rows="5"
                            class="form-control">{{$short_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_desc" class="control-label mb-1">Long Description</label>
                        <textarea name="long_desc" id="long_desc" value="{{$long_desc}}" cols="30" rows="10"
                            class="form-control">{{$long_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <input id="keywords" name="keywords" type="text" value="{{$keywords}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('keywords')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="technical_specifications" class="control-label mb-1">Technical
                            Specifications</label>
                        <input id="technical_specifications" name="technical_specifications" type="text"
                            value="{{$technical_specifications}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                        @error('technical_specifications')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <input id="uses" name="uses" type="text" value="{{$uses}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('uses')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <input id="warranty" name="warranty" type="text" value="{{$warranty}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('warranty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="hidden" name="product_id" value="{{$product_id}}">

                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            @if($product_id > 0)
                            Update
                            @else
                            Submit
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection