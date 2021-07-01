@extends('frontend.layouts.app')
@push('css')
  <style>
    [v-cloak] {
      display : none;
    }

    #processing-cover {
      position   : fixed;
      left       : 0;
      right      : 0;
      top        : 0;
      bottom     : 0;
      background : rgba(0, 0, 0, 0.9);
      z-index    : 999;
      display    : none;
    }

    #processing {
      position      : fixed;
      top           : 50%;
      left          : 50%;
      background    : #555;
      color         : #fff;
      padding       : 10px 15px;
      border-radius : 25px;
    }
  </style>


@endpush
@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>Checkout</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <h1 class="text-center">Checkout</h1>
                <div class="clearfix"></div>
                <form action="{{route('payment.process')}}" method="post" id="order_confirm" data-toggle="validator">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card--grey">
                                <div class="card-body">
                                    <h2>SHIPPING ADDRESS</h2>
                                    @php
                                     $user=auth()->user();

                                     $name=explode(' ',$user->name);
                                     $last_name="";
                                     $first_name=$name[0];
                                     if(isset($name[1]))
                                     {
                                        $last_name=$name[1];

                                     }




                                     @endphp

                                   <!--  <p><a href="login.html">Login</a> or <a href="#">Register</a> for faster payment.</p> -->


                                    <div class="row mt-2">
                                        <div class="col-sm-6"><label class="text-uppercase">First Name:</label>
                                            <div class="form-group"><input type="text" class="form-control" name="first_name" value="{{$first_name}}" required>
                                                <span class="help-block with-errors"></span>
                                            </div>

                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Last Name:</label>
                                            <div class="form-group"><input type="text" class="form-control" name="last_name" value="{{$last_name}}" required>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="text-uppercase">Contact Number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$user->phone}}" name="phone" required data-error="Phone number is required" pattern="^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$" maxlength="10" data-pattern-error="The phone number is invalid!">
                                        <span class="help-block with-errors"></span>
                                    </div>

                                    <label class="text-uppercase">Address</label>
                                    <div class="form-group"><input type="text" class="form-control" name="address" value="{{$user->address}}"  required>
                                        <span class="help-block with-errors"></span>

                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 mt-2 mt-md-0">
                            <!-- <div class="card card--grey">
                                <div class="card-body">
                                    <h2>DELIVERY METHODS</h2>
                                    <div class="clearfix"><input id="formcheckoutRadio1" value="" name="radio1" type="radio" class="radio" checked="checked"> <label for="formcheckoutRadio1">Standard Delivery $2.99 (3-5 days)</label></div>
                                    <div class="clearfix"><input id="formcheckoutRadio2" value="" name="radio1" type="radio" class="radio"> <label for="formcheckoutRadio2">Express Delivery $10.99 (1-2 days)</label></div>
                                    <div class="clearfix"><input id="formcheckoutRadio3" value="" name="radio1" type="radio" class="radio"> <label for="formcheckoutRadio3">Same-Day $20.00 (Evening Delivery)</label></div>
                                </div>
                            </div> -->

                            <div class="card card--grey">
                                <div class="card-body">
                                    <h2>PAYMENT METHOD</h2>
                                    <div class="clearfix"><input id="formcheckoutRadio4" value="normal" name="paymentType" type="radio" class="radio" checked="checked"> <label for="formcheckoutRadio4">Cash On Delivery</label></div>



                                </div>
                            </div>
                            <div class="mt-2"></div>
                            <div class="card card--grey">
                                <div class="card-body">
                                    <h3>ORDER COMMENT</h3><label class="text-uppercase">Write a comment here:</label> <textarea class="form-control textarea--height-200" name="order_comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 mt-md-0">
                            <h2 class="custom-color">ORDER SUMMARY</h2>
                            <div class="cart-table cart-table--sm">
                                <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                    <div class="cart-table-prd-image"></div>
                                    <div class="cart-table-prd-name"><b>ITEM</b></div>

                                    <div class="cart-table-prd-qty"><b>Size</b></div>
                                    <div class="cart-table-prd-qty"><b>Color</b></div>
                                     <!-- <div class="cart-table-prd-qty"><b>QTY</b></div> -->
                                    <div class="cart-table-prd-price"><b>PRICE</b></div>
                                </div>

                              <input type="hidden" name="products" value="{{$cartItems}}">

                                @foreach($cartItems as $item)





                                <div class="cart-table-prd">
                                    <div class="cart-table-prd-image"><a href="#"><img src="{{ getColorProductImage($item->id, $item->options->color) }}" alt=""></a></div>
                                    <div class="cart-table-prd-name">
                                        <h2><a href="#">{{$item->name}}</a></h2>
                                    </div>

                                    <div class="cart-table-prd-qty"><b>{{$item->options->size?get_size_name($item->options->size):'-'}}</b></div>
                                    <div class="cart-table-prd-qty"><b>{{$item->options->color?get_color_name($item->options->color):'-'}}</b></div>
                                    <!--  <div class="cart-table-prd-qty"><b>{{$item->qty}}</b></div> -->
                                    <div class="cart-table-prd-price"><b>{{$item->qty}}x{{$item->price}}= Rs.{{$item->subtotal}}</b></div>
                                </div>
                                @endforeach



                            </div>
                            <div class="card-total-sm">
                                <div class="float-right">Subtotal <span class="card-total-price">Rs.{{$cartSubTotalPrice}}</span></div>
                            </div>
                            <div class="mt-2"></div>
                            <!-- <div class="card card--grey">
                                <div class="card-body">
                                    <h3>APPLY PROMOCODE</h3><label class="text-uppercase">promo/student code:</label>
                                    <div class="form-flex">
                                        <div class="form-group"><input type="text" class="form-control"></div><button type="submit" class="btn btn--form btn--alt">Apply</button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="mt-2"></div>
                            <div class="clearfix"><button type="button" id="order_place" class="btn btn--lg w-100">Place Order</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="processing-cover">
    <div id="processing"><i class="fa fa-spinner fa-spin"></i> Processing</div>
  </div>
@endsection
@push('script')
 <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script type="text/javascript">
     function showProcessing() {
      document.getElementById('processing-cover').style.display = 'block';
    }

    function hideProcessing() {
      document.getElementById('processing-cover').style.display = 'none';
    }

   var form = document.getElementById("order_confirm");
    $('#order_place').on('click',function(){

        if (confirm("Are you sure?"))
         {
            showProcessing();

             form.submit();

         }
         hideProcessing();




    });


    // var vueInstance = new Vue({
    //   el: '#bsb-cart',
    //   data: {
    //     rawProducts: [],
    //     products: [],
    //     shippingAddress: {},
    //     NprToDollar: parseFloat('{{ $company->conversion_rate }}')
    //   },
    //   methods: {
    //     removeFromCart: function (id) {


    //       if (confirm("Are you sure?")) {
    //         location = '/remove-from-cart/' + id;
    //       }
    //     },
    //     normalCheckout: function () {
    //       if (confirm("Are you sure?")) {
    //         checkout('normal');
    //       }
    //     },
    //     updateCart:function(e){
    //         let redirect_url=e.currentTarget.getAttribute('data-url');
    //         window.location = redirect_url;
    //         return ;



    //     }
    //   },

    //   computed: {
    //     totalPrice: function () {
    //       return this.products.reduce(function (sum, product) {
    //         return sum + product.sellingPrice * product.quantity;
    //       }, 0);
    //     },
    //     totalPriceDollar: function () {
    //       return this.products.reduce(function (sum, product) {
    //         var sp = parseFloat((product.sellingPrice / this.NprToDollar).toFixed(2));
    //         return sum + sp * product.quantity;
    //       }.bind(this), 0);
    //     },
    //     cartProducts: function () {
    //       return this.products.map(function (product) {
    //         return {
    //           name: product.title,
    //           price: (product.sellingPrice / this.NprToDollar).toFixed(2),
    //           quantity: product.quantity,
    //           currency: 'USD'
    //         };
    //       }.bind(this));
    //     }
    //   },

    //   created: function () {
    //     this.rawProducts = @json($cartItems);



    //     this.products = this.rawProducts.map(function (product) {



    //       return {
    //         rowID:product.rowId,
    //         id: product.id,
    //         title: product.name,
    //         price:product.price,
    //         cart_quantity:product.qty,
    //         image:product.options.firstImage



    //       }
    //     });
    //   }
    // });



</script>


@endpush


