@extends('admin/layout/layout')
@section('page_title','Color')
@section('color_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">color</h1>
        <a href="{{url('/admin/attributes/color/new')}}" class="btn btn-primary mb-3">Add Color</a>
        @if(Session::has('color-msg'))
            <div class="alert alert-success">{{ session('color-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Color</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Colors as $color)
                    <tr>
                        <td>{{$color->id}}</td>
                        <td>{{$color->color}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/attributes/color/edit/'.$color->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/attributes/color/delete/'.$color->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($color->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/attributes/color/status/0/'.$color->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/attributes/color/status/1/'.$color->id)}}">
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