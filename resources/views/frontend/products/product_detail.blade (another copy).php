@extends('frontend.layouts.app')
@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="category.html">{{ucwords($product->category->name)}}</a></li>
                    <li><span>{{ucwords($product->title)}}</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row prd-block prd-block--mobile-image-first js-prd-gallery" id="prdGallery100">
                    <div class="col-md-6 col-xl-5">
                        <div class="prd-block_info js-prd-m-holder mb-2 mb-md-0"></div><!-- Product Gallery -->
                        <div class="prd-block_main-image main-image--slide js-main-image--slide">
                            <div class="prd-block_main-image-holder js-main-image-zoom" data-zoomtype="inner">
                                <div class="prd-block_main-image-video js-main-image-video"><video loop muted preload="metadata" controls="controls">
                                        <source src="#"></video>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-has-loader">
                                    <div class="gdw-loader"></div>
                                    <img src="@if(isset($product->color_product_images['0'])) {{ $product->color_product_images['0']->image() }} @endif" class="zoom" alt="" data-zoom-image="@if(isset($product->color_product_images['0'])) {{ $product->color_product_images['0']->image() }} @endif">
                                </div>
                                <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                                <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                            </div>
                            <div class="prd-block_main-image-links"><a data-fancybox data-width="900" href="https://www.youtube.com/watch?v=Zk3kr7J_v3Q" class="prd-block_video-link"><i class="icon icon-play"></i></a> <a href="images/products/large/product-01.jpg" class="prd-block_zoom-link"><i class="icon icon-zoomin"></i></a></div>
                        </div>
                        <div class="product-previews-wrapper">
                            <div class="product-previews-carousel" id="previewsGallery100">
                                @if(isset($product->color_product_images) && $product->color_product_images->count())
                                    @foreach($product->color_product_images as $image)
                                        <a href="#" data-value="{{ $image->color_id }}" data-image="{{ $image->image() }}" data-zoom-image="{{ $image->image() }}">
                                            <img src="{{ $image->image() }}" alt="">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- /Product Gallery -->
                    </div>
                    <div class="col-md">
                        <div class="prd-block_info">
                            <div class="js-prd-d-holder prd-holder">
                                <div class="prd-block_title-wrap">
                                    <h1 class="prd-block_title">{{$product->title}}</h1>
                                    <div class="prd-block__labels">
                                        @if($product->special())
                                            <span class="prd-label--new">{{$product->get_sale_status()}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="prd-block_info-top">
                                    <div class="product-sku">SKU: <span>#0005</span></div>
                                    <div class="prd-rating"><a href="#" class="prd-review-link"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i> <span>1 reviews</span></a></div>
                                    <div class="prd-availability">Availability: <span>{{$product->quantity}} items</span></div>
                                </div>
                                <div class="prd-block_description topline">
                                    {!! $product->description !!}
                                </div>
                            </div>

                            <form action="{{ route('add_to_cart', $product->slug) }}" method="post">
                                @csrf
                                <div class="prd-block_options topline">

                                @if($product->hasColor())
                                    <div class="prd-color swatches"><span class="option-label">Color:</span>
                                        <select class="form-control input-sm" name="color">

                                            @if(isset($product->colors) && $product->colors->count())
                                                @foreach($product->colors as $color)
                                                    <option value="{{ $color->id }}" @if ($loop->first) selected="" @endif>{{ $color->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <ul class="color-list color-list--sm">
                                            @if(isset($product->colors) && $product->colors->count())
                                                @foreach($product->colors as $color)
                                                    <li class="@if ($loop->first) active @endif"><a href="#" data-toggle="tooltip" data-placement="top" title="{{ $color->name }}" data-value="{{ $color->id }}" data-image="images/products/small/product-01.jpg"><span class="value"><div class="color-label" style="height:24px; background: {{ $color->color_code }}"></div></span></a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                                @if($product->hasSize())
                                    <div class="prd-size swatches"><span class="option-label">Size:</span>
                                        <input type="hidden" name="size" id="selectSizeData" value="38">
                                        <ul class="size-list select-size-list">
                                            @foreach($product->sizes as $k=>$v)
                                                <li><a href="#" data-value="{{$v->id}}"><span class="value {{$k==0?'active-span':''}}">{{$v->size}}</span></a></li>
                                            @endforeach

                                        </ul>


                                        <div class="option-links"><a href="#" data-fancybox data-src="#sizeGuide">SIZE GUIDE</a></div>
                                        <div class="modal--simple modal--lg" id="sizeGuide" style="display: none;">
                                            <div class="modal-header">
                                                <div class="modal-header-title">SIZE GUIDE</div>
                                            </div>
                                            <div class="modal-content">
                                                <div class="modal-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                    <div class="qty qty-changer">
                                        <fieldset>
                                            <input type="button" value="&#8210;" class="decrease">
                                            <input name="quantity" type="text" class="qty-input" value="1" data-min="1" data-max="{{$product->quantity}}"> <input type="button" value="+" class="increase"></fieldset>
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
                                    <div class="btn-wrap" style="color:red">Out of stock!</div>

                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-3 mt-3 mt-xl-0 sidebar-product">
                        <div class="shop-features-style4"><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">Free worlwide delivery</div>
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
                                        <div><span class="text2">DISCOUNT</span> <span class="text1">{{$product->discount}}% OFF</span></div>
                                        <div class="text3">Have time to buy!</div>
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
            <div class="holder mt-2 mt-sm-5">
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs product-tab">
                        <li class="nav-item"><a href="#Tab1" class="nav-link" data-toggle="tab">Description</a></li>
                        <li class="nav-item"><a href="#Tab2" class="nav-link" data-toggle="tab">Custom tab</a></li>
                        <li class="nav-item"><a href="#Tab3" class="nav-link" data-toggle="tab">Custom tab</a></li>
                        <li class="nav-item"><a href="#Tab4" class="nav-link" data-toggle="tab">Sizing Guide</a></li>
                        <li class="nav-item"><a href="#Tab5" class="nav-link" data-toggle="tab">Tags</a></li>
                        <li class="nav-item"><a href="#Tab6" class="nav-link" data-toggle="tab">Reviews</a></li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="Tab1">
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless h-font text-uppercase">
                                    <tbody>
                                    <tr>
                                        <td>PROOF</td>
                                        <td><b>PDF Proof</b></td>
                                    </tr>
                                    <tr>
                                        <td>SAMPLES</td>
                                        <td><b>Digital, Printed</b></td>
                                    </tr>
                                    <tr>
                                        <td>WRAPPING</td>
                                        <td><b>Yes, No</b></td>
                                    </tr>
                                    <tr>
                                        <td>UV GLOSS COATING</td>
                                        <td><b>Yes</b></td>
                                    </tr>
                                    <tr>
                                        <td>SHRINK WRAPPING</td>
                                        <td><b>No Shrink Wrapping, Shrink in 25s, Shrink in 50s, Shrink in 100s</b></td>
                                    </tr>
                                    <tr>
                                        <td>WEIGHT</td>
                                        <td><b>0.05, 0.06, 0.07ess cards</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Tab2">
                            <h3 class="custom-color">Take a trivial example which of us ever undertakes</h3>
                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure</p>
                            <div class="mt-3"></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Zk3kr7J_v3Q" allowfullscreen></iframe></div>
                                </div>
                                <div class="col-sm-6 mt-3 mt-sm-0">
                                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful</p>
                                    <ul class="list list--marker-squared">
                                        <li>Nam liberempore</li>
                                        <li>Cumsoluta nobisest</li>
                                        <li>Eligendptio cumque</li>
                                        <li>Nam liberempore</li>
                                        <li>Cumsoluta nobisest</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Tab3">
                            <h3>A little bit of fashion</h3>
                            <div class="row vert-margin">
                                <div class="col-sm-6"><img src="images/pages/product-post-img-1.jpg" class="img-fluid" alt=""></div>
                                <div class="col-sm-6">
                                    <p>Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestueh amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising.</p>
                                    <p>Consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor nsestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr.</p>
                                </div>
                            </div>
                            <div class="mt-3"></div>
                            <h3>How to choose a dress?</h3>
                            <div class="row vert-margin">
                                <div class="col-sm-6">
                                    <p>Elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer.</p>
                                    <ul class="list list--marker-squared">
                                        <li>Consestuer adicpising elitr anno dolor sit amet</li>
                                        <li>Lorem ipsum dolor sit amet consestuer adicpising elitr anno</li>
                                        <li>Dolor sit amet orem ipsum dolor sit amet</li>
                                        <li>Elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising</li>
                                        <li>Anno dolor sit amet orem ipsum dolor sit amet consest</li>
                                        <li>Sit amet lorem ipsum dolor sit amet</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6"><img src="images/pages/product-post-img-2.jpg" class="img-fluid" alt=""></div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Tab4">
                            <h3>Single Size Conversion</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table--size">
                                    <tr>
                                        <th scope="row">US Sizes</th>
                                        <td>6</td>
                                        <td>6,5</td>
                                        <td>7</td>
                                        <td>7,5</td>
                                        <td>8</td>
                                        <td>8,5</td>
                                        <td>9</td>
                                        <td>9,5</td>
                                        <td>10</td>
                                        <td>10,5</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Euro Sizes</th>
                                        <td>39</td>
                                        <td>39</td>
                                        <td>40</td>
                                        <td>40-41</td>
                                        <td>41</td>
                                        <td>41-42</td>
                                        <td>42</td>
                                        <td>42-43</td>
                                        <td>43</td>
                                        <td>43-44</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">UK Sizes</th>
                                        <td>5,5</td>
                                        <td>6</td>
                                        <td>6,5</td>
                                        <td>7</td>
                                        <td>7,5</td>
                                        <td>8</td>
                                        <td>8,5</td>
                                        <td>9</td>
                                        <td>9,5</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Inches</th>
                                        <td>9.25&quot;</td>
                                        <td>9.5&quot;</td>
                                        <td>9.625&quot;</td>
                                        <td>9.75&quot;</td>
                                        <td>9.9375&quot;</td>
                                        <td>10.125&quot;</td>
                                        <td>10.25&quot;</td>
                                        <td>10.5&quot;</td>
                                        <td>10.625&quot;</td>
                                        <td>10.75&quot;</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">CM</th>
                                        <td>23,5</td>
                                        <td>24,1</td>
                                        <td>24,4</td>
                                        <td>24,8</td>
                                        <td>25,4</td>
                                        <td>25,7</td>
                                        <td>26</td>
                                        <td>26,7</td>
                                        <td>27</td>
                                        <td>27,3</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Tab5">
                            <ul class="tags-list">
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">St.Valentine’s gift</a></li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Maxi dress</a></li>
                                <li><a href="#">Underwear</a></li>
                                <li><a href="#">men accessories</a></li>
                                <li><a href="#">hand bags</a></li>
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">St.Valentine’s gift</a></li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Maxi dress</a></li>
                                <li><a href="#">Underwear</a></li>
                                <li><a href="#">men accessories</a></li>
                                <li><a href="#">hand bags</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Jeans</a></li>
                            </ul>
                            <h3>Add your tag</h3>
                            <form class="form--simple" action="#"><label>Tag<span class="required">*</span></label> <input class="form-control input-lg"> <button class="btn btn-lg">Submit Tag</button>
                                <div class="required-text">* Required Fields</div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="Tab6">
                            <div id="productReviews">
                                <div class="prd-rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><span> Based on 3 review</span></div>
                                <div class="review-item">
                                    <h4 class="review-item_author">Sheldon Matthews</h4>
                                    <div class="review-item_rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i></div>
                                    <p>Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet.</p>
                                </div>
                                <div class="review-item">
                                    <h4 class="review-item_author">Matthew Johnson</h4>
                                    <div class="review-item_rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <p>Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet.</p>
                                </div>
                                <div class="review-item">
                                    <h4 class="review-item_author">Frederick Voykovich</h4>
                                    <div class="review-item_rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                    <p>Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet.</p>
                                </div>
                                <div class="text-center"><a href="#" class="btn-decor">Write Review</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="holder">
            <div class="container">
                <div class="title-wrap text-center">
                    <h2 class="h1-style">RELATED PRODUCTS</h2>
                </div>
                <div class="prd-grid prd-carousel js-prd-carousel slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2" data-slick='{"slidesToShow": 4, "slidesToScroll": 2, "responsive": [{"breakpoint": 992,"settings": {"slidesToShow": 3, "slidesToScroll": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 2, "slidesToScroll": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 2, "slidesToScroll": 1}}]}'>

                </div>
                <div class="more-link-wrapper text-center"><a href="#" class="btn-decor">show all</a></div>
            </div>

        </div>
    </div>

    <button id="success_msg" style="display: none"  class="btn btn--add-to-cart hidden" data-fancybox="" data-src="#bsb-cart-modal"><i class="icon icon-handbag"></i><span>Add to cart</span></button>
    @include('frontend.cart.cart_message');

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

    });


</script>


@endpush