<div class="row py-md-4">
    <div class="col-md-4 col-lg">
        <div class="footer-block collapsed-mobile">
            <div class="title">
                <h4>Categories</h4>
                <div class="toggle-arrow"></div>
            </div>
            <div class="collapsed-content">
                <ul>
                    @if($allMenu->count())
                        @foreach($allMenu as $key=>$menu)
                            <li><a href="{{ url('category') }}/{{ getCategorySlug($key) }}">{{ $menu }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="footer-block collapsed-mobile">
            <div class="title">
                <h4>Customer Service</h4>
                <div class="toggle-arrow"></div>
            </div>
            <div class="collapsed-content">
                <ul>
                    <li><a href="{{route('terms')}}">Terms of Use</a></li>
                    <li><a href="{{ url('register') }}">Create Account</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="footer-block collapsed-mobile">
            <div class="title">
                <h4>My Account</h4>
                <div class="toggle-arrow"></div>
            </div>
            <div class="collapsed-content">
                <ul>
                    <li><a href="{{ url('account') }}">My Account</a></li>
                    <li><a href="{{ url('cart') }}">View Cart</a></li>
                    <li><a href="{{ url('account/wishlist') }}">My Wishlist</a></li>
                    <li><a href="{{ url('account/order-history') }}">Track My Order</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg">
        <div class="footer-block collapsed-mobile">
            <div class="title">
                <h4>Information</h4>
                <div class="toggle-arrow"></div>
            </div>
            <div class="collapsed-content">
                <ul>
                    <li><a href="{{route('about')}}">About Us</a></li>

                    <li><a href="{{route('request.wseller')}}">Request For Whole Seller</a></li>

                    <li><a href="{{route('faq')}}">F.A.Q.</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-3">
        <div class="footer-block collapsed-mobile">
            <div class="title">
                <h4>contact us</h4>
                <div class="toggle-arrow"></div>
            </div>
            <div class="collapsed-content">
                <ul class="contact-list">
                    <li><i class="icon-phone"></i><span><span class="h6-style">Call Us:</span><span>{{ $company->phone }}</span></span></li>
                    <li><i class="icon-clock4"></i><span><span class="h6-style">Hours:</span><span>Mon-fri 9am-8pm<br>sat 9am-6pm</span></span></li>
                    <li><i class="icon-mail-envelope1"></i><span><span class="h6-style">E-mail:</span><span><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></span></span></li>
                    <li><i class="icon-location1"></i><span><span class="h6-style">Address:</span><span>{{ $company->address }}</span></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>