@extends('admin/layout/layout')
@section('page_title','User Detail')
@section('users_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
           User Detail
        </h1>
        <a href="{{url('/admin/users')}}" class="btn btn-primary mb-3">Back</a>
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <!-- <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                    </tr> -->
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{$Users->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{$Users->email}}</td>
                    </tr>
                    <tr>
                        <td><strong>Password</strong></td>
                        <td>{{$Users->password}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile</strong></td>
                        <td>{{$Users->mobile}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>{{$Users->address}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td>{{$Users->city}}</td>
                    </tr>
                    <tr>
                        <td><strong>Zip</strong></td>
                        <td>{{$Users->zip}}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        @if($Users->status == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Created at</strong></td>
                        <td>{{Carbon\Carbon::parse($Users->created_at)->format('d-m-Y h:i:s')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated at</strong></td>
                        <td>{{\Carbon\Carbon::parse($Users->updated_at)->format('d-m-Y h:i:s')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection