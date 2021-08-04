<div class="product-card border-light hover:border-secondary relative">

    <a href="{{ route('frontend.products.detail', $product->slug) }}" class="block product-card-image">
        <img src="{{ getProductImage($product->id) }}" alt="">
    </a>
    <div class="absolute bg-secondary p-2 text-white" style="top:1rem; left: 0;">
        10% off
    </div>
    <div class="p-4 text-center">
        <h3 class="mb-4 font-bold text-lg text-dark truncate">
            <a href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->title }}</a>
        </h3>
        <div class="mb-4">
            @for ($j = 0; $j < ceil($product->rating()); $j++)
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill text-secondary" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            @endfor
        </div>
        <div class="mb-6">
            <s class="text-light">${{ number_format($product->old_price) }}</s>
            <span class="text-lg text-dark">${{ number_format($product->user_price) }}</span>
        </div>
        <form action="{{ route('add_to_cart', $product->slug) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-4 text-white" viewBox="0 0 16 16">
                    @include('frontend.components.bagpath')
                </svg>
                Add to bag
            </button>
        </form>
    </div>
</div>
