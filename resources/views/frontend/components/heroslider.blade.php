
<div class="hero relative">
    <div class="hero-slider">
        @forelse ($sliders as $slider)
        <div class="relative">
            <img src="{{ $slider->mobile_image() }}" alt="" class="block">
            <div class="slide-text flex justify-center items-center px-4 pt-4 pb-10 absolute text-white text-center">
                <div>
                    <div class="text-line text-line-1 none lg:block mb-4 text-xl uppercase">
                        {{ $slider->sub_title }}
                    </div>
                    <div class="text-line text-line-2 mb-4 font-display text-3xl lg:text-6xl">
                        {{ $slider->title }}
                    </div>
                    <div class="text-line text-line-3 none lg:block mb-8 text-xl">
                        {{ $slider->offer_title }}
                    </div>
                    <a href="" class="btn btn-secondary">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    <div class="hero-slider-controls none md:block">
        <button class="mr-2 absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle text-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
            </svg>
        </button>
        <button class="absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right-circle text-white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
            </svg>
        </button>
    </div>
    <div class="hero-slider-nav absolute flex justify-center">
        @for ($i = 0; $i < $sliders->count(); $i++)
            <button class="mr-4 w-2 h-2 bg-white"></button>
        @endfor
    </div>
</div>

@push('scripts')
    <script>
        const heroSlider = tns({
            mode: 'gallery',
            container: '.hero-slider',
            autoplay: true,
            autoplayButtonOutput: false,
            controlsContainer: '.hero-slider-controls',
            navContainer: '.hero-slider-nav',
        })
    </script>
@endpush
