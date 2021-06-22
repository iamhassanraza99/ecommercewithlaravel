@extends('admin/layout/layout')
@section('page_title','Users')
@section('users_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Users</h1>
        @if(Session::has('users-msg'))
            <div class="alert alert-success">{{ session('users-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Mobile No</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->mobile}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/users/users_detail/'.$user->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Detail">
                                        <i class="zmdi zmdi-more"></i>
                                    </button>
                                </a>
                                <!-- <a href="{{url('/admin/users/delete/'.$user->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a> -->
                            </div>
                        </td>
                        @if($user->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/users/status/0/'.$user->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/users/status/1/'.$user->id)}}">
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