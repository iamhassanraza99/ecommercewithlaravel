@extends('admin/layout/layout')
@section('page_title','All Coupons')
@section('coupon_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Coupons</h1>
        <a href="{{url('/admin/coupons/new')}}" class="btn btn-primary mb-3">Add Coupon</a>
        @if(Session::has('coupon-msg'))
            <div class="alert alert-success">{{ session('coupon-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Coupon Title</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Coupon as $coup)
                    <tr>
                        <td>{{$coup->id}}</td>
                        <td>{{$coup->coupon_title}}</td>
                        <td>{{$coup->coupon_code}}</td>
                        <td>{{$coup->coupon_value}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/coupons/edit/'.$coup->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/coupons/delete/'.$coup->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($coup->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/coupons/status/0/'.$coup->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/coupons/status/1/'.$coup->id)}}">
                                <span class="badge badge-primary">Activate</span>
                            </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection