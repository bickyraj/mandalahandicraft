<footer class="page-footer footer-style-1 global_width">
    <div class="holder bgcolor bgcolor-1 mt-0">
        <div class="container">
            <div class="row shop-features-style3">
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">Free delivery inside Ring Road</div>
{{--                            <div class="text2">Lorem ipsum dolor sit amet</div>--}}
                        </div>
                    </a></div>
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">100% money back guarantee</div>
{{--                            <div class="text2">Lorem ipsum dolor sit amet</div>--}}
                        </div>
                    </a></div>
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-call"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">24/7 customer support</div>
{{--                            <div class="text2">Lorem ipsum dolor sit amet</div>--}}
                        </div>
                    </a></div>
            </div>
        </div>
    </div>
    <div class="holder bgcolor bgcolor-2 py-3 py-md-5 mt-0" style="margin-top: 0 !important;">
        <div class="container">
            <div class="subscribe-form subscribe-form--style1">
                <form action="#">
                    <div class="form-inline">
                        <div class="subscribe-form-title">subscribe to newsletter:</div>
                        <div class="form-control-wrap"><input type="text" class="form-control" placeholder="Enter Your e-mail address"></div><button type="submit" class="btn-decor">subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-top container">
        @include('frontend.layouts.footer_menu')
    </div>
    <div class="footer-bottom container">
        <div class="row lined py-2 py-md-3">
            <div class="col-md-2 hidden-mobile"><a href="#"><img src="{{ $company->logo() }}" class="img-fluid" alt=""></a></div>
            <div class="col-md-6 col-lg-5 footer-copyright">
                <p class="footer-copyright-text"><span>© Copyright</span> {{ date('Y') }} <a href="{{ url('') }}">Pixels Formation</a>. <span>All rights reserved.</span></p>
                <p class="footer-copyright-links"><a href="">Terms & conditions</a> <a href="">Privacy policy</a></p>
            </div>

            <div class="col-md-auto">
                <ul class="social-list">
                    <li><a href="{{ $company->facebook_url }}" class="icon icon-facebook"></a></li>
                    <li><a href="{{ $company->twitter_url }}" class="icon icon-twitter"></a></li>
                    <li><a href="{{ $company->instagram }}" class="icon icon-instagram"></a></li>
                    <li><a href="{{ $company->youtube }}" class="icon icon-youtube"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer><a class="back-to-top js-back-to-top compensate-for-scrollbar" href="#" title="Scroll To Top"><i class="icon icon-angle-up"></i></a>
<div class="modal--quickview" id="modalQuickView" style="display: none;">
    <div class="modal-header">
        <div class="modal-header-title">Quick View</div>
    </div>
    <div class="modal-content">
        <div class="modal-body">
            <div class="prd-block" id="prdGalleryModal">
                <div class="prd-block_info">
                    <div class="prd-block_info-row info-row-1 mb-md-1">
                        <div class="info-row-col-1">
                            <h1 class="prd-block_title">Glamor shoes</h1>
                        </div>
                        <div class="info-row-col-2">
                            <div class="product-sku">SKU: <span>#0005</span></div>
                            <div class="prd-block__labels"><span class="prd-label--sale">SALE</span> <span class="prd-label--new">NEW</span></div>
                            <div class="prd-block_link"><a href="#" class="icon-heart-1"></a></div>
                        </div>
                    </div>
                    <div class="prd-block_info-row info-row-2">
                        <form action="#">
                            <div class="info-row-col-3">
                                <div class="prd-block_price"><span class="prd-block_price--actual">$180.00</span> <span class="prd-block_price--old">$210.00</span></div>
                            </div>
                            <div class="info-row-col-4">
                                <div class="prd-block_price"><span class="prd-block_price--actual">$180.00</span> <span class="prd-block_price--old">$210.00</span></div>
                                <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                    <div class="qty qty-changer qty-changer--lg">
                                        <fieldset><input type="button" value="&#8210;" class="decrease"> <input type="text" class="qty-input" value="2" data-min="0" data-max="10"> <input type="button" value="+" class="increase"></fieldset>
                                    </div>
                                </div>
                                <div class="prd-block_options">
                                    <div class="form-group select-wrapper-sm"><select class="form-control" tabindex="0">
                                            <option value="">36 / silver $34.00</option>
                                            <option value="">38 / silver $34.00</option>
                                            <option value="">36 / gold $45.00</option>
                                            <option value="">38 / gold $45.00</option>
                                        </select></div>
                                </div>
                                <div class="prd-block_actions">
                                    <div class="btn-wrap"><button class="btn btn--add-to-cart-sm"><i class="icon icon-handbag"></i><span>Add to cart</span></button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="prd-block_info js-prd-m-holder"></div><!-- Product Gallery -->
                <div class="product-previews-wrapper">
                    <div class="product-quickview-carousel slick-arrows-aside-simple js-product-quickview-carousel">
                        <div><a href="{{ url('') }}/frontend/images/products/large/product-01.jpg" data-fancybox="gallery"><img src="{{ url('') }}/frontend/images/products/product-01.jpg" alt=""></a></div>
                        <div><a href="{{ url('') }}/frontend/images/products/large/product-01-2.jpg" data-fancybox="gallery"><img src="{{ url('') }}/frontend/images/products/product-01-2.jpg" alt=""></a></div>
                        <div><a href="{{ url('') }}/frontend/images/products/large/product-01-3.jpg" data-fancybox="gallery"><img src="{{ url('') }}/frontend/images/products/product-01-3.jpg" alt=""></a></div>
                        <div><a href="{{ url('') }}/frontend/images/products/large/product-01-4.jpg" data-fancybox="gallery"><img src="{{ url('') }}/frontend/images/products/product-01-4.jpg" alt=""></a></div>
                        <div><a href="{{ url('') }}/frontend/images/products/large/product-01-5.jpg" data-fancybox="gallery"><img src="{{ url('') }}/frontend/images/products/product-01-5.jpg" alt=""></a></div>
                    </div>
                    <div class="gdw-loader"></div>
                </div>
                <!-- /Product Gallery -->
                <div class="mt-3 mt-md-4">
                    <h2>Description</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error expedita hic iure nemo, nihil quam. Ab blanditiis eligendi fugit impedit, magni minus omnis placeat recusandae rem, sunt ut vitae voluptates? Fuga pariatur provident reiciendis veritatis voluptates voluptatum. A accusantium aliquam amet deleniti ea esse ex minus obcaecati perferendis tempore? Cupiditate distinctio incidunt molestiae, nam nesciunt non quaerat quas ratione repellendus! Ab aperiam assumenda consequatur delectus ea exercitationem facilis, in itaque iusto labore maiores nemo nostrum odio officiis optio placeat quas qui quibusdam ratione rem soluta suscipit totam voluptas voluptatem voluptatum.</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <tbody>
                            <tr>
                                <td>FABRIC</td>
                                <td>Metallic faux leather</td>
                            </tr>
                            <tr>
                                <td>STYLE</td>
                                <td>Goatskin lining, Strappy silhouette, Chunky heel, Buckle at ankle</td>
                            </tr>
                            <tr>
                                <td>MANUFACTURE</td>
                                <td>Made in Italy</td>
                            </tr>
                            <tr>
                                <td>MATERIAL</td>
                                <td>Rubber heel patch at leather sole</td>
                            </tr>
                            <tr>
                                <td>WEIGHT</td>
                                <td>0.05, 0.06, 0.07ess cards</td>
                            </tr>
                            <tr>
                                <td>BOX</td>
                                <td>This item cannot be gift-boxed</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div id="modalWishlistAdd" class="modal-info modal--success" style="display: none;">
    <div class="modal-text"><i class="icon icon-heart-fill modal-icon-info"></i><span>Product added to wishlist</span></div>
</div>
<div id="modalWishlistRemove" class="modal-info modal--error" style="display: none;">
    <div class="modal-text"><i class="icon icon-heart modal-icon-info"></i><span>Product removed from wishlist</span></div>
</div>
 -->
<style>
    .social-list li {
        font-size: 24px;
    }
</style>


<script src="{{ frontend_url('') }}/js/vendor/jquery/jquery.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/bootstrap/bootstrap.bundle.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/slick/slick.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/scrollLock/jquery-scrollLock.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/instafeed/instafeed.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/countdown/jquery.countdown.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/ez-plus/jquery.ez-plus.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/tocca/tocca.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/bootstrap-tabcollapse/bootstrap-tabcollapse.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/isotope/jquery.isotope.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/fancybox/jquery.fancybox.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/cookie/jquery.cookie.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/bootstrap-select/bootstrap-select.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/lazysizes/lazysizes.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/lazysizes/ls.bgset.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/form/jquery.form.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/form/validator.min.js"></script>
<script src="{{ frontend_url('') }}/js/vendor/slider/slider.js"></script>
<script src="{{ frontend_url('') }}/js/app.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script type="text/javascript">
    $(function(){
        if (window.location.hash && window.location.hash == '#_=_') {
               window.location.hash = '';
           }
        $('.js-label-wishlist').on('click',function(){
            var url=$(this).data('url');
            $.get(url,function(response){

                if(response.status)
                {
                    if(response.code==1)
                    {
                        toastr.success('Product added to Wishlist');

                    }else
                    {
                        toastr.success('Product removed from Wishlist.');
                    }

                }else
                {
                    alert('You must be logged in to add items to wishlist.')
                }

            });
        });


    });
</script>
@stack('script')
