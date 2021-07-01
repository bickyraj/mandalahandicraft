@extends('frontend.layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@section('content')
    <!-- BN Slider 1 -->
    <div class="holder fullwidth full-nopad mt-0">
        <div class="container">
            <div class="bnslider-wrapper">

                @if($sliders->count())
                    <div class="bnslider bnslider--lg bnslider--darkarrows keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="false" data-speed="5000" data-start-width="1920" data-start-height="815" data-start-mwidth="480" data-start-mheight="578">
                        @foreach($sliders as $slider)
                            <a href="{{ $slider->url }}">
                                <div class="bnslider-slide bnslide-fashion-4">
                                    <div class="bnslider-image-mobile" style="background-image: url('{{ $slider->mobile_image() }}');"></div>
                                    <div class="bnslider-image" style="background-image: url('{{ $slider->modified_image() }}');"></div>
                                    <div class="bnslider-text-wrap bnslider-overlay">
                                        <div class="bnslider-text-content txt-middle txt-right">
                                            <div class="bnslider-text-content-flex">
                                                <div class="bnslider-vert w-50 mx-0">
                                                    <div class="bnslider-text bnslider-text--lg text-center" data-animation="popIn" data-animation-delay=".8s" style="color: #ffc501;">{{ $slider->offer_title }}</div>
                                                    <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #000; font-weight: 300;">{{ $slider->title }}</div>
                                                    <div class="bnslider-text bnslider-text--xs text-center" data-animation="zoomIn" data-animation-delay="1.6s" style="color: #ffc501;">{{ $slider->sub_title }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @push('script')
                        <script>
                            $('body').addClass('has-slider');
                        </script>
                    @endpush
                @endif


                <div class="bnslider-loader">
                    <div class="loader-wrap">
                        <div class="dots">
                            <div class="dot one"></div>
                            <div class="dot two"></div>
                            <div class="dot three"></div>
                        </div>
                    </div>
                </div>
                <div class="bnslider-arrows container-fluid">
                    <div></div>
                </div>
                <div class="bnslider-dots vert-dots container-fluid"></div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">Featured Products</h2>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @if($featuredProducts->count())
                    @foreach($featuredProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img">
                                        <img src="{{ asset('products/images/products/product-placeholder.png') }}" data-srcset="{{ getProductImage($product->id) }}" srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload">
                                    </a>
                                    @if($product->quantity === 0)
                                        <div class="label-outstock">OUT OF STOCK</div>
                                    @else
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    @endif
                                    <div class="label-new"></div>
                                    <a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist @if($product->wish_list !== null) active @endif"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                    <div class="prd-rating prd-hidemobile">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                    </div>
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
        </div>
        <div class="more-link-wrapper text-center">
            <a href="{{ url('category') }}" class="btn-decor">show all</a>
        </div>
    </div>

    <!-- Flash Sale -->
    <div class="holder">
        <div class="container">
            <h3 class="h1-style text-center">Flash Sale</h3>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @if($saleProducts->count())
                    @foreach($saleProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                    @if($product->quantity === 0)
                                        <div class="label-outstock">OUT OF STOCK</div>
                                    @else
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    @endif
                                    <div class="label-new"></div>
                                    <a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist @if($product->wish_list !== null) active @endif">

                                    </a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                    <div class="prd-rating prd-hidemobile">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                    </div>
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
        </div>
        <div class="more-link-wrapper text-center">
            <a href="{{ url('category') }}" class="btn-decor">show all</a>
        </div>
    </div>

    <!-- Popular Products -->
    <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">Popular Sale</h2>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @if($popularProducts->count())
                    @foreach($popularProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                    @if($product->quantity === 0)
                                        <div class="label-outstock">OUT OF STOCK</div>
                                    @else
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    @endif
                                    <div class="label-new"></div><a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist @if($product->wish_list !== null) active @endif"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                    <div class="prd-rating prd-hidemobile">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                    </div>
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
        </div>

        <div class="more-link-wrapper text-center">
            <a href="{{ url('category') }}" class="btn-decor">show all</a>
        </div>
    </div>

    <!-- Hot Products -->
    <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">Hot Sale</h2>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @if($newProducts->count())
                    @foreach($newProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                    @if($product->quantity === 0)
                                        <div class="label-outstock">OUT OF STOCK</div>
                                    @else
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    @endif
                                    <div class="label-new"></div><a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist @if($product->wish_list !== null) active @endif"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                    <div class="prd-rating prd-hidemobile">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                    </div>
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
        </div>
        <div class="more-link-wrapper text-center">
            <a href="{{ url('category') }}" class="btn-decor">show all</a>
        </div>
    </div>

    <!-- All Products -->
    <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">All Products</h2>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @if($allProducts->count())
                    @foreach($allProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                    @if($product->quantity === 0)
                                        <div class="label-outstock">OUT OF STOCK</div>
                                    @else
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    @endif
                                    <div class="label-new"></div><a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist @if($product->wish_list !== null) active @endif"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>
                                    <div class="prd-rating prd-hidemobile">
                                        <div class="rateYo" data-rateyo-star-width="16px" data-rateyo-rating="{{ $product->rating() }}"></div>
                                    </div>
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
        </div>
        <div class="more-link-wrapper text-center">
            <a href="{{ url('category') }}" class="btn-decor">show all</a>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".rateYo").rateYo({
                readOnly: true,
                ratedFill: '#27c7d8',
            });
        });
    </script>
@endpush
