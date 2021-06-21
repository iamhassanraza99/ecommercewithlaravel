@extends('admin/layout/layout')
@if($tax_id > 0) 
    @section('page_title','Edit Tax')
@else
    @section('page_title','New Tax')
@endif
@section('tax_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($tax_id > 0) 
                Edit Tax
            @else
                New Tax
            @endif
        </h1>
        <a href="{{url('/admin/attributes/tax')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/attributes/tax/manage_tax')}}" method="post">
                @csrf()
                    <div class="form-group">
                        <label for="tax_name" class="control-label mb-1">Tax</label>
                        <input id="tax_name" name="tax_name" type="text" value="{{$tax_name}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('tax_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="tax_value" class="control-label mb-1">Value</label>
                        <input id="tax_value" name="tax_value" type="text" value="{{$tax_value}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                    </div>
                    <div>
                        <input type="hidden" name="tax_id" value="{{$tax_id}}">
                        
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        @if($tax_id > 0) 
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