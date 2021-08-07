<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <title>
            @hasSection ('title')
                @yield('title') -
            @endif
            Mandala Handicraft
        </title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@700&family=Roboto:ital,wght@0,100;0,300;0,700;1,200&display=swap" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto:ital,wght@0,100;0,300;0,700;1,200&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

        <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            [x-cloak] { display:none; }
        </style>
    </head>
    <body x-data="{cartDrawerOpen:false}">
        @include('frontend.partials.header')

        <main>
            @yield('content')
        </main>

        @include('frontend.partials.footer')
        @include('frontend.partials.cart')

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.6.1/dist/gsap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('frontend/js/app.js') }}"></script>
        @stack('scripts')
        <script>
            function updateCart() {
                let cart_badge = $("#header-cart-badge");
                let url = '{!! route("front.cart.content") !!}';
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'JSON',
                    //data: data,
                    async: false,
                    success: function(response) {
                        if (response.data != "") {
                            const cart = response.data;
                            cart_badge.html(cart.unique_count);
                            $("#cart-block").show();
                            $("#cart-block-count").html(cart.unique_count);
                            $("#cart-block-total").html(cart.sub_total);
                            $("#cart-block-products").html(cart.html_products);
                        }
                    }
                });
            }

            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('change', ".cart-block-product-quantity-input", function(event) {
                    let url = "{!! route('front.cart.item.update') !!}";
                    let quantity = $(this).val();
                    let rowId = $(this).data('rowid');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {rowId: rowId, quantity: quantity},
                        async: false,
                        success: function(response) {
                            if (response.success) {
                                toastr.success("Cart item updated.");
                                updateCart();
                            }
                        }
                    });
                });

                $(".add-to-cart-btn").on('click', function(event) {
                    let slug = $(this).data('slug');
                    let url = "{{ route('add_to_cart', ':SLUG') }}";
                    let loader = $(this).find(".spin-loader");
                    loader.show();
                    url = url.replace(':SLUG', slug);
                    setTimeout(() => {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'JSON',
                            //data: data,
                            async: false,
                            success: function(response) {
                                toastr.success(response.message);
                                if (response.success) {
                                    updateCart();
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            },
                            complete: function() {
                                loader.hide();
                            }
                        });
                    }, 500);

                });
            });
        </script>
    </body>
</html>
