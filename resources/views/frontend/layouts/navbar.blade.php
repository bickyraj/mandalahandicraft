<div class="body-preloader">
    <div class="loader-wrap">
        <div class="dots">
            <div class="dot one"></div>
            <div class="dot two"></div>
            <div class="dot three"></div>
        </div>
    </div>
</div>



<header class="hdr global_width hdr_sticky hdr-mobile-style2">

    @if(!is_null($company->offer))
    <!-- Promo TopLine -->
    <div class="bgcolor" style="background-image: url(frontend/images/promo-topline-bg.png);">
        <div class="promo-topline" data-expires="1" style="display: none;">
            <div class="container">
                <div class="promo-topline-item">
                    <b>
                        {{$company->offer}}
                    </b>

                </div>
            </div><a href="#" class="promo-topline-close js-promo-topline-close"><i class="icon-cross"></i></a>
        </div>
    </div>
    <!-- /Promo TopLine -->
    @endif

    <!-- Mobile Menu -->
    <div class="mobilemenu js-push-mbmenu">
        <div class="mobilemenu-content loaded" style="">
            <div class="mobilemenu-close mobilemenu-toggle">CLOSE</div>
            <div class="mobilemenu-scroll">
                <div class="mobilemenu-search"></div>
                <div class="nav-wrapper show-menu" style="height: 225px;">
                    <div class="nav-toggle"><span class="nav-back"><i class="icon-arrow-left"></i></span> <span class="nav-title">Menu</span></div>
                    <ul class="nav nav-level-1">
                        @include('frontend.layouts.header_menu_mobile')
                    </ul>

                </div>
                <div class="mobilemenu-bottom">
                    <div class="mobilemenu-currency"></div>
                    <div class="mobilemenu-language"></div>
                    <div class="mobilemenu-settings"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Mobile Menu -->
    <div class="hdr-mobile show-mobile">
        <div class="hdr-content">
            <div class="container">
                <!-- Menu Toggle -->
                <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
                <!-- /Menu Toggle -->
                <div class="logo-holder"><a href="{{ url('') }}" class="logo"><img src="{{ $company->logo() }}" srcset="{{ $company->logo() }} 2x" alt=""></a></div>
                <div class="hdr-mobile-right">
                    <div class="hdr-topline-right links-holder"></div>
                    <div class="minicart-holder"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="hdr-desktop hide-mobile">
        <div class="hdr-topline">
            <div class="container">
                <div class="row">
                    <div class="col-auto hdr-topline-right links-holder">
                        <!-- Header Search -->
                        <div class="dropdn dropdn_search hide-mobile @@classes"><a href="#" class="dropdn-link"><i class="icon icon-search2"></i><span>Search</span></a>
                            <div class="dropdn-content">
                                <div class="container">
                                    <form action="{{route('search')}}" class="search" method="get">
                                        <button type="submit" class="search-button"><i class="icon-search2"></i></button>
                                        <input type="text" class="search-input" placeholder="search keyword" style="width: 80%" name="keyword">
                                        <button class="btn btn-lg btn-primary pull-right" style="font-size: 20px; margin: 20px; width: 250px; height: 60px;">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Header Search -->
                        <!-- Header Wishlist -->
                        @if(auth()->check() && (auth()->user()->hasRole('normal') ||auth()->user()->hasRole('wseller')))
                        <div class="dropdn dropdn_wishlist @@classes">
                            <a href="{{route('account.wishlist')}}" class="dropdn-link"><i class="icon icon-heart-1"></i><span>Wishlist</span></a>
                        </div>
                        @endif
                        <!-- /Header Wishlist -->
                        <!-- Header Account -->
                        <div class="dropdn dropdn_account @@classes"><a href="#" class="dropdn-link"><i class="icon icon-person"></i><span>My Account</span></a>
                            <div class="dropdn-content">
                                <div class="container">
                                    <div class="dropdn-close">CLOSE</div>
                                    <ul>
                                        @if(auth()->check() && (auth()->user()->hasRole('normal') || auth()->user()->hasRole('wseller')))
                                            <li>
                                                <a href="{{route('customer.account')}}"><i class="icon icon-person-fill"></i><span>My Account</span></a>
                                            </li>
                                        @endif
                                        @guest
                                            <li><a href="{{route('customer_login')}}"><i class="icon icon-lock"></i><span>Log In</span></a></li>
                                            <li><a href="{{route('register')}}"><i class="icon icon-person-fill-add"></i><span>Register</span></a></li>
                                        @else

                                            <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon icon-lock"></i><span>Logout</span></a></li>
                                            <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">@csrf</form>



                                    @endguest
                                    <!-- <li><a href="checkout.html"><i class="icon icon-check-box"></i><span>Checkout</span></a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Header Account -->
                    </div>
                </div>
            </div>
        </div>
        <div class="hdr-content hide-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-auto logo-holder"><a href="{{ url('') }}" class="logo"><img src="{{ $company->logo() }}" srcset="{{ $company->logo() }} 2x" alt=""></a></div>
                    <!--navigation-->
                    <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                    <div class="nav-holder">
                        <div class="hdr-nav">
                            <!--mmenu-->
                            <ul class="mmenu mmenu-js">
                                @include('frontend.layouts.header_menu')
                            </ul>
                            <!--/mmenu-->
                        </div>
                    </div>
                    <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                    <!--//navigation-->
                    <div class="col-auto minicart-holder">
                        <div class="minicart minicart-js"><a href="#" class="minicart-link"><i class="icon icon-handbag"></i> <span class="minicart-qty">{{$cartCount}}</span> <span class="minicart-title">Shopping Cart</span> <span class="minicart-total">Rs.{{$cartSubTotalPrice}}</span></a>
                            <div class="minicart-drop">
                                <div class="container">
                                    <div class="minicart-drop-close">CLOSE</div>
                                    <div class="minicart-drop-content">
                                        @if($cartCount>0)
                                            <h3>
                                                Recently added items:
                                            </h3>
                                        @else
                                            <h3 align="center">You have no items in the shopping cart!</h3>
                                        @endif




                                        @foreach($cartItems as $item)
                                            <div class="minicart-prd">
                                                <div class="minicart-prd-image"><a href="#">
                                                        <img src="{{ getColorProductImage($item->id, $item->options->color) }}" data-srcset="{{ getColorProductImage($item->id, $item->options->color) }}" class="lazyload" alt=""></a>
                                                </div>
                                                <div class="minicart-prd-name">
                                                    <h5><a href="#">canverse</a></h5>
                                                    <h2><a href="#">{{$item->name}}</a></h2>
                                                </div>
                                                @if($item->options->size!==null)
                                                    <div class="minicart-prd-price"><span>Size</span> <b>{{get_size_name($item->options->size)}}</b>
                                                    </div>
                                                @endif



                                                <div class="minicart-prd-price"><span>price: Rs.</span> <b>{{$item->price}}</b>
                                                </div>
                                                <div class="minicart-prd-qty"><span>qty:</span> <b>{{$item->qty}}</b></div>
                                                <div class="minicart-prd-price"><span>Total price: Rs.</span> <b>{{$item->subtotal}}</b></div>
                                                <div class="minicart-prd-action">
                                                    <!-- <a href="#" class="icon-heart js-label-wishlist"></a>
                                                    <a href="product.html" class="icon-pencil"></a> -->
                                                    <a href="{{route('remove-from-cart',$item->rowId)}}" onclick="return confirm('Are you sure?')" class="icon-cross "></a></div>
                                            </div>
                                        @endforeach

                                        @if($cartCount)
                                            <div class="minicart-drop-total">
                                                <div class="float-right"><span class="minicart-drop-summa"><span>Cart Subtotal:</span> <b>Rs.{{$cartSubTotalPrice}}</b></span>
                                                    <div class="minicart-drop-btns-wrap">
                                                        @if(auth()->check() && (auth()->user()->hasRole('normal') || auth()->user()->hasRole('wseller')))
                                                        <a href="{{route('checkout')}}" class="btn"><i class="icon-check-box"></i><span>checkout</span></a>
                                                        @endif
                                                       <a href="{{ route('cart-items') }}" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a>
                                                    </div>
                                                </div>
                                                <div class="float-left"><a href="{{ route('cart-items') }}" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a></div>
                                            </div>
                                        @endif



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-holder compensate-for-scrollbar">
        <div class="container">
            <div class="row"><a href="#" class="mobilemenu-toggle show-mobile"><i class="icon icon-menu"></i></a>
                <div class="col-auto logo-holder-s"><a href="{{ url('') }}" class="logo"><img src="{{ $company->logo() }}" srcset="{{ $company->logo() }} 2x" alt=""></a></div>
                <!--navigation-->
                <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                <div class="nav-holder-s"></div>
                <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                <!--//navigation-->
                <div class="col-auto minicart-holder-s"></div>
            </div>
        </div>
    </div>
</header>
