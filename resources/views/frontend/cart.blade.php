@extends('layouts/app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs --}}
    <x-hero text='My Bag' :breadcrumb-links="[
                    ['name' => 'Home', 'route' => route('home')],
                    ['name' => 'My Bag', 'route' => route('cart')],
                ]" />
    {{-- Hero > Breadcrumbs --}}

    <section>

        <div class="container pt-10 pb-20">
            <div class="grid grid-cols-3 gap-20">
                <div class="col-span-2 grid grid-cols-5">
                    <div class="p-2 col-span-3 text-center border-bottom-light">Item</div>
                    <div class="p-2 border-bottom-light">Quantity</div>
                    <div class="p-2 border-bottom-light">Subtotal</div>
                    @for ($i = 0; $i < 2; $i++)
                        <div class="col-span-3 flex p-4 border-bottom-light">
                            <img src="{{ asset('images/product1.jpg')}}" width="100" class="mr-2" alt="">
                            <div>
                                <div class="font-bold text-lg text-dark">
                                    <a href="#">Lorem ipsum dolor sit amet.</a>
                                </div>
                                <div class="text-dark">
                                    $170.00
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border-bottom-light">
                            <input type="number" name="" id="" value="1" min="1" max="5" class="border-light p-2 w-20">
                        </div>
                        <div class="p-4 font-bold text-dark border-bottom-light">$170.00</div>
                    @endfor
                    <div class="col-span-4 p-2 font-bold text-right">Total</div>
                    <div class="p-2 font-bold">$340.00</div>
                    <div class="col-span-4 p-2 font-bold text-right">Delivery Fee</div>
                    <div class="p-2 font-bold">Not estimated</div>
                </div>
                <div class="bg-light p-10">
                    <div class="mb-4">
                        <label for="country" class="block mb-2 text-primary">Country</label>
                        <input type="text" id="country" class="border-light px-6 py-4 w-full" required
                            placeholder="Country" autocomplete="postal-code">
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block mb-2 text-primary">City</label>
                        <input type="text" id="city" class="border-light px-6 py-4 w-full" required
                            placeholder="City" autocomplete="address-level2">
                    </div>
                    <div class="mb-4">
                        <label for="postal" class="block mb-2 text-primary">Postal Code</label>
                        <input type="text" id="postal" class="border-light px-6 py-4 w-full" required
                            placeholder="Postal Code" autocomplete="address-level2">
                    </div>
                    <button class="btn btn-secondary">Estimate Shipping & Taxes</button>
                </div>
            </div>
            <a href="{{ route('checkout') }}" class="btn btn-secondary">Proceed to Checkout</a>

        </div>
    </section>


@endsection
