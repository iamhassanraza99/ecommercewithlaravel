@extends('admin/layout/layout')
@section('page_title','Tax')
@section('tax_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">tax</h1>
        <a href="{{url('/admin/attributes/tax/new')}}" class="btn btn-primary mb-3">Add Tax</a>
        @if(Session::has('tax-msg'))
            <div class="alert alert-success">{{ session('tax-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Tax</th>
                        <th>Value</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Tax as $tax)
                    <tr>
                        <td>{{$tax->id}}</td>
                        <td>{{$tax->tax_name}}</td>
                        <td>{{$tax->tax_value}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/attributes/tax/edit/'.$tax->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/attributes/tax/delete/'.$tax->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($tax->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/attributes/tax/status/0/'.$tax->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/attributes/tax/status/1/'.$tax->id)}}">
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