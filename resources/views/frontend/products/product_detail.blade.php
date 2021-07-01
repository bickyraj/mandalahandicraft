@extends('frontend.layouts.app')
@push('css')
   <style>
        #star-1:checked ~ section [for='star-1'] svg, #star-2:checked ~ section [for='star-1'] svg, #star-2:checked ~ section [for='star-2'] svg, #star-3:checked ~ section [for='star-1'] svg, #star-3:checked ~ section [for='star-2'] svg, #star-3:checked ~ section [for='star-3'] svg, #star-4:checked ~ section [for='star-1'] svg, #star-4:checked ~ section [for='star-2'] svg, #star-4:checked ~ section [for='star-3'] svg, #star-4:checked ~ section [for='star-4'] svg, #star-5:checked ~ section [for='star-1'] svg, #star-5:checked ~ section [for='star-2'] svg, #star-5:checked ~ section [for='star-3'] svg, #star-5:checked ~ section [for='star-4'] svg, #star-5:checked ~ section [for='star-5'] svg {
          -webkit-transform: scale(1);
          transform: scale(1);
        }

        #star-1:checked ~ section [for='star-1'] svg path, #star-2:checked ~ section [for='star-1'] svg path, #star-2:checked ~ section [for='star-2'] svg path, #star-3:checked ~ section [for='star-1'] svg path, #star-3:checked ~ section [for='star-2'] svg path, #star-3:checked ~ section [for='star-3'] svg path, #star-4:checked ~ section [for='star-1'] svg path, #star-4:checked ~ section [for='star-2'] svg path, #star-4:checked ~ section [for='star-3'] svg path, #star-4:checked ~ section [for='star-4'] svg path, #star-5:checked ~ section [for='star-1'] svg path, #star-5:checked ~ section [for='star-2'] svg path, #star-5:checked ~ section [for='star-3'] svg path, #star-5:checked ~ section [for='star-4'] svg path, #star-5:checked ~ section [for='star-5'] svg path {
          fill: #FFBB00;
          stroke: #cc9600;
        }

        section {
          width: 300px;
          text-align: center;
          margin-top: 10px;
          margin-left: -30px;

         /* -webkit-transform: translate3d(-50%, -50%, 0);
          transform: translate3d(-50%, -50%, 0);*/
        }

        label {
          display: inline-block;
          width: 50px;
          text-align: center;
          cursor: pointer;
        }

        label svg {
          width: 50%;
          height: auto;
          fill: white;
          stroke: #CCC;
          -webkit-transform: scale(0.8);
          transform: scale(0.8);
          -webkit-transition: -webkit-transform 200ms ease-in-out;
          transition: -webkit-transform 200ms ease-in-out;
          transition: transform 200ms ease-in-out;
          transition: transform 200ms ease-in-out, -webkit-transform 200ms ease-in-out;
        }

        label svg path {
          -webkit-transition: fill 200ms ease-in-out, stroke 100ms ease-in-out;
          transition: fill 200ms ease-in-out, stroke 100ms ease-in-out;
        }

        label[for="star-null"] {
          display: block;
          margin: 0 auto;
          color: #999;
        }

       .prd-block_title {
           font-size: 18px !important;
       }

        .slick-active.active, .slick-active, .slick-next {
            cursor: pointer !important;
        }

       .related-products .slick-prev, .related-products .slick-next {
            top: 160px;
       }

       .related-products .slick-slide {
           margin-bottom: 0;
           max-height: 360px;
       }

       .js-list-filter img {
           min-height: 50px;
       }

       .shop-feature {
           height: auto !important;
       }

       .slick-slide {
           height: auto !important;
       }

       .prd-label-warning {
           color: #ffc427 !important;
           border-color: #ffc427 !important;
       }
   </style>
@endpush
@section('content')
    <div class="page-content">
        <div class="holder" style="margin-top: 0px !important;">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{ url('category') }}/{{ $product->category->slug }}">{{ucwords($product->category->name)}}</a></li>
                    <li><span>{{ucwords($product->title)}}</span></li>
                </ul>
            </div>
        </div>
        <div class="holder" style="margin-top: 0px !important;">
            <div class="container">
                <div class="row prd-block prd-block--mobile-image-first js-prd-gallery" id="prdGallery100">
                    <div class="col-md-6 col-xl-5">
                        <div class="prd-block_info js-prd-m-holder mb-2 mb-md-0"></div><!-- Product Gallery -->
                        <div class="prd-block_main-image main-image--slide js-main-image--slide">
                            <div class="prd-block_main-image-holder js-main-image-zoom" data-zoomtype="inner">
                                <div class="prd-block_main-image-video js-main-image-video"><video loop muted preload="metadata" controls="controls">
                                        <source src="https://www.youtube.com/watch?v=LnFl7xzfoNY"></video>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-has-loader">
                                    <div class="gdw-loader"></div>
                                    <img id="productPreviewImage" src="{{ getProductImage($product->id) }}"
                                         class="zoom" alt="" data-zoom-image="{{ getProductImage($product->id) }}">
                                </div>
                                <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                                <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                            </div>
                            <div class="prd-block_main-image-links">
                                @if($product->video_url)
                                    <a data-fancybox data-width="900" href="{{ $product->video_url }}"
                                    class="prd-block_video-link"><i class="icon icon-play"></i></a>
                                @endif
                                <a href="images/products/large/product-01.jpg" class="prd-block_zoom-link">
                                    <i class="icon icon-zoomin"></i></a>
                            </div>
                        </div>
                        <div class="product-previews-wrapper">
                            <div class="product-previews-carousel" id="previewsGallery100">
                                @if($product->product_type == 1)
                                    @if(isset($product->color_product_images) && $product->color_product_images->count())
                                        @foreach($product->color_product_images as $image)
                                            <a class="color-image color-image-{{ $image->color_id }}"  href="#" data-value="{{ $image->color_id }}" data-image="{{ $image->modified_image() }}" data-zoom-image="{{ $image->image() }}">
                                                <img src="{{ $image->modified_image() }}" alt="">
                                            </a>
                                        @endforeach
                                    @endif
                                @endif

                                @if($product->product_type == 0)
                                    @if(isset($product->images) && $product->images->count())
                                        @foreach($product->images as $image)
                                            <a class="color-image color-image-0"  href="#" data-image="{{ $image->modified_image() }}" data-zoom-image="{{ $image->image() }}">
                                                <img src="{{ $image->modified_image() }}" alt="">
                                            </a>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <!-- /Product Gallery -->
                    </div>
                    <div class="col-md-5 col-xl-4">
                        <div class="prd-block_info">
                            <div class="js-prd-d-holder prd-holder">
                                <div class="prd-block_title-wrap">
                                    <h1 class="prd-block_title">{{$product->title}}</h1>

                                    <div class="prd-block__labels">
                                        @if($product->quantity === 0)
                                            <span class="prd-label--new prd-label-warning">Out of stock!</span>
{{--                                            <div class="btn-wrap float-right" style="color:red">Out of stock!</div>--}}
                                        @else
                                            @if($product->special())
                                                <span class="prd-label--new">{{$product->get_sale_status()}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="prd-block_info-top">
{{--                                    <div class="product-sku">SKU: <span>#0005</span></div>--}}
                                    <div class="prd-rating">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                        <span>{{ $product->reviews->count() }} reviews</span>
                                    </div>
                                    <div class="prd-availability">Availability: <span>{{$product->quantity}} items</span></div>
                                </div>
                                @if($product->short_description)
                                    <div class="prd-block_description topline">
                                        {!! $product->short_description !!}
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('add_to_cart', $product->slug) }}" method="post">
                                @csrf
                                <div class="prd-block_options topline">

                                @if($product->hasColor())
                                    <div class="prd-color swatches"><span class="option-label">Color:</span>
                                        <select class="form-control input-sm" name="color" id="colorSelector">

                                            @if(isset($product->colors) && $product->colors->count())
                                                @foreach($product->colors as $color)
                                                    <option value="{{ $color->id }}" @if ($loop->first) selected="" @endif>{{ $color->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <ul class="color-list color-list--sm js-list-filter">
                                            @if(isset($product->colors) && $product->colors->count())
                                                @foreach($product->colors as $color)
                                                    <li class="@if ($loop->first) active @endif"><a href="#" data-toggle="tooltip" data-placement="top" title="{{ $color->name }}" data-value="{{ $color->id }}" data-image="{{ $color->modified_image() }}"><span class="value">
                                                                <img style="height: 92%; max-height: 50px" src="{{ $color->modified_image() }}" alt="">
                                                            </span></a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @else
                                    <input type="hidden" value="0" id="colorSelector">
                                @endif

                                @if($product->hasSize())
                                    <div class="prd-size swatches"><span class="option-label">Size:</span>
                                        <input type="hidden" name="size" id="selectSizeData" value="">
                                            <ul class="size-list select-size-list">
                                                @foreach($product->sizes as $k=>$v)
                                                    <li><a href="#" data-value="{{$v->id}}"><span class="value {{$k==0?'active-span':''}}">{{$v->size}}</span></a></li>
                                                @endforeach

                                            </ul>

                                        @if(isset($product->image) && $product->image !== null)
                                            <div class="option-links"><a href="#" data-fancybox data-src="#sizeGuide">SIZE GUIDE</a></div>
                                            <div class="modal--simple modal--lg" id="sizeGuide" style="display: none;">
                                                <div class="modal-header">
                                                    <div class="modal-header-title">SIZE GUIDE</div>
                                                </div>
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img style="width: 100%" src="{{ url('uploads/products') }}/{{ $product->image }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                    <div class="qty qty-changer">
                                        <fieldset>
                                            <input type="button" value="&#8210;" class="decrease">
                                            <input name="quantity" readonly type="text" class="qty-input" value="1" data-min="1" data-max="{{$product->quantity}}"> <input type="button" value="+" class="increase"></fieldset>
                                    </div><span class="option-label">max <span class="qty-max">{{$product->quantity}}</span> item(s)</span>
                                </div>
                            </div>

                                <div class="prd-block_actions topline">
                                <div class="prd-block_price"><span class="prd-block_price--actual">Rs.{{$product->sellingPrice()}}</span> <span class="prd-block_price--old">Rs.{{$product->user_price}}</span></div>
                                @if($product->quantity>0)
                                    <div class="btn-wrap">
                                        <button type="submit"


                                                title="Add to Cart"
                                                class="btn btn--add-to-cart"><i class="icon icon-handbag"></i><span>Add to cart</span></button>
                                    </div>
                                @else

                                @endif
                                <div class="prd-block_link"><a href="javascript:void(0)" data-url="{{route('add.wish',$product->id)}}" class="icon-heart-1 js-label-wishlist"></a> </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3 mt-3 mt-xl-0 sidebar-product">
                        <div class="shop-features-style4"><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">Free shipping inside Ring Road</div>
                                    <div class="text2"></div>
                                </div>
                            </a><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">100% money back guarantee</div>
                                    <div class="text2"></div>
                                </div>
                            </a><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-call"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">24/7 customer support</div>
                                    <div class="text2"></div>
                                </div>
                            </a></div>

                            <div class="js-countdown-wrap">
                                @if($product->hasPercentageDiscountType())
                                    <div class="promo-text">
                                        <div><span class="text2">DISCOUNT</span> <span class="text1"> {{$product->discount}}% OFF</span></div>
                                        <div class="text3">Have time to buy!</div>
                                    </div>
                                @endif

                                @if($product->hasAmountDiscountType())
                                    <div class="promo-text">
                                        <div>
                                            <span class="text2">DISCOUNT</span>
                                            <span class="text1"> RS {{$product->discount}} OFF</span>
                                        </div>
                                        <div class="text3">Have time to buy!</div>
                                    </div>
                                @endif
                            </div>
                        <hr>

                        <div class="card">
                            <div class="card-header">
                                <h4>Seller</h4>
                                <h5>
                                    <a href="{{ route('vendor.product', [strtolower($product->vendor->name), makeEncrypt($product->vendor->id)]) }}">{{ $product->vendor->name }}</a>
                                </h5>

                            </div>
                            <div class="card-footer">
                                <a href="{{ route('vendor.product', [strtolower($product->vendor->name), makeEncrypt($product->vendor->id)]) }}" class="text-primary">VISIT STORE</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="holder mt-2 mt-sm-5">
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs product-tab">
                        <li class="nav-item"><a href="#Tab1" class="nav-link" data-toggle="tab">Description</a></li>
                        <li class="nav-item"><a href="#Tab6" class="nav-link" data-toggle="tab">Reviews</a></li>
                    </ul><!-- Tab panes -->

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="Tab1">
                            <div class="product-description">
                                <?= $product->description ?>
                            </div>
                            <div class="product-specification">
                                <?= $product->specification ?>
                                <div style="clear: both;"></div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="Tab6" style="width: 100%">
                            <div id="productReviews">
                                @if($product->reviews->count()>0)
                                    <div class="prd-rating">
                                        <div class="rateYo" data-rateyo-star-width="24px" data-rateyo-rating="{{ $product->rating() }}"></div>

{{--                                        @for($i=1;$i<=5;$i++)--}}
{{--                                            @if($i <= $product->rating())--}}
{{--                                                <i class="icon-star fill"></i>--}}
{{--                                            @else--}}
{{--                                                <i class="icon-star"></i>--}}
{{--                                            @endif--}}
{{--                                        @endfor--}}

                                        <span> Based on {{$product->reviews->count()}} review</span>

                                    </div>
                                @endif
                                @if($product->reviews->count()>0)
                                    @foreach($product->reviews as $review)
                                        <div class="review-item">
                                            <h4 class="review-item_author">{{optional($review->user)->name}}</h4>
                                            <div class="review-item_rating">
                                                @for($i=1;$i<=5;$i++)
                                                    @if($i <= ($review->rating))
                                                        <i class="icon-star fill"></i>
                                                    @else
                                                        <i class="icon-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p>{{$review->review}}</p>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="respond" class="comment-respond">
                                    <h3 id="reply-title" class="comment-reply-title btn-decor">Submit your review</h3>
                                    <form action="{{route('review.store')}}" method="post" id="commentform" class="comment-form" >
                                        @csrf
                                        <input type="hidden" name="product_slug" value="{{$product->slug}}">

                                        <div class="bsb-rating">

                                            <input type="radio" name="rating" id="star-null" value="0" />
                                            <input type="radio" name="rating" id="star-1" value="1"  />
                                            <input type="radio" name="rating" id="star-2" value="2" />
                                            <input type="radio" name="rating" id="star-3"  value="3" />
                                            <input type="radio" name="rating" id="star-4"  value="4" />
                                            <input type="radio" name="rating" id="star-5" value="5" />
                                            <section>
                                                <label for="star-1"> <svg width="255" height="240" viewBox="0 0 51 48">
                                                        <path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                                    </svg> </label>
                                                <label for="star-2"> <svg width="255" height="240" viewBox="0 0 51 48">
                                                        <path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                                    </svg> </label>
                                                <label for="star-3"> <svg width="255" height="240" viewBox="0 0 51 48">
                                                        <path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                                    </svg> </label>
                                                <label for="star-4"> <svg width="255" height="240" viewBox="0 0 51 48">
                                                        <path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                                    </svg> </label>
                                                <label for="star-5"> <svg width="255" height="240" viewBox="0 0 51 48">
                                                        <path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                                    </svg> </label>
                                                <!-- <label for="star-null"> Clear </label> -->
                                            </section>
                                        </div>


                                        <p class="comment-form-comment">
                                            <label for="comment">Comment</label>
                                            <textarea rows="50" style="height: 100px"  name="review" class="form-control" required="true"></textarea>


                                        </p>

                                        <p class="form-submit">
                                            <button type="submit" class="btn">Submit</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $relatedProducts = getRelatedProducts($product->category_id); ?>
        <div class="holder">
            <div class="container">
                <div class="title-wrap text-center">
                    <h2 class="h1-style">RELATED PRODUCTS</h2>
                </div>
                <div class="related-products prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                    @if($relatedProducts->count())
                        @foreach($relatedProducts as $product)
                            <div class="prd prd-has-loader">
                                <div class="prd-inside">
                                    <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                        @if($product->discounted_price != $product->user_price)
                                            <div class="label-sale">-{{ $product->total_discount }}</div>
                                        @endif
                                        <div class="label-new"></div><a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist"></a>
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">RS {{ $product->discounted_price }}</div>

                                            @if($product->discounted_price != $product->user_price)
                                                <div class="price-old">RS {{ $product->user_price }}</div>
                                            @endif
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                {{--                                            <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="more-link-wrapper text-center"><a href="{{ url('category') }}" class="btn-decor">show all</a></div>
            </div>
        </div>
    </div>

    <button id="success_msg" style="display: none"  class="btn btn--add-to-cart hidden" data-fancybox="" data-src="#bsb-cart-modal"><i class="icon icon-handbag"></i><span>Add to cart</span></button>
    @include('frontend.cart.cart_message')

@endsection
<style type="text/css">
    .active-span {
        border-color: #27c7d8 !important;
        color: #27c7d8 !important;
    }
</style>
@push('script')
<script type="text/javascript">
    $(function(){
        $(".rateYo").rateYo({
            readOnly: true,
            ratedFill: '#27c7d8',
        });

        let wrapper = $("#previewsGallery100");

        selectColor();

        @if(session()->has('success_message'))

        // $("#success_msg").click();

        @endif


        $(document).on("click", ".select-size-list li", function(event){

            event.preventDefault();
            let sizeValue = $(this).find('a').attr('data-value');

            let selectSizeData = $("#selectSizeData");
            selectSizeData.val(sizeValue);

            $(".select-size-list").find('li span').removeClass("active-span");
            $(this).find("span").addClass("active-span");
        });


        function selectColor()
        {
            let sizeValue = $('.select-size-list li').find('a').attr('data-value');
            let selectSizeData = $("#selectSizeData");
            selectSizeData.val(sizeValue);
        }


        // let color = $("#colorSelector").val();
        // showHideImage(color);
        // $(document).on("click",".color-list a", function(){
        //     let color = $(this).data('value');
        //     showHideImage(color);
        // });
        //
        // function showHideImage(color) {
        //     // destroyCarousel();
        //     let images = '';
        //
        //     $(".color-product-images-"+color).each(function(key,val){
        //        images += $(this).html();
        //     });
        //
        //     wrapper.html(images);
        //     let colorImgSelector = $(".color-image-"+color);
        //     let imageSrc = colorImgSelector.first().find('img').attr('src');
        //
        //     colorImgSelector.first().click();
        //
        //     colorImgSelector.first().addClass('slick-active active');
        //     $("#productPreviewImage").attr('src', imageSrc);
        //
        //     $("#productPreviewImage").attr('data-zoom-image', imageSrc);
        //
        //
        //     // slickCarousel();
        // }
        //
        // function destroyCarousel() {
        //     if (wrapper.hasClass('slick-initialized')) {
        //         wrapper.slick('unslick');
        //         wrapper.html("");
        //     }
        // }
        //
        //
        //
        // function slickCarousel() {
        //     wrapper.slick({
        //     	slidesToShow: 4,
        //     	slidesToScroll: 1,
        //     	dots: false,
        //     	infinite: false, //don't change
        //     	// vertical: $this.closest(_.data.verticalSelector).length ? true : false,
        //     	// swipe: swipemode,
        //     	// responsive: [{
        //     	// 	breakpoint: maxMD,
        //     	// 	settings: {
        //     	// 		vertical: false
        //     	// 	}
        //     	// }, {
        //     	// 	breakpoint: maxXS,
        //     	// 	settings: {
        //     	// 		slidesToShow: 3
        //     	// 	}
        //     	// }]
        //     });
        //
        // }
        //
        // function showZoomImage() {
        //     let items = [];
        //     wrapper.find('[data-zoom-image]').each(function () {
        //         var $this = $(this),
        //             src = $this.attr('data-zoom-image'),
        //             image = {};
        //         image["src"] = src;
        //         image["opts"] = {
        //             thumb: src,
        //             caption: $this.find('img').attr('alt')
        //         };
        //         items.push(image);
        //     });
        //
        //
        //     $.fancybox.open(items, {
        //         loop: false,
        //         animationEffect: "zoom",
        //         touch: false,
        //         buttons: ["close"],
        //         thumbs: {
        //             autoStart: true
        //         },
        //         arrows: false,
        //         beforeShow: function (instance, slide) {
        //             $(".fancybox-container").last().addClass("fancybox--light");
        //         }
        //     });
        //
        //     $(".fancybox-container").hide();
        //
        // }
        //
        //
        // $(document).on("click", ".prd-block_zoom-link", function(e){
        //     e.preventDefault();
        //     showZoomImage();
        // });
    });
</script>


@endpush
