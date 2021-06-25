@extends('admin/layout/layout')
@if($banner_id > 0)
@section('page_title','Edit Home Banner')
@else
@section('page_title','New Home Banner')
@endif
@section('home_banner_active','active')

@section('content')
<script src="{{@asset('admin_assets/ckeditor5/ckeditor.js')}}"></script>
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($banner_id > 0)
            Edit Home Banner
            @else
            New Home Banner
            @endif
        </h1>
        <a href="{{url('/admin/home_banners')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/home_banners/manage_home_banners')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf()
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="banner_title" class="control-label mb-1">Title</label>
                                <input id="banner_title" name="banner_title" type="text" value="{{$banner_title}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-6">
                                <label for="banner_message" class="control-label mb-1">Message</label>
                                <input id="banner_message" name="banner_message" type="text" value="{{$banner_message}}"
                                    class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="btn_text" class="control-label mb-1">Button Text</label>
                                <input id="btn_text" name="btn_text" type="text" value="{{$btn_text}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-6">
                                <label for="btn_link" class="control-label mb-1">Button Link</label>
                                <input id="btn_link" name="btn_link" type="text" value="{{$btn_link}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banner_description" class="control-label mb-1">Description</label>
                        <textarea class="form-control" name="banner_description" id="banner_description" value="{{$banner_description}}" cols="30" rows="10">{{$banner_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="banner_image" class="control-label mb-1">Image</label>
                        <input id="banner_image" name="banner_image" type="file" class="form-control"
                            aria-required="true" aria-invalid="false">
                        @error('banner_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if($banner_image != '')
                        <div class="p-2">
                            <a href="{{asset('storage/media/banners/'.$banner_image)}}" target="_blank"
                                rel="noopener noreferrer">
                                <img src="{{asset('storage/media/banners/'.$banner_image)}}" width="100px" alt="image">
                            </a>
                        </div>
                        @endif
                    </div>
                    <div>
                        <input type="hidden" name="banner_id" value="{{$banner_id}}">

                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            @if($banner_id > 0)
                            Update
                            @else
                            Submit
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
ClassicEditor.create(document.querySelector('#banner_description'));
</script>
@endsection