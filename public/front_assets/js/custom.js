/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       var filter_price_min = $('#sort_price_min').val();
       var filter_price_max = $('#sort_price_max').val();
       
       if(filter_price_min == '' || filter_price_max == ''){
        filter_price_min = 100;
        filter_price_max = 2400;
       }
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 300,
                '30%': 600,
                '40%': 900,
                '50%': 1200,
                '60%': 1500,
                '70%': 1800,
                '80%': 2100,
                '90%': 2400,
                'max': 2700
            },
            snap: true,
            connect: true,
            start: [filter_price_min, filter_price_max]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});

function ShowColoronSizeSelection(size){
  // alert(size);
  $('#size_id').val(size);
  $('.product_color_hide').hide();
  $('.color_of_'+size).show();
  // $('.product_color_hide').css('border','1px solid #ddd');
  $('.size').css('border','1px solid #ddd');
  $('#size_'+size).css('border','1px solid black');
}
function ShowProductsonColorSelection(img,color){
  $('#color_id').val(color);
  $('.color').css('border','1px solid #ddd');
  $('#color_'+color).css('border','2px solid red');
  $('.simpleLens-big-image-container').html('<a data-lens-image="{{@asset('+'storage/media/products/'+img+')}}" class="simpleLens-lens-image"><img src="{{@asset('+'storage/media/products/'+img+')}}" width="250px" height="300px" class="simpleLens-big-image"></a>');
}
function home_add_to_cart(ProductId,size_id,color_id,price){
  // alert($('#price').val());
  $('#product_id').val(ProductId);
  $('#size_id').val(size_id);
  $('#color_id').val(color_id);
  $('#product_qty').val($('#qty').val());
  $('#product_price').val(price);
  add_to_cart();
}
function porduct_detail_add_to_cart(ProductId,size_id,color_id){
  $('#product_id').val(ProductId);
  $('#product_qty').val($('#qty').val());
  $('#product_price').val($('#price').val());
  
  if(size_id == '0'){
    size_id = 'no';
  }
  if(color_id == '0'){
    color_id = 'no';
  }
  
  if( $('#size_id').val() == '' && size_id != 'no'){
   $('#add_to_cart_msg').html('<div class="alert alert-danger"><strong>Please!</strong> Please Select Size.</div>');
  }
  else if($('#color_id').val() == '' && color_id != 'no'){
    $('#add_to_cart_msg').html('<div class="alert alert-danger"><strong>Please!</strong> Please Select Color.</div>');
  }
  else{
    add_to_cart(ProductId,size_id,color_id);
  }
}

function updateQty(pid,attr_id,size,color,price){
  $('#pid').val(pid);
  $('#attr_id').val(attr_id);
  $('#size_id').val(size);
  $('#color_id').val(color);
  var qty = $('#qty_'+attr_id).val();
  $('#pqty').val(qty);
  $('#p_price').val(price);
  add_to_cart();
  var total_price = qty*price;
  $('#total_price_'+attr_id).html('Rs. '+total_price);
}

function add_to_cart(){
 
  $.ajax({
    url: '/add_to_cart',
    data: $('#AddtoCartForm').serialize(),
    type: 'post',
    success: function(result){
      alert('Product '+result['msg']);
      if(result['data'] == 0){
        $('.aa-cart-notify').html('0');
        $('.aa-cartbox-summary').remove();
      }
      else{
        $('.aa-cart-notify').html(result['totalCartItems']);
        var total_price = 0;
        var html='<ul>';
        $.each(result['data'],function(key,val){
          total_price = parseInt(total_price)+( parseInt(val.qty)*parseInt(val.price) );
         html+= '<li><a class="aa-cartbox-img" href="#"><img src="'+PRODUCT_IMAGE_PATH+'/'+val.product_image+'" alt="img" width="150px" height="150px"></a><div class="aa-cartbox-info"><h4><a href="#">'+val.product_name+'</a></h4><p>'+val.qty+' x Rs.'+val.price+'</div><a class="aa-remove-product" href="/product_remove_from_cart/'+val.attr_id+'"><span class="fa fa-times"></span></a></li>';
        });
        html+='<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price"> Rs.'+total_price+'</span></li>';
        html+='</ul> <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>';
        $('.aa-cartbox-summary').html(html);
      }
    }
  });
}
function sort_by(){
  var sort_by_value = $('#sort_by_value').val();
  $('#sort').val(sort_by_value);
  $('#CategoryFilter').submit();
}

function sort_by_price_filter(){
  var start = $('#skip-value-lower').html();
  var end = $('#skip-value-upper').html();
  $('#sort_price_min').val(start);
  $('#sort_price_max').val(end);
  $('#CategoryFilter').submit();

}

function sort_by_color(color_id, type){
  var colorFilter = $('#color_filter').val();

  if(colorFilter == ''){
    $('#color_filter').val(color_id);
  }
  else{
    if(type == 0){
      $('#color_filter').val(color_id+':'+colorFilter);
    }
   else{
     var color_str= colorFilter.replace(color_id+':','');
    $('#color_filter').val(color_str);
    
   }
  }
  $('#CategoryFilter').submit();
  
}

function searchForm(){
  var str = $('#str').val();
  if(str != '' && str.length > 2){
    window.location.href= '/search/'+str;
  }
}