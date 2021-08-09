@extends('frontend.layouts.app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs --}}
    @include('frontend.components.hero', [
        'text' => 'My Bag',
        'breadcrumbLinks' => [
            ['name' => 'Home', 'route' => '/'],
            ['name' => 'My Bag', 'route' => route('cart-items')],
        ]
    ])
    {{-- Hero > Breadcrumbs --}}

    <section>
        <form action="{{route('update.cart')}}" method="post">
            @csrf
            <div class="container pt-10 pb-20">
                <div class="grid grid-cols-3 gap-20">
                    <div class="col-span-2 grid grid-cols-5">
                        <div class="p-2 col-span-3 text-center border-bottom-light">Item</div>
                        <div class="p-2 border-bottom-light">Quantity</div>
                        <div class="p-2 border-bottom-light">Subtotal</div>
                        @if($cartCount)
                            @foreach($cartItems as $item)
                                <input type="hidden" name="product_ids[]" value="{{$item->rowId}}">
                                <div class="col-span-3 flex p-4 border-bottom-light">
                                    <img src="{{ getColorProductImage($item->id, $item->options->color) }}" width="100" class="mr-2" alt="">
                                    <div>
                                        <div class="font-bold text-lg text-dark">
                                            <a href="#">{{$item->name}}</a>
                                        </div>
                                        <div class="text-dark">
                                            $ {{$item->price}}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 border-bottom-light">
                                    <input type="number" name="cart_quantity[{{$item->rowId}}]" id="" value="{{$item->qty}}" min="1" max="{{$item->options->stock}}" class="border-light p-2 w-20">
                                </div>
                                <div class="p-4 font-bold text-dark border-bottom-light">$ {{$item->subtotal}}</div>
                            @endforeach
                        @endif
                        <div class="col-span-4 p-2 font-bold text-right">Total</div>
                        <div class="p-2 font-bold">$ {{ $cartSubTotalPrice }}</div>
                        <div class="col-span-4 p-2 font-bold text-right">Delivery Fee</div>
                        <div class="p-2 font-bold">Not estimated</div>
                    </div>
                    <div class="bg-light p-10">
                        <div class="mb-4">
                            <label for="country" class="block mb-2 text-primary">Country</label>
                            <input type="text" id="country" class="border-light px-6 py-4 w-full"
                                placeholder="Country" autocomplete="postal-code">
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block mb-2 text-primary">City</label>
                            <input type="text" id="city" class="border-light px-6 py-4 w-full"
                                placeholder="City" autocomplete="address-level2">
                        </div>
                        <div class="mb-4">
                            <label for="postal" class="block mb-2 text-primary">Postal Code</label>
                            <input type="text" id="postal" class="border-light px-6 py-4 w-full"
                                placeholder="Postal Code" autocomplete="address-level2">
                        </div>
                        <button class="btn btn-secondary">Estimate Shipping & Taxes</button>
                    </div>
                </div>
                <a href="{{ route('checkout') }}" class="btn btn-secondary">Proceed to Checkout</a>
                <button type="submit"  class="btn btn-secondary" style="display: inline-block; background-color: #afafaf;"><i class="fa fa-update"></i><span>update cart</span></button>
            </div>
        </form>
    </section>
@endsection
