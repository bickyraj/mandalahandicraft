@extends('frontend.layouts.app')

@section('content')

    <section class="container mb-20 pt-20 content">
        <article class="grid lg:grid-cols-3 gap-20">
            <div>
                <div class="image-area">
                    <img class="mb-2 block image-trigger border-light" src="{{ $product->images[0]->modified_image() }}" data-zoom="{{ $product->images[0]->modified_image() }}" style="cursor: zoom-in">
                </div>
                {{-- Controls --}}
                <div>
                    <ul class="showcase-images-nav flex flex-wrap">
                        @if($product->product_type == 0)
                            @if(isset($product->images) && $product->images->count())
                                @foreach($product->images as $key => $image)
                                    <li>
                                        <button data-targetsrc="{{ $image->modified_image() }}" class="{{ ($key == 0)?'active':'' }}">
                                            <img src="{{ $image->modified_image() }}" alt="">
                                        </button>
                                    </li>
                                @endforeach
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="detail lg:col-span-2 grid lg:grid-cols-3 gap-10 relative">
                <section class="lg:col-span-2">
                    <h1 class="mb-4 font-display text-dark text-4xl">{{ucwords($product->title)}}</h1>
                    @if ($product->rating() > 0)
                        <div class="mb-10">
                            @for ($j = 0; $j < $product->rating(); $j++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill text-secondary" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @endfor
                            <span class="ml-6 text-sm italic text-light">10 ratings</span>
                        </div>
                    @endif
                    <div class="mb-4">
                        <h2 class="mb-2 font-bold text-xl text-dark">Specifications</h2>
                        <ul class="mb-6">
                            <li class="mb-2">
                                <span class="font-bold mr-10">Dimensions:</span>  {{ $product->dimensions }}
                            </li>
                            <li class="mb-2">
                                <span class="font-bold mr-10">Weight:</span> {{ $product->weight }}
                            </li>
                            <li class="mb-2">
                                <span class="font-bold mr-10">Materials:</span> {{ $product->materials }}
                            </li>
                        </ul>
                    </div>
                    <h2 class="visually-hidden">Price</h2>
                    <div class="mb-6 font-bold text-3xl text-dark">Rs. {{ number_format($product->user_price) }}</div>

                    <h2 class="mb-2 text-dark">Select Quantity</h2>
                    <form action="{{ route('add_to_cart', $product->slug) }}" method="post">
                        @csrf
                        <div class="flex mb-6">
                            <button id="decrease-qty" class="flex justify-center items-center w-10 h-10 bg-secondary text-white">-</button>
                            <input type="hidden" name="quantity" value="1" data-min="1" data-max="{{$product->quantity}}">
                            <span id="product-quantity" class="flex justify-center items-center w-20 h-10 bg-white">1</span>
                            <button id="increase-qty" class="flex justify-center items-center w-10 h-10 bg-secondary text-white">+</button>
                        </div>
                        <button type="submit" class="btn btn-secondary">Add to Cart</button>
                    </form>
                </section>
                <div class="bg-light px-4 py-6">
                    <div class="flex">
                        <svg viewBox="0 0 512 512" class="flex-shrink-0 mr-6 w-8 h-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                <path d="M392.772,298.432L375.432,298.432C371.29,298.432 367.932,301.789 367.932,305.932C367.932,310.075 371.29,313.432 375.432,313.432L392.772,313.432C396.914,313.432 400.272,310.075 400.272,305.932C400.272,301.789 396.914,298.432 392.772,298.432Z" style="fill-rule:nonzero;"/>
                                <path d="M217.895,182.443C222.037,182.443 225.395,179.086 225.395,174.943C225.395,170.8 222.037,167.443 217.895,167.443L187.913,167.443C183.771,167.443 180.413,170.8 180.413,174.943L180.413,234.926C180.413,239.069 183.771,242.426 187.913,242.426L217.895,242.426C222.037,242.426 225.395,239.069 225.395,234.926C225.395,230.783 222.037,227.426 217.895,227.426L195.413,227.426L195.413,212.435L217.895,212.435C222.037,212.435 225.395,209.078 225.395,204.935C225.395,200.792 222.037,197.435 217.895,197.435L195.413,197.435L195.413,182.443L217.895,182.443Z" style="fill-rule:nonzero;"/>
                                <path d="M276.877,182.443C281.019,182.443 284.377,179.086 284.377,174.943C284.377,170.8 281.019,167.443 276.877,167.443L246.895,167.443C242.753,167.443 239.395,170.8 239.395,174.943L239.395,234.926C239.395,239.069 242.753,242.426 246.895,242.426L276.877,242.426C281.019,242.426 284.377,239.069 284.377,234.926C284.377,230.783 281.019,227.426 276.877,227.426L254.395,227.426L254.395,212.435L276.877,212.435C281.019,212.435 284.377,209.078 284.377,204.935C284.377,200.792 281.019,197.435 276.877,197.435L254.395,197.435L254.395,182.443L276.877,182.443Z" style="fill-rule:nonzero;"/>
                                <path d="M100.913,182.443C105.055,182.443 108.413,179.086 108.413,174.943C108.413,170.8 105.055,167.443 100.913,167.443L70.931,167.443C66.789,167.443 63.431,170.8 63.431,174.943L63.431,234.926C63.431,239.069 66.789,242.426 70.931,242.426C75.073,242.426 78.431,239.069 78.431,234.926L78.431,212.435L100.913,212.435C105.055,212.435 108.413,209.078 108.413,204.935C108.413,200.792 105.055,197.435 100.913,197.435L78.431,197.435L78.431,182.443L100.913,182.443Z" style="fill-rule:nonzero;"/>
                                <path d="M166.413,204.936L166.413,174.944C166.413,170.801 163.055,167.444 158.913,167.444L128.931,167.444C124.789,167.444 121.431,170.801 121.431,174.944L121.431,234.927C121.431,239.07 124.789,242.427 128.931,242.427C133.073,242.427 136.431,239.07 136.431,234.927L136.431,214.732L152.673,239.088C154.118,241.256 156.496,242.428 158.92,242.428C160.35,242.428 161.795,242.02 163.074,241.167C166.52,238.868 167.451,234.212 165.153,230.766L152.929,212.436L158.913,212.436C163.055,212.436 166.413,209.078 166.413,204.936ZM151.413,197.436L136.431,197.436L136.431,182.444L151.413,182.444L151.413,197.436Z" style="fill-rule:nonzero;"/>
                                <path d="M-0,87.209L-0,388.601C-0,403.604 12.206,415.809 27.208,415.809L44.444,415.809C48.215,436.369 66.265,451.998 87.898,451.998C109.531,451.998 127.581,436.369 131.352,415.809L382.326,415.81C386.097,436.37 404.147,451.999 425.779,451.999C447.411,451.999 465.462,436.37 469.233,415.81L483.935,415.81C499.41,415.81 511.999,403.22 511.999,387.746L511.999,287.768C512,272.155 499.299,259.454 483.687,259.454L440.645,259.454L440.645,143.155C440.645,127.68 428.055,115.091 412.581,115.091L347.81,115.091L347.81,87.209C347.81,72.206 335.604,60.001 320.602,60.001L27.208,60.001C12.206,60.001 -0,72.206 -0,87.209ZM87.897,378.643C103.986,378.643 117.075,391.732 117.075,407.821C117.075,423.91 103.986,437 87.897,437C71.808,437 58.719,423.91 58.719,407.821C58.719,391.732 71.809,378.643 87.897,378.643ZM425.78,436.999C409.691,436.999 396.602,423.909 396.602,407.82C396.602,391.731 409.691,378.642 425.78,378.642C441.869,378.642 454.958,391.731 454.958,407.82C454.958,423.909 441.869,436.999 425.78,436.999ZM332.809,400.81L131.519,400.809C128.15,379.769 109.872,363.642 87.897,363.642C65.922,363.642 47.645,379.77 44.276,400.81L27.208,400.81C20.477,400.81 15,395.333 15,388.602L15,338.422L332.809,338.422L332.809,400.81ZM496.999,298.432L477.041,298.432C464.635,298.432 454.541,308.526 454.541,320.932C454.541,333.338 464.634,343.432 477.041,343.432L497,343.432L497,387.745C497,394.949 491.139,400.809 483.936,400.809L469.402,400.809C466.033,379.769 447.755,363.642 425.78,363.642C403.805,363.642 385.528,379.769 382.159,400.809L347.809,400.809L347.809,130.091L412.58,130.091C419.784,130.091 425.644,135.951 425.644,143.155L425.644,144.902L375.431,144.902C371.289,144.902 367.931,148.259 367.931,152.402L367.931,266.954C367.931,271.097 371.289,274.454 375.431,274.454L483.686,274.454C491.027,274.454 496.999,280.427 496.999,287.767L496.999,298.432ZM497,328.432L477.041,328.432C472.906,328.432 469.541,325.068 469.541,320.932C469.541,316.796 472.905,313.432 477.041,313.432L497,313.432L497,328.432ZM15,323.422L15,87.209C15,80.478 20.477,75.001 27.208,75.001L320.601,75.001C327.332,75.001 332.809,80.478 332.809,87.209L332.809,323.422L15,323.422ZM425.645,159.902L425.645,259.454L382.932,259.454L382.932,159.902L425.645,159.902Z" style="fill-rule:nonzero;"/>
                        </svg>
                        <div>
                            <div class="mb-2 font-bold text-dark text-lg">
                                Free Delivery
                            </div>
                            <div class="text-sm">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, accusantium.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <section class="container mb-10" x-data="{ tab: 'details' }">
        <div class="flex sticky-top bg-white">
            <a href="#details" class="detail-link flex-grow-1 mr-1 px-6 py-4 font-bold text-center bg-light text-dark">
                Details
            </a>
            {{-- <a href="#reviews" class="detail-link flex-grow-1 mr-1 px-6 py-4 font-bold text-center bg-light text-dark">
                Reviews
            </a> --}}
            <a href="#faqs" class="detail-link flex-grow-1 px-6 py-4 font-bold text-center bg-light text-dark">
                FAQs
            </a>
        </div>
        <div class="editor px-10 border-light">
            <div id="details" class="detail-section pt-10">
                <h2>Features</h2>
                {!! $product->description !!}
            </div>
            {{-- REVIEWS --}}
            {{-- <div id="reviews" class="detail-section pt-10">
                <h2>Reviews</h2>
                <div class="grid grid-cols-3">
                    <div>
                        <div class="font-bold text-3xl text-light text-center w-20">4.5</div>
                        @for ($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill text-secondary" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                        @endfor
                    </div>
                </div>
                <div class="mb-10 grid lg:grid-cols-2 gap-10">
                    @for ($i = 0; $i < 5; $i++)
                        <div>
                            <h3>Excellent</h3>
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
                    @endfor
                </div>
            </div> --}}
            <div id="faqs" class="detail-section mb-10 pt-10">
                @if ($product->has('faqs'))
                <h2>FAQs</h2>
                @forelse ($product->faqs as $faq)
                    <h3>{{ $faq->name }}</h3>
                    <p>{{ $faq->description }}</p>
                @empty
                @endforelse
                @endif
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/drift-zoom@1.4.3/dist/Drift.min.js"></script>
<script>
        var imageTrigger = document.querySelector('.image-trigger')
        var paneContainer = document.querySelector('.detail')
        const showcaseImagesTriggers = document.querySelectorAll('.showcase-images-nav button')

        const drift = new Drift(imageTrigger, {
            paneContainer: paneContainer,
            inlinePane: false,
        });

        showcaseImagesTriggers.forEach(btn => {
            const targetSrc = btn.dataset.targetsrc

            btn.addEventListener('click', () => {
                imageTrigger.setAttribute('src', targetSrc)
                imageTrigger.dataset.zoom = targetSrc
                showcaseImagesTriggers.forEach(el => {
                    el.classList.remove('active')
                })
                btn.classList.add('active')
            })
        })

    //Scrollspy
    const detailLinks = document.querySelectorAll('.detail-link')
    const obs = new IntersectionObserver( (entries, observer) => {
        entries.forEach(entry => {
            const relatedLink = document.querySelector(`[href="#${entry.target.id}"]`)
            if(entry.isIntersecting){
                console.log(`${entry.target.id} intersected`);
                relatedLink.classList.add('bg-primary')
                relatedLink.classList.add('text-white')
                relatedLink.classList.remove('bg-light')
                relatedLink.classList.remove('text-dark')
            } else {
                console.log(`${entry.target.id} left intersection`);
                relatedLink.classList.add('bg-light')
                relatedLink.classList.add('text-dark')
                relatedLink.classList.remove('bg-primary')
                relatedLink.classList.remove('text-white')
            }
        })
    }, {
        rootMargin: "-9% 0px -90% 0px"
    })
    const detailSections = document.querySelectorAll('.detail-section')
    detailSections.forEach(section => {
        obs.observe(section)
    })

    const quantity_input = $("input[name='quantity']");
    $("#increase-qty").on('click', function(event) {
        let quantity = quantity_input.val();
        if (quantity <= quantity_input.data('max')) {
            quantity = parseInt(quantity) + 1;
            quantity_input.val(quantity);
            updateQuantityDiv(quantity);
        }
    });

    $("#decrease-qty").on('click', function(event) {
        let quantity = quantity_input.val();
        if (quantity > 1) {
            quantity = parseInt(quantity) - 1;
            quantity_input.val(quantity);
            updateQuantityDiv(quantity);
        }
    });

    function updateQuantityDiv(quantity) {
        $("#product-quantity").html(quantity);
    }
</script>
@endpush
