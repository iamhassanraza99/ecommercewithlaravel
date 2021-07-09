@extends('front/layout/layout')
@section('page_title','Products')
@section('container')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="{{@asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Fashion</h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    @if(isset($Category[0]))
                    <li class="active">{{$Category[0]->category_name}}</li>
                    @else
                    <li class="active">No Category</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <div class="aa-product-catg-content">
                    <div class="aa-product-catg-head">
                        <div class="aa-product-catg-head-left">
                            <form action="" class="aa-sort-form">
                                <label for="">Sort by</label>
                                <select name="" onchange="sort_by()" id="sort_by_value">
                                    <option value="0" selected="Default">Default</option>
                                    <option value="name">Name</option>
                                    <option value="price_asc">Price Asc</option>
                                    <option value="price_desc">Price Desc</option>
                                    <option value="date">Date</option>
                                </select>
                            </form>
                            <div class="aa-show-form">
                                {{$sort_txt}}
                            </div>
                            <!-- <form action="" class="aa-show-form">
                                <label for="">Show</label>
                                <select name="">
                                    <option value="1" selected="12">12</option>
                                    <option value="2">24</option>
                                    <option value="3">36</option>
                                </select>
                            </form> -->
                        </div>
                        <div class="aa-product-catg-head-right">
                            <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                            <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                        </div>
                    </div>
                    <div class="aa-product-catg-body">
                        <ul class="aa-product-catg">
                           
                            <!-- start single product item -->
                            @if(isset($Products[0]))
                               
                            @foreach($Products as $product)
                            <li>
                                <figure>
                                    @if($product->product_image == "")
                                    <a class="aa-product-img" href="{{url('product/'.$product->product_slug)}}"><img
                                            src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                            alt="polo shirt img"></a>
                                    @else
                                    <a class="aa-product-img" href="{{url('product/'.$product->product_slug)}}"><img
                                            src="{{@asset('storage/media/products/'.$product->product_image)}}"
                                            width="250px" height="300px" alt="{{$product->product_slug}}"></a>
                                    @endif
                                    <a class="aa-add-card-btn" href="javascript:void(0)" onclick=home_add_to_cart('{{$product->id}}','{{$Product_Attr[$product->id][0]->size}}','{{$Product_Attr[$product->id][0]->color}}','{{$Product_Attr[$product->id][0]->price}}')><span class="fa fa-shopping-cart"></span>Add To
                                        Cart</a>
                                    <figcaption>
                                        <h4 class="aa-product-title"><a href="#">{{$product->product_name}}</a></h4>
                                        @if(isset($Product_Attr[$product->id][0]))
                                        <span
                                            class="aa-product-price">Rs.{{$Product_Attr[$product->id][0]->price}}
                                        </span>
                                        <span class="aa-product-price"><del>Rs.
                                                {{$Product_Attr[$product->id][0]->maximum_retail_price}}</del></span>
                                        @else
                                        <span class="aa-product-price">Rs.</span>
                                        <span class="aa-product-price">
                                            <del>Rs.0</del>
                                        </span>
                                        @endif
                                    </figcaption>
                                </figure>
                                <div class="aa-product-hvr-content">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span
                                            class="fa fa-heart-o"></span></a>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span
                                            class="fa fa-exchange"></span></a>
                                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View"
                                        data-toggle="modal" data-target="#quick-view-modal"><span
                                            class="fa fa-search"></span></a>
                                </div>
                                <!-- product badge -->
                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <!-- quick view modal -->
                        <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                        <div class="row">
                                            <!-- Modal view slider -->
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="aa-product-view-slider">
                                                    <div class="simpleLens-gallery-container" id="demo-1">
                                                        <div class="simpleLens-container">
                                                            <div class="simpleLens-big-image-container">
                                                                <a class="simpleLens-lens-image"
                                                                    data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                                                    <img src="img/view-slider/medium/polo-shirt-1.png"
                                                                        class="simpleLens-big-image">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="simpleLens-thumbnails-container">
                                                            <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                                                data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                                                <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                                            </a>
                                                            <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                                                data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                                                <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                                            </a>

                                                            <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                                                data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                                                <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal view content -->
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="aa-product-view-content">
                                                    <h3>T-Shirt</h3>
                                                    <div class="aa-price-block">
                                                        <span class="aa-product-view-price">$34.99</span>
                                                        <p class="aa-product-avilability">Avilability: <span>In
                                                                stock</span></p>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                        Officiis animi, veritatis quae repudiandae quod nulla porro
                                                        quidem, itaque quis quaerat!</p>
                                                    <h4>Size</h4>
                                                    <div class="aa-prod-view-size">
                                                        <a href="#">S</a>
                                                        <a href="#">M</a>
                                                        <a href="#">L</a>
                                                        <a href="#">XL</a>
                                                    </div>
                                                    <div class="aa-prod-quantity">
                                                        <form action="">
                                                            <select name="" id="">
                                                                <option value="0" selected="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="2">3</option>
                                                                <option value="3">4</option>
                                                                <option value="4">5</option>
                                                                <option value="5">6</option>
                                                            </select>
                                                        </form>
                                                        <p class="aa-prod-category">
                                                            Category: <a href="#">Polo T-Shirt</a>
                                                        </p>
                                                    </div>
                                                    <div class="aa-prod-view-bottom">
                                                        <a href="#" class="aa-add-to-cart-btn"><span
                                                                class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                        <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!-- / quick view modal -->
                    </div>
                    <!-- <div class="aa-product-catg-pagination">
                        <nav>
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Category</h3>
                        <ul class="aa-catg-nav">
                            @foreach($AllCategories as $cat)
                            @if($slug == $cat->category_slug)
                            <li><a href="{{url('/category/'.$cat->category_slug)}}" class="cat_active">{{$cat->category_name}}</a></li>
                            @else
                            <li><a href="{{url('/category/'.$cat->category_slug)}}">{{$cat->category_name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- single sidebar -->
                    <!-- <div class="aa-sidebar-widget">
                        <h3>Tags</h3>
                        <div class="tag-cloud">
                            <a href="#">Fashion</a>
                            <a href="#">Ecommerce</a>
                            <a href="#">Shop</a>
                            <a href="#">Hand Bag</a>
                            <a href="#">Laptop</a>
                            <a href="#">Head Phone</a>
                            <a href="#">Pen Drive</a>
                        </div>
                    </div> -->
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Shop By Price</h3>
                        <!-- price range -->
                        <div class="aa-sidebar-price-range">
                            <form action="">
                                <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                </div>
                                <span id="skip-value-lower" class="example-val"></span>
                                <span id="skip-value-upper" class="example-val"></span>
                                <button class="aa-filter-btn" type="button" onclick="sort_by_price_filter()">Filter</button>
                            </form>
                        </div>

                    </div>
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Shop By Color</h3>
                        <div class="aa-color-tag">
                          @foreach($Colors as $color)
                          @if(in_array($color->id,$ColorFilterArr))
                            <a class="aa-color-{{strtolower($color->color)}} activeclass" href="javascript:void(0)" onclick="sort_by_color('{{$color->id}}','1')"></a>
                          @else
                            <a class="aa-color-{{strtolower($color->color)}}" href="javascript:void(0)" onclick="sort_by_color('{{$color->id}}','0')"></a>
                          @endif
                          @endforeach
                        </div>
                    </div>
                    <!-- single sidebar -->
                    <!-- <div class="aa-sidebar-widget">
                        <h3>Recently Views</h3>
                        <div class="aa-recently-views">
                            <ul>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- single sidebar -->
                    <!-- <div class="aa-sidebar-widget">
                        <h3>Top Rated Products</h3>
                        <div class="aa-recently-views">
                            <ul>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                                    <div class="aa-cartbox-info">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p>1 x $250</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </aside>
            </div>

        </div>
    </div>
</section>
<!-- / product category -->
<input type="hidden" id="qty" name="qty" value="1">
<form id="AddtoCartForm">
@csrf
<input type="hidden" id="product_id" name="product_id">
<input type="hidden" id="size_id" name="size_id">
<input type="hidden" id="color_id" name="color_id">
<input type="hidden" id="product_qty" name="product_qty">
<input type="hidden" id="product_price" name="product_price">
</form>

<form id="CategoryFilter">
<input type="hidden" id="sort" name="sort" value="{{$sort}}">
<input type="hidden" id="sort_price_min" name="sort_price_min" value={{$filter_price_min}}>
<input type="hidden" id="sort_price_max" name="sort_price_max" value={{$filter_price_max}}>
<input type="hidden" id="color_filter" name="color_filter" value="{{$color_filter}}">
</form>
@endsection