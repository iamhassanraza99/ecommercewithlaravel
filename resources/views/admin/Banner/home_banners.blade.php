@extends('admin/layout/layout')
@section('page_title','Home Banner')
@section('home_banner_active','active')

@section('content')
<div class="row m-t-30">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">Home Banner</h1>
        <a href="{{url('/admin/home_banners/new')}}" class="btn btn-primary mb-3">Add Banner</a>
        @if(Session::has('home-banner-msg'))
            <div class="alert alert-success">{{ session('home-banner-msg') }}</div>
        @endif
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Image</th>
                        <th>Button Text</th>
                        <th>Button Link</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($HomeBanner as $banner)
                    <tr>
                        <td>{{$banner->id}}</td>
                        <td><img src="{{@asset('/storage/media/banners/'.$banner->image)}}" width="100px" alt="image"></td>
                        <td>{{$banner->btn_text}}</td>
                        <td>{{$banner->btn_link}}</td>
                        <td width="5%">
                            <div class="table-data-feature">
                                <a href="{{url('/admin/home_banners/edit/'.$banner->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{url('/admin/home_banners/delete/'.$banner->id)}}">
                                    <button class="item m-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        @if($banner->status==1)
                        <td width="5%">
                            <a href="{{url('/admin/home_banners/status/0/'.$banner->id)}}">
                                <span class="badge badge-warning">Deactivate</span>
                            </a>
                        </td>

                        @else
                        <td width="5%">
                            <a href="{{url('/admin/home_banners/status/1/'.$banner->id)}}">
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