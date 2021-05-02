@extends('admin/layout/layout')
@section('page_title','Size')
@section('size_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Size</h1>
        <a href="{{url('/admin/attributes/size/new')}}" class="btn btn-primary mb-3">Add Size</a>
        @if(Session::has('size-msg'))
            <div class="alert alert-success">{{ session('size-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Size</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Sizes as $size)
                    <tr>
                        <td>{{$size->id}}</td>
                        <td>{{$size->size}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/attributes/size/edit/'.$size->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/attributes/size/delete/'.$size->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($size->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/attributes/size/status/0/'.$size->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/attributes/size/status/1/'.$size->id)}}">
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