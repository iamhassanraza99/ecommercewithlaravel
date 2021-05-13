@extends('admin/layout/layout')
@section('page_title','Products')
@section('product_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Products</h1>
        <a href="{{url('/admin/product/new')}}" class="btn btn-primary mb-3">Add Product</a>
        @if(Session::has('product-msg'))
        <div class="alert alert-success">{{ session('product-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Product Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_slug}}</td>
                        <td><img src="{{asset('storage/media/products/'.$product->product_image)}}" width="100px" alt="image"></td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/product/edit/'.$product->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/product/delete/'.$product->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                            </div>
                        </td>
                        @if($product->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/product/status/0/'.$product->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/product/status/1/'.$product->id)}}">
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