@extends('frontend.layouts.app')

<style>
    input[type="checkbox"] + label:before {
        width: 16px !important;
        height: 16px !important;
    }

    input[type="checkbox"] + label::after {
        height: 4px !important;
        left: 4px !important;
        top: 4.75px !important;
    }

    input[type="checkbox"] + label {
        margin: 1px !important;
    }

    ul.category-list li a {
        padding: 0px 25px 0px 0 !important;
    }

    ul.category-list li:hover label, ul.category-list li.selected label {
        color: #27c7d8 !important;
    }

    .price-input {
        height: 32px !important;
    }

    .price-btn {
        height: 32px;
        padding: 0px 10px !important;
    }

    .price-section {
        padding: 0 !important;
    }

    .price-section-to {
        padding: 0 !important;
        text-align: center;
        margin-top: 3px;
    }

    .selected-filters li > a:after {
        content: none !important;
    }

    .select-directions span.active {
        color: #27c7d8;
    }
</style>
@section('content')

    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><span>Seller</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <!-- Two columns -->
            <!-- Page Title -->
            <div class="page-title text-center d-none d-lg-block">
                <div class="title">
                    <h1>{{ $vendor->name }}</h1>
                </div>
            </div>
            <!-- /Page Title -->
            <div class="row">
                <!-- Left column -->
                <div class="col-lg-3 aside aside--left fixed-col js-filter-col">
                    <div class="fixed-col_container">
                        <div class="filter-close">CLOSE</div>
                        <div class="sidebar-block sidebar-block--mobile d-block d-lg-none">
                            <div class="d-flex align-items-center">
                                <div class="selected-label">(6) FILTER</div>
                                <div class="selected-count ml-auto">SELECTED <span><b>25 items</b></span></div>
                            </div>
                        </div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Current Selection</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content">
                                <div class="selected-filters-wrap">
                                    <ul class="selected-filters">

                                    </ul>

                                    <button class="btn btn-sm btn-light btn-clear-filter" style="display: none;">Clear Filter &nbsp<i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-block filter-group-block">
                            <div class=" sidebar-block_title"><span>Price</span>
                            </div>
                            <div class="sidebar-block_content">
                                <ul class="category-list">
                                    <li class="">
                                        <div class="row" style="margin-left: 0px">
                                            <div class="col-md-4 price-section">
                                                <input name="price_min" type="text" class="form-control price-input" placeholder="Min">
                                            </div>

                                            <div class="col-md-2 price-section-to">
                                                <span>to</span>
                                            </div>

                                            <div class="col-md-4 price-section">
                                                <input  name="price_max" type="text" class="form-control price-input" placeholder="Max">
                                            </div>

                                            <div class="col-md-2 price-section-btn">
                                                <button class="btn btn-info btn-sm price-btn" type="button">
                                                    <i class="fa fa-caret-right fa-2x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-block filter-group-block">
                            <div class=" sidebar-block_title"><span>Brands</span>
                            </div>
                            <div class="sidebar-block_content">
                                <ul class="category-list">

                                    @foreach($brands as $key=>$brand)
                                        <li class="">
                                            <a href="#">
                                                <input id="{{ $brand }}" value="{{ $key }}" class="brand-checkbox" name="brand_id[]" type="checkbox"> <label for="{{ $brand }}">{{ $brand }}</label>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="sidebar-block filter-group-block">
                            <div class=" sidebar-block_title"><span>Colors</span>
                            </div>
                            <div class="sidebar-block_content">
                                <ul class="category-list">
                                    @foreach($colors as $key=>$color)
                                        <li class="">
                                            <a href="#">
                                                <input id="{{ $color }}" value="{{ $key }}" class="color-checkbox" name="color_id[]" type="checkbox"> <label for="{{ $color }}">{{ $color }}</label>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-block filter-group-block">
                            <div class=" sidebar-block_title"><span>Offer</span>
                            </div>
                            <div class="sidebar-block_content">
                                <ul class="category-list">
                                    <li class="">
                                        <a href="#">
                                            <input id="sale" value="sale" class="offer-checkbox" name="sale" type="checkbox"> <label for="sale">Sale</label>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#">
                                            <input id="featured" value="featured" class="offer-checkbox" name="featured" type="checkbox"> <label for="featured">Featured</label>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#">
                                            <input id="popular" value="popular" class="offer-checkbox" name="popular" type="checkbox"> <label for="popular">Popular</label>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{--                        <div class="sidebar-block filter-group-block">--}}
                        {{--                            <div class=" sidebar-block_title"><span>Size</span>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="sidebar-block_content">--}}
                        {{--                                <ul class="category-list">--}}
                        {{--                                    @foreach($sizes as $size)--}}
                        {{--                                        <li class="">--}}
                        {{--                                            <a href="#">--}}
                        {{--                                                <input id="{{ $size }}" name="brands[]" type="checkbox"> <label for="{{ $size }}">{{ $size }}</label>--}}
                        {{--                                            </a>--}}
                        {{--                                        </li>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <!-- /Left column -->
                <!-- Center column -->
                <div class="col-lg aside">
                    <div class="prd-grid-wrap">
                        <!-- Filter Row -->
                        <div class="filter-row invisible">
                            <div class="row row-1 d-lg-none align-items-center">
                                <div class="col">
                                    <h1 class="category-title">{{ $category_name }}</h1>
                                </div>
                                <div class="col-auto ml-auto">
                                    <div class="view-in-row d-md-none"><span data-view="data-to-show-sm-1"><i class="icon icon-view-1"></i></span> <span data-view="data-to-show-sm-2"><i class="icon icon-view-2"></i></span></div>
                                    <div class="view-in-row d-none d-md-inline"><span data-view="data-to-show-md-2"><i class="icon icon-view-2"></i></span> <span data-view="data-to-show-md-3"><i class="icon icon-view-3"></i></span></div>
                                </div>
                            </div>
                            <div class="row row-2 form-inline">
                                <div class="form-group">
                                    <label for="" class="ml-1">Sort by</label>
                                    <select name="" id="" class="form-control ml-1 select-sort-by">
                                        <option value="" selected>None</option>
                                        <option value="asc">Price low to high</option>
                                        <option value="desc">Price high to low</option>
                                    </select>
                                </div>
                                <div class="col-left d-flex align-items-center">

                                    {{--                                    <div class="sort-by-holder">--}}
                                    {{--                                        <div class="select-label d-none d-lg-inline">Sort by:</div>--}}
                                    {{--                                        --}}
                                    {{--                                        <div class="select-wrapper-sm d-none d-lg-inline-block"><select class="form-control input-sm">--}}
                                    {{--                                                <option value="rating">Rating</option>--}}
                                    {{--                                                <option value="price">Price</option>--}}
                                    {{--                                            </select></div>--}}
                                    {{--                                        <div class="select-directions d-none d-lg-inline"><span><i class="icon icon-arrow-down"></i></span> <span><i class="icon icon-arrow-up"></i></span></div>--}}
                                    {{--                                        <div class="dropdown d-flex d-lg-none align-items-center justify-content-center"><span class="select-label">Sort By</span>--}}
                                    {{--                                            <div class="select-wrapper-sm"><select class="form-control input-sm">--}}
                                    {{--                                                    <option value="rating">Rating</option>--}}
                                    {{--                                                    <option value="price">Price</option>--}}
                                    {{--                                                </select></div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="filter-button d-lg-none"><a href="#" class="fixed-col-toggle">FILTER</a></div>
                                </div>
                                {{--                                <div class="col col-center d-none d-lg-flex align-items-center justify-content-center">--}}
                                {{--                                    <div class="view-label">View:</div>--}}
                                {{--                                    <div class="view-in-row"><span data-view="data-to-show-3"><i class="icon icon-view-3"></i></span> <span data-view="data-to-show-4"><i class="icon icon-view-4"></i></span></div>--}}
                                {{--                                </div>--}}
                                <div class="col-right ml-auto d-none d-lg-flex align-items-center">
                                    <div class="items-count"><span id="totalItem" class="" style="margin-right: 5px"> {{ $products->total() }}</span> item(s)</div>
                                    <div class="show-count-holder">
                                        <div class="select-label">Show:</div>
                                        <div class="select-wrapper-sm">
                                            <select class="form-control input-sm" name="limit">
                                                <option value="12">12</option>
                                                <option value="36">36</option>
                                                <option value="100">100</option>
                                            </select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Filter Row -->
                        <!-- Products Grid -->
                        <div id="productSection">
                            <div class="prd-grid product-listing data-to-show-4 data-to-show-md-3 data-to-show-sm-2 js-category-grid">
                                @if($products->count())
                                    @foreach($products as $product)
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
                        </div>
                    </div>
                </div>
                <!-- /Center column -->
            </div>
            <!-- /Two columns -->
        </div>
    </div>

@endsection
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@push('script')
    <script>

        let categoryId = "{{ $category_id }}";
        $(document).on("click", ".price-btn", function (event) {
            event.preventDefault();

            let price_min = $('input[name="price_min"]').val();
            let price_max = $('input[name="price_max"]').val();

            if (price_min !== '' && price_max !== '') {
                loadProduct();
            }

        });

        let page = 1;

        $(document).on("click", ".page-link", function (event) {
            event.preventDefault();
            page = $(this).html();
            loadProduct();
        });

        function loadProduct() {
            let selectedFilter = $(".selected-filters");
            selectedFilter.html("");
            let price_min = $('input[name="price_min"]').val();
            let price_max = $('input[name="price_max"]').val();
            let brand_id = [];
            let color_id = [];
            let featured = "";
            let sale = "";
            let popular = "";
            let vendor_id = "{!! $vendor->id !!}";

            let token = "{{ csrf_token() }}";
            let selectedItem = "";
            let limit = $("select[name='limit']").val();
            let price_order = $(".select-sort-by").val();

            $('.brand-checkbox').each(function(){
                if($(this).is(':checked')) {
                    brand_id.push($(this).val());
                    selectedItem += '<li class="brand-li" data-value="'+$(this).attr('id')+'"><a href="#">'+$(this).attr('id')+'</a></li>';
                }
            });

            $('.color-checkbox').each(function(){
                if($(this).is(':checked')) {
                    color_id.push($(this).val());
                    selectedItem += '<li class="color-li" data-value="'+$(this).attr('id')+'"><a href="#">'+$(this).attr('id')+'</a></li>';
                }
            });


            $('.offer-checkbox').each(function(){
                if($(this).is(':checked')) {
                    let value = $(this).attr('id');
                    selectedItem += '<li class="offer-li" data-value="'+value+'"><a href="#">'+value+'</a></li>';

                    if (value === 'sale') {
                        sale = 1;
                    } else if(value === 'popular') {
                        popular = 1;
                    } else {
                        featured = 1;
                    }
                }
            });


            if (price_min !== '') {
                selectedItem += '<li class="price-min"><a href="#">Min Price: '+price_min+'</a></li>';
            }

            if (price_max !== '') {
                selectedItem += '<li class="price-max"><a href="#">Max Price: '+price_max+'</a></li>';
            }

            let url = "{{ url('load-vendor-product') }}?page="+page;
            let data = {price_min: price_min, price_max: price_max, _token:token,
                brand_id:brand_id, color_id:color_id,
                featured:featured, sale:sale, popular:popular,
                limit:limit, price_order: price_order,category_id:categoryId,
                vendor_id: vendor_id
            };


            selectedFilter.html(selectedItem);
            $(window).scrollTop(0);
            $("#productSection").load(url, data, function(result){
                if (result) {
                }
            });

            if(selectedFilter.find('li').length > 0) {
                $(".btn-clear-filter").show();
            } else {
                $(".btn-clear-filter").hide();
            }
        }

        $(document).on("change", ".brand-checkbox", function(){
            loadProduct();
        });

        $(document).on("change", ".color-checkbox", function(){
            loadProduct();
        });

        $(document).on("change", ".offer-checkbox", function(){
            loadProduct();
        });

        // $(document).on("click", ".brand-li", function(){
        //     let value = $(this).attr("data-value");
        //     $(".brand-checkbox#"+value).prop("checked", false);
        //
        //     $(this).remove();
        //     loadProduct();
        // });

        $(document).on("click", ".btn-clear-filter", function(){
            $(".brand-checkbox").prop("checked", false);
            $(".color-checkbox").prop("checked", false);
            $(".offer-checkbox").prop("checked", false);
            $(".price-input").val("");

            loadProduct();
        });

        $(document).on("change", "select[name='limit']", function () {
            loadProduct();
        });

        $(document).on("change", ".select-sort-by", function () {
            loadProduct();
        });

    </script>
@endpush


