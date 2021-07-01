@extends('frontend.layouts.app')


@section('content')
    <!-- BN Slider 1 -->
    <div class="holder fullwidth full-nopad mt-0" style="margin-top: 0 !important;">
        <div class="container">
            <div class="bnslider-wrapper">

                @if($sliders->count())
                    <div class="bnslider bnslider--lg bnslider--darkarrows keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="false" data-speed="5000" data-start-width="1920" data-start-height="815" data-start-mwidth="480" data-start-mheight="578">
                        @foreach($sliders as $slider)
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
{{--    <div class="holder product-holder">--}}
    <div class="holder">
{{--        <div class="container">--}}
{{--            <div class="title-with-right">--}}
{{--                <h3 class="h1-style">Featured Products</h3>--}}
{{--                <div class="prd-carousel-tabs" data-grid="tabCarousel-01">--}}
{{--                    <a href="{{ url('category') }}" class="btn-decor">show all</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>--}}
{{--                @if($featuredProducts->count())--}}
{{--                    @foreach($featuredProducts as $product)--}}
{{--                        <div class="prd prd-has-loader">--}}
{{--                            <div class="prd-inside">--}}
{{--                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img">--}}
{{--                                        <img src="{{ asset('products/images/products/product-placeholder.png') }}" data-srcset="{{ getProductImage($product->id) }}" srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload">--}}
{{--                                    </a>--}}
{{--                                    @if($product->discounted_price != $product->user_price)--}}
{{--                                        <div class="label-sale">-{{ $product->total_discount }}</div>--}}
{{--                                    @endif--}}
{{--                                    <div class="label-new"></div>--}}
{{--                                    <a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist"></a>--}}
{{--                                    <div class="gdw-loader"></div>--}}
{{--                                </div>--}}
{{--                                <div class="prd-info">--}}
{{--                                    <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a></h2>--}}
{{--                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>--}}
{{--                                    <div class="prd-price">--}}
{{--                                        <div class="price-new">RS {{ $product->discounted_price }}</div>--}}

{{--                                        @if($product->discounted_price != $product->user_price)--}}
{{--                                            <div class="price-old">RS {{ $product->user_price }}</div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <div class="prd-hover">--}}
{{--                                        <div class="prd-action">--}}
{{--                                            <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="container">
            <h2 class="h1-style text-center">New Arrival</h2>
            <div class="prd-carousel-tabs justify-content-center js-filters-prd d-none d-md-flex" data-grid="tabCarousel-01"><span class="active" data-filter="prd">All</span> <span data-filter="prd-popular">Popular</span> <span data-filter="prd-sale">Sale</span> <span data-filter="prd-new">New</span></div>
            <div class="prd-carousel-tabs js-filters-prd-sm d-md-none"><span class="filters-label active" data-filter=".prd">All</span> <span class="filters-label" data-filter=".prd-popular">Popular</span> <span class="filters-label" data-filter=".prd-sale">Sale</span> <span class="filters-label" data-filter=".prd-new">New</span></div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm slick-initialized slick-slider" id="tabCarousel-01" data-slick="{&quot;slidesToShow&quot;: 4, &quot;slidesToScroll&quot;: 4}"><button class="slick-prev slick-arrow slick-disabled" aria-label="Previous" type="button" aria-disabled="true">Previous</button>
                <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2344px; transform: translate3d(0px, 0px, 0px);"><div class="prd prd-has-loader prd prd-new slick-slide slick-current slick-active loaded" data-slick-index="0" aria-hidden="false" style="width: 283px;" tabindex="0">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-67.jpg" alt="Boxing gloves" class="js-prd-img lazyloaded" srcset="images/products/product-67.jpg"></a>
                                    <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="0"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="0">adidas</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="0">Boxing gloves</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 55.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="0"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="0"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="0"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-new prd-popular slick-slide slick-active loaded" data-slick-index="1" aria-hidden="false" style="width: 283px;" tabindex="0">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-68.jpg" alt="Skates" class="js-prd-img lazyloaded" srcset="images/products/product-68.jpg"></a>
                                    <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="0"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="0">nike</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="0">Skates</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 90.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="0"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="0"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="0"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-sale prd-has-countdown slick-slide slick-active loaded" data-slick-index="2" aria-hidden="false" style="width: 283px;" tabindex="0">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-69.jpg" alt="Backpack" class="js-prd-img lazyloaded" srcset="images/products/product-69.jpg"></a>
                                    <div class="label-sale">-41%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="0"></a>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="images/products/product-69.jpg" class="active"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-69.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-69.jpg"></a></li>
                                        <li data-image="images/products/product-69-2.jpg"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-69-2.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-69-2.jpg"></a></li>
                                        <li data-image="images/products/product-69-3.jpg"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-69-3.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-69-3.jpg"></a></li>
                                        <li data-image="images/products/product-69-4.jpg"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-69-4.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-69-4.jpg"></a></li>
                                    </ul>
                                    <div class="countdown-box">

                                    </div>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="0">nike</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="0">Backpack</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 50.00</div>
                                        <div class="price-old">$ 85.00</div>
                                        <div class="price-comment">You save $ 40.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="0"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="0"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="0"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-sale prd-has-countdown slick-slide slick-active loaded" data-slick-index="3" aria-hidden="false" style="width: 283px;" tabindex="0">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-65.jpg" alt="Bike helmet" class="js-prd-img lazyloaded" srcset="images/products/product-65.jpg"></a>
                                    <div class="label-sale">-55%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="0"></a>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="images/products/product-65.jpg" class="active"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-65.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-65.jpg"></a></li>
                                        <li data-image="images/products/product-65-2.jpg"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-65-2.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-65-2.jpg"></a></li>
                                        <li data-image="images/products/product-65-3.jpg"><a href="#" class="js-color-toggle" tabindex="0"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-65-3.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-65-3.jpg"></a></li>
                                    </ul>
                                    <div class="countdown-box">

                                    </div>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="0">nike</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="0">Bike helmet</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 40.00</div>
                                        <div class="price-old">$ 90.00</div>
                                        <div class="price-comment">You save $ 50.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="0"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="0"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="0"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-sale prd-popular prd-has-countdown slick-slide loaded" data-slick-index="4" aria-hidden="true" style="width: 283px;" tabindex="-1">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-61.jpg" alt="Skateboard" class="js-prd-img lazyloaded" srcset="images/products/product-61.jpg"></a>
                                    <div class="label-sale">-23%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="-1"></a>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="images/products/product-61.jpg" class="active"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-61.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-61.jpg"></a></li>
                                        <li data-image="images/products/product-61-2.jpg"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-61-2.jpg" class=" lazyloaded" alt="Color Name" srcset="images/products/xsmall/product-61-2.jpg"></a></li>
                                    </ul>
                                    <div class="countdown-box">

                                    </div>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="-1">reebok</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="-1">Skateboard</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 77.00</div>
                                        <div class="price-old">$ 100.00</div>
                                        <div class="price-comment">You save $ 23.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="-1"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="-1"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="-1"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-popular slick-slide loaded" data-slick-index="5" aria-hidden="true" style="width: 283px;" tabindex="-1">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-70.jpg" alt="Boxing helmet" class="js-prd-img lazyloaded" srcset="images/products/product-70.jpg"> </a><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="-1"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="-1">nike</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="-1">Boxing helmet</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 60.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="-1"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="-1"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="-1"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-new slick-slide loaded" data-slick-index="6" aria-hidden="true" style="width: 283px;" tabindex="-1">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-71.jpg" alt="Training apparatus" class="js-prd-img lazyloaded" srcset="images/products/product-71.jpg"></a>
                                    <div class="label-new">NEW</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="-1"></a>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="-1">adidas</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="-1">Training apparatus</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 240.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="-1"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="-1"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="-1"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><div class="prd prd-has-loader prd prd-sale prd-popular prd-has-countdown slick-slide loaded" data-slick-index="7" aria-hidden="true" style="width: 283px;" tabindex="-1">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="product.html" class="prd-img" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/product-72.jpg" alt="Water cap" class="js-prd-img lazyload"></a>
                                    <div class="label-sale">-66%</div><a href="#" class="label-wishlist icon-heart js-label-wishlist" tabindex="-1"></a>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="images/products/product-72.jpg" class="active"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-72.jpg" class="lazyload" alt="Color Name"></a></li>
                                        <li data-image="images/products/product-72-2.jpg"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-72-2.jpg" class="lazyload" alt="Color Name"></a></li>
                                        <li data-image="images/products/product-72-3.jpg"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-72-3.jpg" class="lazyload" alt="Color Name"></a></li>
                                        <li data-image="images/products/product-72-4.jpg"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-72-4.jpg" class="lazyload" alt="Color Name"></a></li>
                                        <li data-image="images/products/product-72-5.jpg"><a href="#" class="js-color-toggle" tabindex="-1"><img src="images/products/product-placeholder.png" data-srcset="images/products/xsmall/product-72-5.jpg" class="lazyload" alt="Color Name"></a></li>
                                    </ul>
                                    <div class="countdown-box">

                                    </div>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <div class="prd-tag prd-hidemobile"><a href="#" tabindex="-1">nike</a></div>
                                    <h2 class="prd-title"><a href="product.html" tabindex="-1">Water cap</a></h2>
                                    <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 5.00</div>
                                        <div class="price-old">$ 15.00</div>
                                        <div class="price-comment">You save $ 10.00</div>
                                    </div>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden" tabindex="-1"> <button class="btn" data-fancybox="" data-src="#modalCheckOut" tabindex="-1"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox="" data-src="#modalQuickView" tabindex="-1"></a></div>
                                        </div>
                                        <div class="prd-options prd-hidemobile"><span class="label-options">Sizes:</span>
                                            <ul class="list-options size-swatch">
                                                <li class="active"><span>xs</span></li>
                                                <li><span>s</span></li>
                                                <li><span>m</span></li>
                                                <li><span>l</span></li>
                                                <li><span>xl</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div></div>







                <button class="slick-next slick-arrow" aria-label="Next" type="button" aria-disabled="false">Next</button></div>
            <div class="more-link-wrapper text-center"><a href="#" class="btn-decor">show all</a></div>
        </div>
        
    </div>

    <!-- Flash Sale -->
    <div class="holder product-holder">
        <div class="container">
            <div class="title-with-right">
                <h3 class="h1-style">Flash Sale</h3>
                <div class="prd-carousel-tabs" data-grid="tabCarousel-01">
                    <a href="{{ url('category') }}" class="btn-decor">show all</a>
                </div>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                @if($saleProducts->count())
                    @foreach($saleProducts as $product)
                        <div class="prd prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area"><a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="{{ getProductImage($product->id) }}" data-srcset="{{ getProductImage($product->id) }}" alt="Glamor shoes" class="js-prd-img lazyload"></a>
                                    @if($product->discounted_price != $product->user_price)
                                        <div class="label-sale">-{{ $product->total_discount }}</div>
                                    @endif
                                    <div class="label-new"></div>
                                    <a href="#" data-url="{{route('add.wish',$product->id)}}" class="label-wishlist icon-heart js-label-wishlist">

                                    </a>
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
        </div>
    </div>

    <!-- Popular Products -->
    <div class="holder product-holder">
        <div class="container">
            <div class="title-with-right">
                <h3 class="h1-style">Popular Sale</h3>
                <div class="prd-carousel-tabs" data-grid="tabCarousel-01">
                    <a href="{{ url('category') }}" class="btn-decor">show all</a>
                </div>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                @if($popularProducts->count())
                    @foreach($popularProducts as $product)
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
        </div>
    </div>

    <!-- Hot Products -->
    <div class="holder product-holder">
        <div class="container">
            <div class="title-with-right">
                <h3 class="h1-style">Hot Sale</h3>
                <div class="prd-carousel-tabs" data-grid="tabCarousel-01">
                    <a href="{{ url('category') }}" class="btn-decor">show all</a>
                </div>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                @if($newProducts->count())
                    @foreach($newProducts as $product)
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
        </div>
    </div>

    <!-- All Products -->
    <div class="holder product-holder">
        <div class="container">
            <div class="title-with-right">
                <h3 class="h1-style">All Products</h3>
                <div class="prd-carousel-tabs" data-grid="tabCarousel-01">
                    <a href="{{ url('category') }}" class="btn-decor">show all</a>
                </div>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 5, "slidesToScroll": 5}'>
                @if($allProducts->count())
                    @foreach($allProducts as $product)
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
        </div>
    </div>

@endsection



