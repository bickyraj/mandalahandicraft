<div class="grid grid-cols-4 gap-6">
    <div>
        <img src="{{ $review->image_url }}" alt="" class="block">
    </div>
    <div class="col-span-3">
        <h3 class="mb-2 font-bold text-lg text-dark">{{ $review->title }}</h3>
        <p>{{ $review->review }}</p>
        <div class="mb-4">
            @for ($j = 0; $j < $review->rating; $j++)
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-star-fill text-secondary" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg>
            @endfor
        </div>
        <div>
            <span class="font-bold text-dark">{{ $review->name }}</span>
        </div>
        <div class="italic">{{ $review->country }}</div>
    </div>
</div>
