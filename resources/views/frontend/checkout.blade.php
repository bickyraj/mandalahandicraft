@extends('layouts/app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs --}}
    <x-hero text='Checkout' :breadcrumb-links="[
                    ['name' => 'Home', 'route' => route('home')],
                    ['name' => 'Checkout', 'route' => route('checkout')],
                ]" />
    {{-- Hero > Breadcrumbs --}}

    <section>

        <div class="container pt-10 pb-20">

            <div class="grid lg:grid-cols-3 gap-20 pt-15">
                <div>
                    <h2 class="mb-10 font-bold text-2xl text-secondary">Review Orders</h2>
                    <div class="text-secondary"><a href="{{ route('cart') }}">Edit items in bag</a></div>

                    <div class="lg:col-span-2 grid grid-cols-2 lg:grid-cols-5">
                        <div class="none lg:block p-2 col-span-3 text-center border-bottom-light">Item</div>
                    <div class="none lg:block p-2 border-bottom-light">Quantity</div>
                    <div class="none lg:block p-2 border-bottom-light">Subtotal</div>
                    @for ($i = 0; $i < 2; $i++)
                        <div class="col-span-2 lg:col-span-3 flex items-start p-4 lg:border-bottom-light">
                            <img src="{{ asset('images/product1.jpg')}}" class="mr-2 w-20" alt="">
                            <div>
                                <div class="font-bold text-lg text-dark">
                                    <a href="#">Lorem ipsum dolor sit amet.</a>
                                </div>
                                <div class="text-dark">
                                    $170.00
                                </div>
                            </div>
                        </div>
                        <div class="p-4 text-dark border-bottom-light">
                            <span class="lg:none">Qty: </span>
                            <span class="font-bold">1</span>
                        </div>
                        <div class="p-4 text-dark border-bottom-light">
                            <span class="lg:none">Subtotal: </span>
                            <span class="font-bold">$170.00</span>
                        </div>
                    @endfor
                    <div class="lg:col-span-4 p-2 font-bold text-right">Total</div>
                    <div class="p-2 font-bold">$340.00</div>
                    <div class="lg:col-span-4 p-2 font-bold text-right">Delivery Fee</div>
                    <div class="p-2 font-bold">Not estimated</div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <form action="">
                        <div class="grid lg:grid-cols-2 gap-10">
                            <div>
                                <h2 class="mb-10 font-bold text-2xl text-secondary">Shipping Address</h2>
                                <div class="mb-4">
                                    <label for="name" class="block mb-2 text-primary">Name</label>
                                    <input type="text" id="name" class="border-light px-6 py-4 w-full" required
                                        placeholder="Name" autocomplete="name">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block mb-2 text-primary">Email</label>
                                    <input type="email" id="email" class="border-light px-6 py-4 w-full" required
                                        placeholder="Email" autocomplete="email">
                                </div>
                                <div class="mb-4">
                                    <label for="tel" class="block mb-2 text-primary">Phone number</label>
                                    <input type="tel" id="tel" class="border-light px-6 py-4 w-full" required
                                        placeholder="Phone Number" autocomplete="tel">
                                </div>
                                <div class="mb-4">
                                    <label for="street" class="block mb-2 text-primary">Street Address</label>
                                    <input type="text" id="street" class="border-light px-6 py-4 w-full" required
                                        placeholder="Street Address" autocomplete="street-address">
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
                                <div class="mb-4">
                                    <label for="country" class="block mb-2 text-primary">Country</label>
                                    <input type="text" id="country" class="border-light px-6 py-4 w-full" required
                                        placeholder="Country" autocomplete="postal-code">
                                </div>
                            </div>
                            <div>
                                <h2 class="mb-10 font-bold text-2xl text-secondary">Billing Address</h2>
                                <div class="mb-10">
                                    <input type="checkbox" id="samebilling">
                                    <label for="samebilling">Billing address is same as shipping address.</label>
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="block mb-2 text-primary">Name</label>
                                    <input type="text" id="name" class="border-light px-6 py-4 w-full" required
                                        placeholder="Name" autocomplete="name">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block mb-2 text-primary">Email</label>
                                    <input type="email" id="email" class="border-light px-6 py-4 w-full" required
                                        placeholder="Email" autocomplete="email">
                                </div>
                                <div class="mb-4">
                                    <label for="tel" class="block mb-2 text-primary">Phone number</label>
                                    <input type="tel" id="tel" class="border-light px-6 py-4 w-full" required
                                        placeholder="Phone Number" autocomplete="tel">
                                </div>
                                <div class="mb-4">
                                    <label for="street" class="block mb-2 text-primary">Street Address</label>
                                    <input type="text" id="street" class="border-light px-6 py-4 w-full" required
                                        placeholder="Street Address" autocomplete="street-address">
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
                                <div class="mb-4">
                                    <label for="country" class="block mb-2 text-primary">Country</label>
                                    <input type="text" id="country" class="border-light px-6 py-4 w-full" required
                                        placeholder="Country" autocomplete="postal-code">
                                </div>
                            </div>
                            <div>
                                <h2 class="mb-10 font-bold text-2xl text-secondary">Payment Details</h2>
                                <div class="mb-4">
                                    <label for="ccno" class="block mb-2 text-primary">Credit Card No.</label>
                                    <input type="text" id="ccno" class="border-light px-6 py-4 w-full" required
                                        placeholder="Credit Card No." autocomplete="cc-number">
                                </div>
                                <h3>Card Expiration Date</h3>   
                                <div class="grid grid-cols-2 gap-10 mb-4">
                                    <div>
                                        <label for="ccexpmonth" class="block mb-2 text-sm text-dark">Month</label>
                                        <input type="number" id="ccexpmonth" class="border-light px-6 py-4 w-full" required
                                        placeholder="MM">
                                    </div>
                                    <div>
                                        <label for="ccexpyear" class="block mb-2 text-sm text-dark">Year</label>
                                        <input type="number" id="ccexpyear" class="border-light px-6 py-4 w-full" required
                                        placeholder="YYYY">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Place Order</button>
                    </form>
                </div>

            </div>
        </div>
    </section>


@endsection
