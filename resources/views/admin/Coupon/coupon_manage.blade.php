@extends('admin/layout/layout')
@if($coupon_id > 0) 
    @section('page_title','Edit Coupon')
@else
    @section('page_title','New Coupon')
@endif
@section('coupon_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($coupon_id > 0) 
                Edit Coupon
            @else
                New Coupon
            @endif
        </h1>
        <a href="{{url('/admin/coupons')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/coupons/manage_coupon')}}" method="post">
                @csrf()
                    <div class="form-group">
                        <label for="coupon_name" class="control-label mb-1">Coupon Title</label>
                        <input id="coupon_name" name="coupon_title" type="text" value="{{$coupon_title}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('coupon_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                        <input id="coupon_code" name="coupon_code" type="text" value="{{$coupon_code}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('coupon_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                        <input id="coupon_value" name="coupon_value" type="text" value="{{$coupon_value}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('coupon_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <input type="hidden" name="coupon_id" value="{{$coupon_id}}">
                        
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        @if($coupon_id > 0) 
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