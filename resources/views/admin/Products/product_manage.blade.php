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
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="category_id" class="control-label mb-1">Product Category</label>
                                <select name="category_id" id="category_id" class="form-control">
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
                                <label for="product_brand" class="control-label mb-1">Product Brand</label>
                                <input id="product_brand" name="product_brand" type="text" value="{{$product_brand}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="col-md-4">
                                <label for="product_model" class="control-label mb-1">Product Model</label>
                                <input id="product_model" name="product_model" type="text" value="{{$product_model}}"
                                    class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                        <textarea name="short_desc" id="short_desc" value="{{$short_desc}}" cols="30" rows="5"
                            class="form-control">{{$short_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_desc" class="control-label mb-1">Long Description</label>
                        <textarea name="long_desc" id="long_desc" value="{{$long_desc}}" cols="30" rows="10"
                            class="form-control">{{$long_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <input id="keywords" name="keywords" type="text" value="{{$keywords}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('keywords')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="technical_specifications" class="control-label mb-1">Technical
                            Specifications</label>
                        <input id="technical_specifications" name="technical_specifications" type="text"
                            value="{{$technical_specifications}}" class="form-control" aria-required="true"
                            aria-invalid="false" required>
                        @error('technical_specifications')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <input id="uses" name="uses" type="text" value="{{$uses}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('uses')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <input id="warranty" name="warranty" type="text" value="{{$warranty}}" class="form-control"
                            aria-required="true" aria-invalid="false" required>
                        @error('warranty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- END CARD -->

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
                                    <label for="qty" class="control-label mb-1">Quntatity</label>
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
        </form>
    </div>
</div>
<script>
var count = 1;

function add_more() {
    count++;
    var html = '<input id="paid" name="paid[]" type="hidden" class="form-control"><div class="card" id="product_attr_' +
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
</script>
@endsection