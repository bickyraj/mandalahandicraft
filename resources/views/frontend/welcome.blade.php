<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mandala Handicraft</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@300&family=Roboto:ital,wght@0,200;0,400;0,700;1,200&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.css">
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/css/sm-core-css.min.css"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        @include('includes/header')

        <main>
            <x-heroslider />

            <section class="py-30">
                <div class="container py-10">
                    <x-homesectionslider title="Best Sellers" />
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="grid lg:grid-cols-3 gap-20 bg-light">
                        <div class="lg:col-span-2 editor p-10 lg:p-20 font-light text-lg text-dark">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae mollitia architecto doloremque at adipisci ex enim veniam ipsam quo dolore sed magnam libero accusamus temporibus pariatur magni quibusdam, deleniti praesentium quaerat! Sit nemo voluptatibus in sed ut expedita rem, doloremque molestiae eveniet deserunt nulla et aspernatur quod accusamus pariatur eaque quasi nisi repellendus illum perferendis inventore enim eum laborum? Hic.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur repellendus officiis, quia laudantium eum recusandae at ad in ex natus?
                            </p>
                            <a href="" class="btn btn-primary">Read more</a>
                        </div>
                        <div>
                            <img src="{{ asset('images/artist.jpg') }}" alt="" class="block w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-30">
                <div class="container py-10">
                    <x-homesectionslider title="Discounts & Offers" />
                </div>
            </section>

            <section class="py-20 bg-light">
                <div class="container">
                    <div class="text-dark">
                        <h2 class="mb-10 font-display font-light text-4xl lg:text-6xl text-primary">Hear it from our customers</h2>
                        <p class="text-lg" >
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae mollitia architecto doloremque at adipisci ex enim veniam ipsam quo dolore sed magnam libero accusamus temporibus pariatur magni quibusdam, deleniti praesentium quaerat!
                        </p>
                        <div class="mb-10 grid lg:grid-cols-2 gap-20">
                            @for ($i = 0; $i < 2; $i++)
                                
                            <div class="grid grid-cols-4 gap-6">
                                <div>
                                    <img src="https://cdn.shopify.com/s/files/1/2545/2216/products/Mudra33_1024x.jpg?v=1569111841" alt="" class="block">
                                </div>
                                <div class="col-span-3">
                                    <h3 class="mb-2 font-bold text-lg text-dark">Excellent</h3>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae unde maiores amet ducimus ipsa possimus, modi sint, neque soluta rerum, enim optio iure. Libero aut beatae eos, architecto natus quidem?</p>
                                    <div>
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
                        <a href="" class="btn btn-primary">More reviews</a>
                    </div>
                </div>
            </section>

        </main>

        @include('includes/footer')
        
        {{-- <script src="{{ asset('js/home.js') }}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/smartmenus@1.1.1/dist/jquery.smartmenus.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.6.1/dist/gsap.min.js"></script>

        @stack('scripts')
    </body>
</html>
