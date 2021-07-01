@props(['title', 'products'])

<div class="home-section-slider-section">
    <div class="mb-10 flex justify-between mb-4">
        <h2 class="font-display font-light text-4xl lg:text-8xl text-primary leading-none">{{ $title }}</h2>
        <div class="flex controls">
            <button class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle text-secondary" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </button>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right-circle text-secondary" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="slider">
        @foreach ($products as $product)
            <div>
                <x-productcard :product="$product"/>
            </div>
        @endforeach
    </div>
</div>

@once
    @push('scripts') 
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const homeSliderSections = document.querySelectorAll('.home-section-slider-section')
                homeSliderSections.forEach(el => {
                    const controlsContainer = el.querySelector('.controls')
                    const slider = tns({
                        container: el.querySelector('.slider'),
                        mode: "carousel",
                        gutter: 10,
                        controlsContainer: controlsContainer,
                        loop: false,
                        items: 1,
                        responsive: {
                            568: {
                                items: 2,
                            },
                            768:{
                                items: 4,
                                slideBy: "page",
                            },
                            992: {
                                items: 5
                            }
                        }
                    })
                })
            })
        </script>
    @endpush
@endonce