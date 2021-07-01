@if(session()->has('current-cart-item'))
<div id="bsb-cart-modal" class="modal--checkout" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title"><i class="icon icon-check-box"></i><span>Product added to cart successfully!</span></div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalchk-prd">
                    <div class="row h-font">

                        <div class="modalchk-prd-image col"><a href="{{route('frontend.products.detail',$product->slug)}}">
                            <img src="" alt="{{$product->title}}"></a></div>
                        <div class="modalchk-prd-info col">

                            <h2 class="modalchk-title"><a href="#">{{$product->title}}</a></h2>

                            <div class="modalchk-price">Rs.{{$product->sellingPrice()}}</div>

                            @if($product->hasSize())
                            <div class="prd-options">
                                <span class="label-options">Size:</span><span class="prd-options-val">{{session('current-cart-item')->options->size}}</span>
                            </div>
                            @endif
                            <div class="prd-options">
                                <span class="label-options">Qty:</span><span class="prd-options-val">{{session('current-cart-item')->qty}}</span>
                            </div>
                            @if($product->hasColor())
                            <div class="prd-options">
                                <span class="label-options">Color:</span><span class="prd-options-val">{{session('current-cart-item')->options->color}}</span>
                            </div>
                            @endif

                            <div class="shop-features-modal d-none d-sm-block"><a href="#" class="shop-feature">
                                    <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                    <div class="shop-feature-text">
                                        <div class="text1">Delivery</div>
                                        <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="shop-features-modal d-sm-none"><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">Delivery</div>
                                    <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                </div>
                            </a>
                        </div>
                        <div class="modalchk-prd-actions col">
                            <h3 class="modalchk-title">There is <span class="custom-color">{{$cartCount}}</span> items in your cart</h3>
                            <div class="prd-options"><span class="label-options">Total:</span><span class="modalchk-total-price">Rs.{{$cartSubTotalPrice}}</span></div>
                            <!-- <div class="modalchk-custom"><img src="images/payment/guaranteed.png" alt="Guaranteed"></div> -->
                            <div class="modalchk-btns-wrap"><a href="{{route('checkout')}}" class="btn">proceed to checkout</a> <a href="{{route('home')}}" class="btn btn--alt" data-fancybox-close>continue shopping</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif