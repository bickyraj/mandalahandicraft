<div class="prd-grid product-listing data-to-show-4 data-to-show-md-3 data-to-show-sm-2 js-category-grid">
    @if($products->count())
        <script>
            $("#totalItem").html("{{ $products->total() }}");
        </script>
        @foreach($products as $product)
            <div class="prd prd-has-loader loaded">
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
    @else
        <h2 class="m-10">No records found.</h2>
    @endif
</div>
<div class="loader-wrap">
    <div class="dots">
        <div class="dot one"></div>
        <div class="dot two"></div>
        <div class="dot three"></div>
    </div>
</div>
<!-- /Products Grid -->
<div class="show-more d-flex mt-4 mt-md-6 justify-content-center align-items-start" id="paginationData">
    {{ $products->links() }}
</div>
