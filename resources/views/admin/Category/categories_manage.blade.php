@extends('admin/layout/layout')
@if($category_id > 0) 
    @section('page_title','Edit Category')
@else
    @section('page_title','New Category')
@endif
@section('category_active','active')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($category_id > 0) 
                Edit Category
            @else
                New Category
            @endif
        </h1>
        <a href="{{url('/admin/category')}}" class="btn btn-primary mb-3">Back</a>
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/category/manage_category')}}" method="post">
                @csrf()
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" name="category_name" type="text" value="{{$category_name}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" name="category_slug" type="text" value="{{$category_slug}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                            @error('category_slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div>
                        <input type="hidden" name="category_id" value="{{$category_id}}">
                        
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        @if($category_id > 0) 
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
    @endsection