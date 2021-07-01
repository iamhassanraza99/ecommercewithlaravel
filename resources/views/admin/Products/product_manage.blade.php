@extends('admin/layout/layout')
@if($product_id > 0)
@section('page_title','Edit Product')
@else
@section('page_title','New Product')
@endif
@section('product_active','active')

@if($product_id > 0)
{{$product_image_class=''}}
@else
{{$product_image_class='required'}}
@endif
@section('content')
<script src="{{@asset('admin_assets/ckeditor5/ckeditor.js')}}"></script>
<div class="row">
    <div class="col-md-12">
        <h1 class="title-2 mb-1">
            @if($product_id > 0)
            Edit Product
            @else
            New Product
            @endif
        </h1>
        <a href="{{url('/admin/products')}}" class="btn btn-primary mb-3">Back</a>
        <form action="{{url('admin/product/manage_product')}}" method="post" enctype="multipart/form-data">
            @csrf()
            <!-- START CARD -->
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_name" class="control-label mb-1">Product Name</label>
                        <input id="product_name" name="product_name" type="text" value="{{$product_name}}"
                            class="form-control" aria-required="true" aria-invalid="false">
                        @error('product_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_slug" class="control-label mb-1">Product Slug</label>
                        <input id="product_slug" name="product_slug" type="text" value="{{$product_slug}}"
                            class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('product_slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_image" class="control-label mb-1">Product Image</label>
                        <input id="product_image" name="product_image" type="file" class="form-control"
                            aria-required="true" aria-invalid="false" {{$product_image_class}}>
                        @error('product_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if($product_image != '')
                        <div class="p-2">
                            <a href="{{asset('storage/media/products/'.$product_image)}}"
                                target="_blank" rel="noopener noreferrer">
                                <img src="{{asset('storage/media/products/'.$product_image)}}"
                                    width="100px" alt="image">
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category_id" class="control-label mb-1">Product Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                <option value="0">Select Categories</option>
                                    @foreach($category as $cat)
                                    @if($category_id == $cat->id)
                                    <option selected value="{{$cat->id}}">
                                        @else
                                    <option value="{{$cat->id}}">
                                        @endif
                                        {{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="brand_id" class="control-label mb-1">Product Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    @foreach($brands as $brand)
                                    @if($brand_id == $brand->id)
                                    <option selected value="{{$brand->id}}">
                                        @else
                                    <option value="{{$brand->id}}">
                                        @endif
                                        {{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="product_model" class="control-label mb-1">Product Model</label>
                                <input id="product_model" name="product_model" type="text" value="{{$product_model}}"
                                    class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                        <textarea name="short_desc" id="short_desc" value="{{$short_desc}}" cols="30" rows="10"
                            class="form-control">{{$short_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_desc" class="control-label mb-1">Long Description</label>
                        <textarea name="long_desc" id="long_desc" value="{{$long_desc}}" cols="30" rows="20"
                            class="form-control">{{$long_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <input id="keywords" name="keywords" type="text" value="{{$keywords}}" class="form-control"
                            aria-required="true" aria-invalid="false">
                        @error('keywords')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="technical_specifications" class="control-label mb-1">Technical
                            Specifications</label>
                        <textarea id="technical_specifications" name="technical_specifications" type="text"
                            value="{{$technical_specifications}}" class="form-control" aria-required="true"
                            cols="30" rows="20">{{$technical_specifications}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <input id="uses" name="uses" type="text" value="{{$uses}}" class="form-control"
                            aria-required="true" aria-invalid="false">
                        @error('uses')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <input id="warranty" name="warranty" type="text" value="{{$warranty}}" class="form-control"
                            aria-required="true" aria-invalid="false">
                        @error('warranty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="delivery_time" class="control-label mb-1">Delivery Time</label>
                                <input id="delivery_time" name="delivery_time" type="text" value="{{$delivery_time}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-4">
                                <label for="tax" class="control-label mb-1">Tax</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    @foreach($Tax as $tax)
                                    @if($tax_id == $tax->id)
                                    <option selected value="{{$tax->id}}">
                                        @else
                                    <option value="{{$tax->id}}">
                                        @endif
                                        {{$tax->tax_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="is_promo" class="control-label mb-1">Promotional Product</label>
                                <select name="is_promo" id="is_promo" class="form-control">
                                    @if($is_promo == 1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="is_featured" class="control-label mb-1">Featured Product</label>
                                <select name="is_featured" id="is_featured" class="form-control">
                                    @if($is_featured == 1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="is_discounted" class="control-label mb-1">Discount</label>
                                <select name="is_discounted" id="is_discounted" class="form-control">
                                    @if($is_discounted == 1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="is_trending" class="control-label mb-1">Trending Product</label>
                                <select name="is_trending" id="is_trending" class="form-control">
                                    @if($is_trending == 1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CARD -->
            <!-- Product Images START -->
            <h2 class="title-2 mb-2">Product Images</h2>

            @if(Session::has('product-image-msg'))
            <div class="alert alert-success">{{ session('product-image-msg') }}</div>
            @endif

            <!-- START CARD -->
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row" id="product_images_box">
                            @php
                            $count = 1;
                            @endphp

                            @foreach($productsImages as $key => $val)
                            @php
                            $ProductImageArr = (array) $val;
                            $previous_count = $count;
                            @endphp
                            <input id="piid" name="piid[]" type="hidden" value="{{$ProductImageArr['id']}}"
                                class="form-control">
                            <div class="col-md-4 product_images_{{$count++}}">
                                <label for="product_images" class="control-label mb-1">Image</label>
                                <input id="product_images" name="product_images[]" type="file" class="form-control"
                                    aria-required="true" aria-invalid="false">
                                @if($ProductImageArr['images'] != '')
                                <div class="p-2">
                                    <a href="{{asset('storage/media/products/'.$ProductImageArr['images'])}}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img src="{{asset('storage/media/products/'.$ProductImageArr['images'])}}"
                                            width="100px" alt="image">
                                    </a>
                                </div>
                                @endif
                                @error('image_attr.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($count == 2)
                            <div class="col-md-2">
                                <label for="btn_add" class="control-label mb-5 mt-2"></label>
                                <button type="button" class="btn btn-outline-success" onclick='add_more_image()'>
                                    <i class="fa fa-plus"></i>&nbsp; Add</button>
                            </div>
                            @else
                            <div class="col-md-2">
                                <a
                                    href="{{url('/admin/product/product_images_delete/'.$ProductImageArr['id'])}}/{{$product_id}}">
                                    <label for="btn_remove" class="control-label mb-5 mt-2"></label>
                                    <button type="button" class="btn btn-outline-danger"
                                        onclick='remove_image("{{$previous_count}}")'>
                                        <i class="fa fa-minus"></i>&nbsp; Remove</button>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CARD -->
            <!-- Product Images END -->
            <!-- Product attribute START -->

            <h2 class="title-2 mb-2">Product Attributes</h2>

            @if(Session::has('product-attr-msg'))
            <div class="alert alert-success">{{ session('product-attr-msg') }}</div>
            @endif
            @if(Session::has('sku-error'))
            <div class="alert alert-danger">{{ session('sku-error') }}</div>
            @endif
            <div id="product_attr_box">
                @php
                $count = 1;
                @endphp

                @foreach($productsAttr as $key => $val)
                @php
                $arr = (array) $val;
                $previous_count = $count;
                @endphp
                <input id="paid" name="paid[]" type="hidden" value="{{$arr['id']}}" class="form-control">
                <!-- START CARD -->
                <div class="card" id="product_attr_{{$count++}}">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="sku" class="control-label mb-1">SKU</label>
                                    <input id="sku" name="sku[]" type="text" value="{{$arr['sku']}}"
                                        class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="col-md-3">
                                    <label for="maximum_retail_price" class="control-label mb-1">Max. Retail
                                        Price</label>
                                    <input id="maximum_retail_price" name="maximum_retail_price[]" type="text"
                                        value="{{$arr['maximum_retail_price']}}" class="form-control"
                                        aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="price" class="control-label mb-1">Price</label>
                                    <input id="price" name="price[]" type="text" value="{{$arr['price']}}"
                                        class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="size" class="control-label mb-1">Size</label>
                                    <select name="size[]" id="size" class="form-control">
                                    <option value="0">Select Size</option>
                                        @foreach($sizes as $size)
                                        @if($arr['size_id']== $size->id)
                                        <option selected value="{{$size->id}}">{{$size->size}}</option>
                                        @else
                                        <option value="{{$size->id}}">{{$size->size}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="color" class="control-label mb-1">Color</label>
                                    <select name="color[]" id="color" class="form-control">
                                    <option value="0">Select Colors</option>
                                        @foreach($colors as $color)
                                        @if($arr['color_id']==$color->id)
                                        <option selected value="{{$color->id}}">{{$color->color}}</option>
                                        @else
                                        <option value="{{$color->id}}">{{$color->color}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="qty" class="control-label mb-1">Quantity</label>
                                    <input id="qty" name="qty[]" type="text" value="{{$arr['qty']}}"
                                        class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="image_attr" class="control-label mb-1">Image</label>
                                    <input id="image_attr" name="image_attr[]" type="file" class="form-control"
                                        aria-required="true" aria-invalid="false">
                                    @if($arr['image'] != '')
                                    <div class="p-2">
                                        <img src="{{asset('storage/media/products/attr/'.$arr['image'])}}" width="100px"
                                            alt="image">
                                    </div>
                                    @endif
                                    @error('image_attr.*')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if($count == 2)
                                <div class="col-md-4">
                                    <label for="btn_add" class="control-label mb-5 mt-2"></label>
                                    <button type="button" class="btn btn-outline-success" onclick='add_more()'>
                                        <i class="fa fa-plus"></i>&nbsp; Add</button>
                                </div>
                                @else
                                <div class="col-md-4">
                                    <a href="{{url('/admin/product/product_attr_delete/'.$arr['id'])}}/{{$product_id}}">
                                        <label for="btn_remove" class="control-label mb-5 mt-2"></label>
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick='remove_attr("{{$previous_count}}")'>
                                            <i class="fa fa-minus"></i>&nbsp; Remove</button>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->
                @endforeach
            </div>
            <div>
                <input type="hidden" name="product_id" value="{{$product_id}}">
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    @if($product_id > 0)
                    Update
                    @else
                    Submit
                    @endif
                </button>
            </div>
            <!-- Product attribute END -->
        </form>
    </div>
</div>
<script>
var count = 1;

function add_more() {
    count++;
    var html =
        '<input id="paid" name="paid[]" type="hidden" value="" class="form-control"><input id="paid" name="paid[]" type="hidden" class="form-control"><div class="card" id="product_attr_' +
        count + '"><div class="card-body"><div class="form-group"><div class="row">';
    html +=
        '<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" value="" class="form-control"aria-required="true" aria-invalid="false"></div>';
    html +=
        '<div class="col-md-3"><label for="maximum_retail_price" class="control-label mb-1">Max. Retail Price</label><input id="maximum_retail_price" name="maximum_retail_price[]" type="text" value="" class="form-control"aria-required="true" aria-invalid="false" required></div>';
    html +=
        '<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" value="" class="form-control"aria-required="true" aria-invalid="false" required></div>';
    html +=
        '<div class="col-md-2"><label for="size" class="control-label mb-1">Size</label><select name="size[]" id="size" class="form-control">@foreach($sizes as $size)<option selected value="{{$size->id}}">{{$size->size}}</option>@endforeach</select></div>';
    html +=
        '<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select name="color[]" id="color" class="form-control">@foreach($colors as $color)<option selected value="{{$color->id}}">{{$color->color}}</option>@endforeach</select></div>';
    html +=
        '<div class="col-md-2"><label for="qty" class="control-label mb-1">Quntatity</label><input id="qty" name="qty[]" type="text" value="" class="form-control"aria-required="true" aria-invalid="false" required></div>';
    html +=
        '<div class="col-md-4"><label for="image_attr" class="control-label mb-1">Image</label><input id="image_attr" name="image_attr[]" type="file" value="" class="form-control"aria-required="true" aria-invalid="false"></div>';
    html +=
        '<div class="col-md-4"><label for="image_attr" class="control-label mb-5 mt-2"></label><button type="button" class="btn btn-outline-danger" onclick="remove_attr(' +
        count + ')"><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
    html += '</div></div></div></div>';

    $('#product_attr_box').append(html);
}

function remove_attr(count) {
    $('#product_attr_' + count).remove();
}
var count_images = 1;

function add_more_image() {
    count_images++;
    var html =
        '<input id="piid" name="piid[]" type="hidden" value="" class="form-control"><div class="col-md-4 product_images_' +
        count_images +
        '"><label for="product_images" class="control-label mb-1 ">Image</label><input id="product_images" name="product_images[]" type="file" value="" class="form-control"aria-required="true" aria-invalid="false"></div>';
    html +=
        '<div class="col-md-2 product_images_' + count_images +
        '"><label for="product_images" class="control-label mb-5 mt-2 "></label><button type="button" class="btn btn-outline-danger" onclick="remove_image(' +
        count_images + ')"><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
    $('#product_images_box').append(html);
}

function remove_image(count_images) {
    $('.product_images_' +count_images).remove();
}
ClassicEditor.create(document.querySelector('#short_desc'));
ClassicEditor.create(document.querySelector('#long_desc'));
ClassicEditor.create(document.querySelector('#technical_specifications'));
</script>
@endsection