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
                @forelse ($reviews as $review)
                    @include('frontend.partials.review_block', ['review' => $review])
                @empty

                @endforelse
            </div>
            <a href="{{ route('front.reviews') }}" class="btn btn-secondary">More reviews</a>
        </div>
    </div>
</section>
@endsection
