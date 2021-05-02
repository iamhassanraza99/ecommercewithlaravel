@extends('admin/layout/layout')
@if($size_id > 0) 
    @section('page_title','Edit Size')
@else
    @section('page_title','New Size')
@endif
@section('size_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($size_id > 0) 
                Edit Size
            @else
                New Size
            @endif
        </h1>
        <a href="{{url('/admin/attributes/size')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/attributes/size/manage_size')}}" method="post">
                @csrf()
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <input id="size" name="size" type="text" value="{{$size}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('size')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <input type="hidden" name="size_id" value="{{$size_id}}">
                        
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        @if($size_id > 0) 
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