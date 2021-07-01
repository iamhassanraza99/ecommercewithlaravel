@extends('front/layout/layout')
@section('page_title','Cart Page')
@section('container')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="{{@asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Cart Page</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="cart-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                        <form action="">
                            @if(session()->has('cart-msg'))
                            <div class="alert alert-success">
                                <strong>Success!</strong> {{session('cart-msg')}}
                            </div>
                            @endif
                            <div class="table-responsive">
                                @if(isset($Cart[0]))
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Cart as $cart)
                                        <tr>
                                            <td>
                                                <a class="remove"
                                                    href="{{url('/product_remove_from_cart/'.$cart->pid)}}">
                                                    <fa class="fa fa-close"></fa>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img src="{{@asset('storage/media/products/'.$cart->product_image)}}"
                                                        alt="img">
                                                </a>
                                            </td>
                                            <td>
                                                <a class="aa-cart-title" href="{{url('/product/'.$cart->product_slug)}}"
                                                    target="_blank">{{$cart->product_name}}</a>
                                                @if($cart->size != '')
                                                <br>Size: {{$cart->size}}
                                                @endif
                                                @if($cart->color != '')
                                                <br>Color: {{$cart->color}}
                                                @endif

                                            </td>
                                            <td>Rs. {{$cart->price}}</td>
                                            <td><input class="aa-cart-quantity" id="qty_{{$cart->attr_id}}"
                                                    type="number"
                                                    onchange="updateQty('{{$cart->pid}}','{{$cart->attr_id}}','{{$cart->size}}','{{$cart->color}}','{{$cart->price}}')"
                                                    value="{{$cart->qty}}">
                                            </td>
                                            <td id="total_price_{{$cart->attr_id}}"> Rs. {{$cart->price*$cart->qty}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="aa-cart-view-bottom">
                                                <div class="aa-cart-coupon">
                                                    <input class="aa-coupon-code" type="text" placeholder="Coupon">
                                                    <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                                                </div>
                                                <input class="aa-cart-view-btn" type="submit" value="Checkout">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>There is no Product in the Cart!</th>
                                        </tr>
                                    </thead>
                                </table>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->
<!-- <input type="hidden" id="qty" name="qty" value="1"> -->
<form id="AddtoCartForm">
    @csrf
    <input type="hidden" id="pid" name="product_id">
    <input type="hidden" id="attr_id" name="attr_id">
    <input type="hidden" id="size_id" name="size_id">
    <input type="hidden" id="color_id" name="color_id">
    <input type="hidden" id="pqty" name="product_qty">
    <input type="hidden" id="p_price" name="product_price">
    
</form>
@endsection