@extends('admin/layout/layout')
@if($brand_id > 0)
@section('page_title','Edit Brand')
@else
@section('page_title','New Brand')
@endif
@section('brand_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($brand_id > 0)
            Edit Brand
            @else
            New Brand
            @endif
        </h1>
        <a href="{{url('/admin/attributes/brands')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/attributes/brands/manage_brand')}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <label for="brand_name" class="control-label mb-1">Brand</label>
                        <input id="brand_name" name="brand_name" type="text" value="{{$brand}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('brand_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="brand_image" class="control-label mb-1">Image</label>
                        <input id="brand_image" name="brand_image" type="file" class="form-control"
                                    aria-required="true" aria-invalid="false">
                        @error('brand_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div>
                            <br>
                            <div>
                                <input type="hidden" name="brand_id" value="{{$brand_id}}">

                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    @if($brand_id > 0)
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