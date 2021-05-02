@extends('admin/layout/layout')
@if($color_id > 0) 
    @section('page_title','Edit Color')
@else
    @section('page_title','New Color')
@endif
@section('color_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($color_id > 0) 
                Edit Color
            @else
                New Color
            @endif
        </h1>
        <a href="{{url('/admin/attributes/color')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/attributes/color/manage_color')}}" method="post">
                @csrf()
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" name="color" type="text" value="{{$color}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('color')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <input type="hidden" name="color_id" value="{{$color_id}}">
                        
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        @if($color_id > 0) 
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