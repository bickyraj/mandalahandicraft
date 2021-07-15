@extends('frontend.layouts.app')

@section('content')

@include('frontend.components.heroslider')

<section class="py-10 lg:py-30">
    <div class="container py-10">
        @include('frontend.components.homesectionslider', ['title' => "Best Sellers", 'products' => $popularProducts])
    </div>
</section>

<section>
    <div class="container">
        <div class="grid lg:grid-cols-3 lg:gap-20 bg-light">
            <div class="lg:col-span-2 p-10 lg:p-20 font-light text-xl text-dark">

                <h2 class="mb-10 font-display font-light text-4xl lg:text-8xl text-primary leading-none">{{ Setting::get('homePage')['block1']['title']??'' }}</h2>
                <div class="mb-6 editor">
                    <p>
                        {{ Setting::get('homePage')['block1']['content']??'' }}
                    </p>
                </div>
                <a href="" class="btn btn-secondary">Read more</a>
            </div>
            <div>
                <img src="{{ asset('uploads/site-settings/modified') . '/' . Setting::get('homePage')['block1']['image'] }}" alt="" class="block w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="py-10 lg:py-30">
    <div class="container py-10">
        @include('frontend.components.homesectionslider', ['title' => 'Discounts & Offers', 'products' => $saleProducts])
    </div>
</section>

<section class="mb-30">
    <div class="container container-max-md">
        <div class="grid lg:grid-cols-3 lg:gap-10 shadow-md rounded-lg px-10" style="background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);">
            <div class="pt-10"><img src="{{ asset('frontend/images/delivery.png') }}" alt="" style="max-height:15rem"></div>
            <div class="lg:col-span-2 py-10 lg:py-20">
                <h2 class="mb-10 font-display font-light text-4xl text-primary leading-none">Free Delivery</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab, sunt!</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-light">
    <div class="container">
        <div class="text-dark">
            <h2 class="mb-10 font-display font-light text-6xl text-primary leading-none">Hear it from our<br>
                <span class="lg:text-8xl">Customers</span></h2>
            <p class="mb-10 font-light text-xl" >
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae mollitia architecto doloremque at adipisci ex enim veniam ipsam quo dolore sed magnam libero accusamus temporibus pariatur magni quibusdam, deleniti praesentium quaerat!
            </p>
            <div class="mb-10 grid lg:grid-cols-2 gap-20">
                @for ($i = 0; $i < 2; $i++)

                <div class="grid grid-cols-4 gap-6">
                    <div>
                        <img src="{{ asset('frontend/images/product1.jpg') }}" alt="" class="block">
                    </div>
                    <div class="col-span-3">
                        <h3 class="mb-2 font-bold text-lg text-dark">Excellent</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae unde maiores amet ducimus ipsa possimus, modi sint, neque soluta rerum, enim optio iure. Libero aut beatae eos, architecto natus quidem?</p>
                        <div class="mb-4">
                            @for ($j = 0; $j < 5; $j++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill text-secondary" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @endfor
                        </div>
                        <div>
                            <span class="font-bold text-dark">John Doe</span>
                        </div>
                        <div class="italic">Lorem ipsum dolor </div>
                    </div>
                </div>

                @endfor
            </div>
            <a href="#" class="btn btn-secondary">More reviews</a>
        </div>
    </div>
</section>
@endsection
