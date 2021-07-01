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

  <div class="page-content" id="bsb-cart" >
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>Cart</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <h1 class="text-center">Shopping Cart</h1>
                <div class="cart-table">

<form action="{{route('update.cart')}}" method="post">
  @csrf
  @if($cartCount)



                  @foreach($cartItems as $item)
                  <input type="hidden" name="product_ids[]" value="{{$item->rowId}}">
                  


                    <div class="cart-table-prd">
                        <div class="cart-table-prd-image"><a href="#"><img src="{{ getColorProductImage($item->id, $item->options->color) }}" alt="{{$item->name}}"></a></div>
                        <div class="cart-table-prd-name">
                            <h5><a href="#">canverse</a></h5>
                            <h2><a href="#">{{$item->name}}</a></h2>
                        </div>

                     
                        <div>
                          <span>Size:</span>
                          @if(($item->options->size!==null) && ($item->options->all_sizes!==null))

                          <div class="form-group select-wrapper" style="width:100px">
                            
                            <select name="size[{{$item->rowId}}]" class="form-control">
                            @foreach($item->options->all_sizes as $s)

                            
                            <option value="{{$s['id']}}" {{$s['id']==$item->options->size?'selected':''}} >{{$s['size']}}
                            </option>
                            @endforeach
                           
                            
                          </select>

                          </div>
                          @else

                          -

                          @endif

                          
                        </div>
                   

                       
                       
                          <div>
                            <span>Color:</span>

                          @if(($item->options->color!==null) && ($item->options->all_colors!==null) )
                            <div class="form-group select-wrapper" style="width:100px">
                              
                              <select name="color[{{$item->rowId}}]" class="form-control">
                              @foreach($item->options->all_colors as $c)

                              
                              <option value="{{$c['id']}}" {{$c['id']==$item->options->color?'selected':''}} >{{$c['name']}}
                              </option>
                              @endforeach
                             
                              
                            </select>

                            </div>
                               @else
                               <div>
                              -
                             </div>


                               @endif
                            
                          </div>
                       

                        <div class="cart-table-prd-price"><span>price:</span><b style="font-size:11px">Rs.</b> {{$item->price}}<b></b>
                        </div>
                       
                         <div class="prd-block_qty"><span class="option-label">Qty:</span>
                                <div class="qty qty-changer">
                                    <fieldset>
                                        <!-- <input type="button" value="&#8210;" class="decrease">  -->
                                        <a href="#"  class="decrease btn btn-xs btn-danger"> - </a>
                                        <input readonly name="cart_quantity[{{$item->rowId}}]" type="text" class="qty-input" value="{{$item->qty}}" data-min="1" data-max="{{$item->options->stock}}"> 
                                        <!-- <input type="button" value="+" class="increase"> -->
                                        <a href="#"  class="increase btn btn-xs btn-primary" > + </a>
                                    </fieldset>
                                </div><span class="option-label">max <span class="qty-max">{{$item->options->stock}}</span> item(s) left</span>
                         </div>

                     
                        <div class="cart-table-prd-price" style="width: 250px">
                          <span style="margin-left: 100px">Total price:Rs. <b>{{$item->subtotal}}</b></span>
                        </div>
                        <div class="cart-table-prd-action">
                          <!--   <a href="#" class="icon-heart"></a>  -->
                            <!-- <a href="#" class="icon-pencil"></a> --> 
                            <a href="javascript:void(0)" title="Remove Form Cart"  onclick="removeFromCart('{{$item->rowId}}')" class="icon-cross"></a>
                        </div>
                    </div>
                 @endforeach
           
                    
                    
                    <div class="cart-table-total">
                        <div class="row">
                            <div class="col-sm"> 
                                <a href="{{route('clear-cart')}}" 
                                onclick="return confirm('Are you sure?')" 
                                class="btn btn--alt"><i class="icon-cross"></i><span>clear shopping cart</span></a>
                                <button type="submit"  class="btn btn--grey"><i class="icon-repeat"></i><span>update cart</span></button>
                            </div>
                            <div class="col-sm-auto"><a href="{{route('home')}}" class="btn"><i class="icon-angle-right"></i><span>continue shopping</span></a></div>
                        </div>
                    </div>
                     </form>
                    @else
                    <h3 align="center">You have no items in the shopping cart!</h3>

                    @endif
                </div>
                <div class="mt-3 mt-lg-5">
                    <div class="row vert-margin">
                       <!--  <div class="col-md-4">
                            <h3>SHIPPING ESTIMATES</h3><label class="text-uppercase">Country:</label>
                            <div class="form-group select-wrapper"><select class="form-control">
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                    
                                </select></div><label class="text-uppercase">State:</label>
                            <div class="form-group select-wrapper"><select class="form-control">
                                    <option value="AL">Alabama</option>
                                    
                                </select></div><label class="text-uppercase">zip/postal code:</label>
                            <div class="form-group"><input type="text" class="form-control"></div>
                        </div> -->
                        <!-- <div class="col-md-4">
                            <h3>ORDER COMMENT</h3><label class="text-uppercase">Write a comment here:</label> <textarea class="form-control textarea--height-200"></textarea>
                        </div> -->
                        @if($cartCount)
                        <div class="col-md-4">
                            <div class="card-total text-uppercase">Subtotal Rs.<span class="card-total-price">{{$cartSubTotalPrice}}</span></div>
                            @if(auth()->check() && (auth()->user()->hasRole('normal') || auth()->user()->hasRole('wseller')))
                            <a href="{{route('checkout')}}" class="btn btn--full btn--lg">proceed to checkout</a>
                             @else
                            <h3 class="alignleft">You must login to place your order  @endif</h3>
                                @if(!auth()->user()) <a href="{{ route('customer_login') }}" class="btn btn-success">Log In</a>
                             @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<!--  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script> -->
<script type="text/javascript">
 

    function removeFromCart(product)
    {
     
       if (confirm("Are you sure?")) {
            location = '/remove-from-cart/' + product;
          }

    }


    




</script>


@endpush


