@extends('front/layout/layout')

@section('container')
<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    <!-- single slide item -->
                    @foreach($HomeBanner as $banner)
                    <li>
                        <div class="seq-model">
                            @if($banner->image == "")
                            <img data-seq src="{{@asset('front_assets/img/slider/1.jpg')}}" alt="" />
                            @else
                            <img data-seq src="{{@asset('storage/media/banners/'.$banner->image)}}"
                                alt="Men slide img" />
                            @endif
                        </div>
                        <div class="seq-title">
                            <span data-seq>{{$banner->message}}</span>
                            <h2 data-seq>{{$banner->title}}</h2>
                            <p data-seq>{!! $banner->description !!}</p>
                            <a data-seq href="{{$banner->btn_link}}" target="_blank"
                                class="aa-shop-now-btn aa-secondary-btn">{{$banner->btn_text}}</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
        </div>
    </div>
</section>
<!-- / slider -->
<!-- Start Promo section -->
<section id="aa-promo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-promo-area">
                    <div class="row">
                        <!-- promo left -->
                        <!-- <div class="col-md-5 no-padding">                
                              <div class="aa-promo-left">
                                <div class="aa-promo-banner">                    
                                  <img src="{{@asset('front_assets/img/promo-banner-1.jpg')}}" alt="img">                    
                                  <div class="aa-prom-content">
                                    <span>75% Off</span>
                                    <h4><a href="#">For Women</a></h4>                      
                                  </div>
                                </div>
                              </div>
                            </div> -->
                        <!-- promo right -->
                        <div class="col-md-12 no-padding">
                            <div class="aa-promo-right">
                                @if(isset($Category[0]))
                                @foreach($Category as $cat)
                                <div class="aa-single-promo-right">
                                    <div class="aa-promo-banner">
                                        <img src="{{@asset('storage/media/category/'.$cat->category_image)}}" alt="img">
                                        <div class="aa-prom-content">
                                            <span>Exclusive Item</span>
                                            <h4><a href="{{url('/category/'.$cat->category_slug)}}">For
                                                    {{$cat->category_name}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-md-12 no-padding">
                                    <div class="aa-promo-right">
                                        <div class="aa-single-promo-right">
                                            <div class="aa-promo-banner">
                                                <img src="{{@asset('front_assets/img/promo-banner-3.jpg')}}" alt="img">
                                                <div class="aa-prom-content">
                                                    <span>Exclusive Item</span>
                                                    <h4><a href="#">For Men</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aa-single-promo-right">
                                            <div class="aa-promo-banner">
                                                <img src="{{@asset('front_assets/img/promo-banner-2.jpg')}}" alt="img">
                                                <div class="aa-prom-content">
                                                    <span>Sale Off</span>
                                                    <h4><a href="#">On Shoes</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aa-single-promo-right">
                                            <div class="aa-promo-banner">
                                                <img src="{{@asset('front_assets/img/promo-banner-4.jpg')}}" alt="img">
                                                <div class="aa-prom-content">
                                                    <span>New Arrivals</span>
                                                    <h4><a href="#">For Kids</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="aa-single-promo-right">
                                            <div class="aa-promo-banner">
                                                <img src="{{@asset('front_assets/img/promo-banner-5.jpg')}}" alt="img">
                                                <div class="aa-prom-content">
                                                    <span>25% Off</span>
                                                    <h4><a href="#">For Bags</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                @if(isset($Category[0]))
                                @foreach($Category as $cat)
                                <li class=""><a href="#cat{{$cat->id}}" data-toggle="tab">{{$cat->category_name}}</a>
                                </li>
                                @endforeach
                                @else
                                <li class="active"><a href="#men" data-toggle="tab">Men</a></li>
                                <li><a href="#women" data-toggle="tab">Women</a></li>
                                @endif
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @php
                                $loop_count = 1;
                                @endphp
                                @if(isset($Category[0]))
                                @foreach($Category as $cat)
                                @php
                                $cat_class="";
                                if($loop_count == 1){
                                $cat_class = "in active";
                                $loop_count++;
                                }
                                @endphp
                                <div class="tab-pane fade {{$cat_class}}" id="cat{{$cat->id}}">
                                    <ul class="aa-product-catg">
                                        <!-- start single product item -->
                                        @if(isset($Category_Products[$cat->id][0]))
                                        @foreach($Category_Products[$cat->id] as $productArr)
                                        <li>
                                            <figure>
                                                @if($productArr->product_image == "")
                                                <a class="aa-product-img"
                                                    href="{{url('product/'.$productArr->id.$productArr->product_slug)}}"><img
                                                        src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                        alt="polo shirt img"></a>
                                                @else
                                                <a class="aa-product-img"
                                                    href="{{url('product/'.$cat->id.'/'.$productArr->product_slug)}}"><img
                                                        src="{{@asset('storage/media/products/'.$productArr->product_image)}}"
                                                        width="250px" height="300px" alt="polo shirt img"></a>
                                                @endif
                                                <a class="aa-add-card-btn"
                                                    href="{{url('product/'.$productArr->product_slug)}}"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a
                                                            href="{{url('product/'.$productArr->product_slug)}}">{{$productArr->product_name}}</a>
                                                    </h4>
                                                    @if(isset($Product_Attr[0]))
                                                    <span
                                                        class="aa-product-price">Rs.{{$Product_Attr[0]->price}}
                                                    </span>
                                                    <span class="aa-product-price"><del>Rs.
                                                            {{$Featured_Product_Attr[0]->maximum_retail_price}}</del></span>
                                                    @else
                                                    <span class="aa-product-price">Rs.</span>
                                                    <span class="aa-product-price">
                                                        <del>Rs.0</del>
                                                    </span>
                                                    @endif
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#quick-view-modal" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                        @endforeach
                                        @else
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                        alt="polo shirt img"></a>
                                            </figure>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="#">No Product</a></h4>
                                            </figcaption>
                                        </li>
                                        @endif
                                    </ul>
                                    <!-- <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> -->
                                </div>
                                @endforeach
                                @else
                                <!-- Start men product category -->
                                <div class="tab-pane fade in active" id="men">
                                    <ul class="aa-product-catg">
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/man/t-shirt-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                                                    <span class="aa-product-price">$45.50</span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/man/polo-shirt-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/man/polo-shirt-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- / men product category -->
                                <!-- start women product category -->
                                <div class="tab-pane fade" id="women">
                                    <ul class="aa-product-catg">
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/women/girl-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/women/girl-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/women/girl-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                        <!-- start single product item -->
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="#"><img
                                                        src="{{@asset('front_assets/img/women/girl-1.png')}}"
                                                        alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                                                    <span class="aa-product-price">$45.50</span><span
                                                        class="aa-product-price"><del>$65.50</del></span>
                                                </figcaption>
                                            </figure>
                                            <div class="aa-product-hvr-content">
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                    title="Compare"><span class="fa fa-exchange"></span></a>
                                                <a href="#" data-toggle2="tooltip" data-placement="top"
                                                    title="Quick View" data-toggle="modal"
                                                    data-target="#quick-view-modal"><span
                                                        class="fa fa-search"></span></a>
                                            </div>
                                            <!-- product badge -->
                                            <span class="aa-badge aa-sale" href="#">SALE!</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- / women product category -->
                                @endif
                            </div>
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
                                                                        <img src="{{@asset('storage/media/products/'.$productArr->product_image)}}"
                                                                            class="simpleLens-big-image">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="simpleLens-thumbnails-container">
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                                                    data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                                                    <img
                                                                        src="img/view-slider/thumbnail/polo-shirt-1.png">
                                                                </a>
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                                                    data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                                                    <img
                                                                        src="img/view-slider/thumbnail/polo-shirt-3.png">
                                                                </a>

                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                    data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                                                    data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                                                    <img
                                                                        src="img/view-slider/thumbnail/polo-shirt-4.png">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal view content -->
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="aa-product-view-content">
                                                        <h3></h3>
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
                            </div><!-- / quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->
<section id="aa-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-banner-area">
                        <a href="#"><img src="{{@asset('front_assets/img/fashion-banner.jpg')}}"
                                alt="fashion banner img"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- popular section -->
<section id="aa-popular-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-popular-category-area">
                        <!-- start prduct navigation -->
                        <ul class="nav nav-tabs aa-products-tab">
                            <li class="active"><a href="#featured" data-toggle="tab">Features</a></li>
                            <li><a href="#trending" data-toggle="tab">Trending</a></li>
                            <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Start men featured category -->
                            <div class="tab-pane fade in active" id="featured">
                                <ul class="aa-product-catg aa-featured-slider">
                                    <!-- start single product item -->
                                    @if(isset($Featured_Products[0]))
                                    @foreach($Featured_Products as $productArr)
                                    <li>
                                        <figure>
                                            @if($productArr->product_image == "")
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                            @else
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('storage/media/products/'.$productArr->product_image)}}"
                                                    width="250px" height="300px" alt="polo shirt img"></a>
                                            @endif
                                            <a class="aa-add-card-btn"
                                                href="{{url('product/'.$productArr->product_slug)}}"><span
                                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a
                                                        href="{{url('product/'.$productArr->product_slug)}}">{{$productArr->product_name}}</a>
                                                </h4>
                                                @if(isset($Featured_Product_Attr[$productArr->id][0]))
                                                <span
                                                    class="aa-product-price">Rs.{{$Featured_Product_Attr[$productArr->id][0]->price}}
                                                </span>
                                                <span class="aa-product-price"><del>Rs.
                                                        {{$Featured_Product_Attr[$productArr->id][0]->maximum_retail_price}}</del></span>
                                                @else
                                                <span class="aa-product-price">Rs. </span>
                                                <span class="aa-product-price"><del>Rs. </del></span>
                                                @endif
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span
                                                    class="fa fa-exchange"></span></a>
                                            <a href="#quick-view-modal" data-toggle2="tooltip" data-placement="top"
                                                title="Quick View" data-toggle="modal"
                                                data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                                        </div>
                                        <!-- product badge -->
                                        <span class="aa-badge aa-sale" href="#">SALE!</span>
                                    </li>
                                    @endforeach
                                    @else
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="#"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                        </figure>
                                        <figcaption>
                                            <h4 class="aa-product-title"><a href="#">No Product</a></h4>
                                        </figcaption>
                                    </li>
                                    @endif
                                </ul>
                                <!-- <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> -->
                            </div>
                            <!-- / featured product category -->
                            <!-- start trending product category -->
                            <div class="tab-pane fade" id="trending">
                                <ul class="aa-product-catg aa-trending-slider">
                                    <!-- start single product item -->
                                    @if(isset($Trending_Products[0]))
                                    @foreach($Trending_Products as $productArr)
                                    <li>
                                        <figure>
                                            @if($productArr->product_image == "")
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                            @else
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('storage/media/products/'.$productArr->product_image)}}"
                                                    width="250px" height="300px" alt="polo shirt img"></a>
                                            @endif
                                            <a class="aa-add-card-btn"
                                                href="{{url('product/'.$productArr->product_slug)}}"><span
                                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a
                                                        href="{{url('product/'.$productArr->product_slug)}}">{{$productArr->product_name}}</a>
                                                </h4>
                                                @if(isset($Trending_Products_Attr[$productArr->id][0]))
                                                <span
                                                    class="aa-product-price">Rs.{{$Trending_Products_Attr[$productArr->id][0]->price}}
                                                </span>
                                                <span class="aa-product-price"><del>Rs.
                                                        {{$Trending_Products_Attr[$productArr->id][0]->maximum_retail_price}}</del></span>
                                                @else
                                                <span class="aa-product-price">Rs. </span>
                                                <span class="aa-product-price"><del>Rs. </del></span>
                                                @endif
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
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
                                    @else
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="#"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                        </figure>
                                        <figcaption>
                                            <h4 class="aa-product-title"><a href="#">No Product</a></h4>
                                        </figcaption>
                                    </li>
                                    @endif
                                </ul>
                                <!-- <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> -->
                            </div>
                            <!-- / trending product category -->
                            <!-- start discounted product category -->
                            <div class="tab-pane fade" id="discounted">
                                <ul class="aa-product-catg aa-discounted-slider">
                                    <!-- start single product item -->
                                    @if(isset($Discounted_Products[0]))
                                    @foreach($Discounted_Products as $productArr)
                                    <li>
                                        <figure>
                                            @if($productArr->product_image == "")
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                            @else
                                            <a class="aa-product-img"
                                                href="{{url('product/'.$productArr->product_slug)}}"><img
                                                    src="{{@asset('storage/media/products/'.$productArr->product_image)}}"
                                                    width="250px" height="300px" alt="polo shirt img"></a>
                                            @endif
                                            <a class="aa-add-card-btn"
                                                href="{{url('product/'.$productArr->product_slug)}}"><span
                                                    class="fa fa-shopping-cart"></span>Add To Cart</a>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a
                                                        href="{{url('product/'.$productArr->product_slug)}}">{{$productArr->product_name}}</a>
                                                </h4>
                                                @if(isset($Discounted_Products[$productArr->id][0]))
                                                <span
                                                    class="aa-product-price">Rs.{{$Discounted_Products[$productArr->id][0]->price}}
                                                </span>
                                                <span class="aa-product-price"><del>Rs.
                                                        {{$Discounted_Products[$productArr->id][0]->maximum_retail_price}}</del></span>
                                                @else
                                                <span class="aa-product-price">Rs. </span>
                                                <span class="aa-product-price"><del>Rs. </del></span>
                                                @endif
                                            </figcaption>
                                        </figure>
                                        <div class="aa-product-hvr-content">
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
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
                                    @else
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="#"><img
                                                    src="{{@asset('front_assets/img/man/polo-shirt-2.png')}}"
                                                    alt="polo shirt img"></a>
                                        </figure>
                                        <figcaption>
                                            <h4 class="aa-product-title"><a href="#">No Product</a></h4>
                                        </figcaption>
                                    </li>
                                    @endif
                                </ul>
                                <!-- <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> -->
                            </div>
                            <!-- / discounted product category -->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / popular section -->
<!-- Support section -->
<section id="aa-support">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-support-area">
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-truck"></span>
                            <h4>FREE SHIPPING</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-clock-o"></span>
                            <h4>30 DAYS MONEY BACK</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                    <!-- single support -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="aa-support-single">
                            <span class="fa fa-phone"></span>
                            <h4>SUPPORT 24/7</h4>
                            <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Support section -->

<!-- Client Brand -->
<section id="aa-client-brand">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-client-brand-area">
                    <ul class="aa-client-brand-slider">
                        @foreach($Brands as $brand)
                        <li><a href="#"><img src="{{@asset('storage/media/brands/'.$brand->image)}}"
                                    alt="{{$brand->image}}"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Client Brand -->
@endsection