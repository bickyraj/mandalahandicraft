@extends('frontend.layouts.app')
@section('content')
<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><span>Search results</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <!-- Two columns -->
            <!-- Page Title -->
            <div class="page-title text-center d-none d-lg-block">
                <div class="title">
                
                    <h1>{{$result->count()}} result found!</h1>

                </div>
            </div>
            <!-- /Page Title -->
            <div class="row row-flex">
                <!-- Center column -->
                <div class="col-lg aside">
                    <div class="prd-grid-wrap">
                       
                        <!-- Products Grid -->
                        <div class="prd-grid product-listing data-to-show-3 data-to-show-md-3 data-to-show-sm-2 js-category-grid">

                        	@foreach($result as $product)
                            <div class="prd prd-has-loader prd-new prd-popular">
                                <div class="prd-inside">
									<div class="prd-img-area">
										<a href="{{ route('frontend.products.detail', $product->slug) }}" class="prd-img"><img src="@if(isset($product->color_product_images['0'])) {{ $product->color_product_images['0']->image() }} @endif" data-srcset="@if(isset($product->color_product_images['0'])) {{ $product->color_product_images['0']->image() }} @endif" alt="{{$product->title}}" class="js-prd-img lazyload"></a>
                                       
                                        <!-- <a href="#" class="label-wishlist icon-heart js-label-wishlist"></a> -->
                                        
                                        <div class="gdw-loader"></div>
                                    </div>
                                    <div class="prd-info">
                                        <div class="prd-tag prd-hidemobile"><a href="#"></a></div>
                                        <h2 class="prd-title"><a href="{{ route('frontend.products.detail', $product->slug) }}">{{$product->title}}</a></h2>
                                        <!-- <div class="prd-rating prd-hidemobile">
                                        	<i class="icon-star fill"></i>
                                        	<i class="icon-star fill"></i>
                                        	<i class="icon-star fill"></i>
                                        	<i class="icon-star fill"></i>
                                        	<i class="icon-star"></i>
                                        </div> -->
                                        <div class="prd-price">
                                            <div class="price-new">Rs. {{$product->sellingPrice()}}</div>
                                        </div>
                                        <div class="prd-hover">
                                            <div class="prd-action">
                                                <form action="{{ route('add_to_cart', $product->slug) }}" method="post">
                                                	@csrf
                                                	<input type="hidden" name="quantity" value="1"> 
                                                	
                                                	<button type="submit" class="btn"><i class="icon icon-handbag"></i><span>Add To Cart</span></button>
                                                </form>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            

                       
                       
                       
                          
                  
                        
                        </div>
                      
                        <!-- /Products Grid -->
                        <div class="show-more d-flex mt-4 mt-md-6 justify-content-center align-items-start">

                        	{{$result->links()}}

                            <!-- <ul class="pagination mt-0">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <!-- /Center column -->
            </div>
            <!-- /Two columns -->
        </div>
    </div>
</div>
@endsection