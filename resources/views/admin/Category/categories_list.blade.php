@extends('admin/layout/layout')
@section('page_title','All Category')
@section('category_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Category</h1>
        <a href="{{url('/admin/category/new')}}" class="btn btn-primary mb-3">Add Category</a>
        @if(Session::has('cat-msg'))
        <div class="alert alert-success">{{ session('cat-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Category as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td>{{$cat->category_name}}</td>
                        <td>{{$cat->category_slug}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/category/edit/'.$cat->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/category/delete/'.$cat->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                            </div>
                        </td>
                        @if($cat->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/category/status/0/'.$cat->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/category/status/1/'.$cat->id)}}">
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