@extends('admin/layout/layout')
@section('page_title','Brands')
@section('brand_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Brands</h1>
        <a href="{{url('/admin/attributes/brands/new')}}" class="btn btn-primary mb-3">Add Brand</a>
        @if(Session::has('brand-msg'))
            <div class="alert alert-success">{{ session('brand-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Brand Name</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td><img src="{{asset('/storage/media/brands/'.$brand->image)}}" width="100px" alt="image"></td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/attributes/brands/edit/'.$brand->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/attributes/brands/delete/'.$brand->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($brand->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/attributes/brands/status/0/'.$brand->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/attributes/brands/status/1/'.$brand->id)}}">
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