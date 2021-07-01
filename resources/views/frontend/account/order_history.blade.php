@extends('frontend.account.layout')
@section('body')
<div class="col-md-9 aside">
                        <h2>Order History</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-order-history">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Total Price</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                   @php 
                                    $total=0;
                                    $sub_total=0;  

                                   @endphp
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td><b>{{$order->order_code}}</b>
                                            <button data-toggle="modal" data-target="#orderDetail{{ $order->id }}"  class="btn btn-primary btn-sm m-2">View Details</button>
                                        </td>
                                        <td>{{$order->created_at->format('F d,Y')}}</td>
                                        <td><span class="color">Rs.{{ number_format(getOrderTotal($order->id)) }}</span></td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog mw-100 w-75" role="document">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="exampleModalLabel">Order Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="cart-table">
                                                            @if(isset($order->products) && $order->products->count())
                                                                @foreach($order->products as $product)
                                                                    <div class="cart-table-prd">
                                                                        <div class="cart-table-prd-image"><a href="{{ route('frontend.products.detail', $product->product->slug) }}"><img src="{{ getColorProductImage($product->product_id, $product->color_id) }}" alt="Corporis rerum sit"></a></div>
                                                                        <div class="cart-table-prd-name">
                                                                            <a href="{{  route('frontend.products.detail', $product->product->slug) }}"><h5></h5>
                                                                            <h5><strong>{{ $product->product->title }}</strong></h5></a>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Size</a></h5>
                                                                            <h5>
                                                                                @if(isset($product->size->size))
                                                                                    <b>
                                                                                    {{ $product->size->size }}
                                                                                    </b>
                                                                                    @else
                                                                                    -
                                                                                @endif
                                                                            </h5>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Quantity</a></h5>
                                                                            <h5><b>{{ $product->quantity }}</b></h5>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Price</a></h5>
                                                                            <h5><b>{{ $product->rate }}</b></h5>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Total</a></h5>
                                                                            <h5><b>{{ $product->quantity*$product->rate }}</b></h5>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Color</a></h5>
                                                                            <h5>@if(isset($product->color->name))
                                                                                    <b>
                                                                                        {{ $product->color->name }}
                                                                                    </b>
                                                                                @else
                                                                                    -
                                                                                @endif</h5>
                                                                        </div>

                                                                        <div class="cart-table-prd-name">
                                                                            <h5><a href="#">Status</a></h5>
                                                                            <h5><b>{{ $product->status }}</b></h5>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5"><center>You have not order anything till now!</center></td>
                                        
                                    </tr>

                                    @endforelse
                                   
                                    
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                       <!--  <div class="text-right mt-2"><a href="#" class="btn btn--alt">Clear History</a></div> -->
                    </div>
@endsection