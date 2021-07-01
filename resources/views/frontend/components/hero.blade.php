@props(['text', 'image' => '', 'breadcrumbLinks'])

<section>
    <div class="bg-secondary py-20"
        @if ($image)
            style="background: center / cover url({{ $image }})"
        @endif
        >
        <div class="container">
            <h1 class="mb-10 font-bold text-lg lg:text-5xl text-white">
                {{ $text }}
            </h1>

            <x-breadcrumbs :links="$breadcrumbLinks" />
        </div>
    </div>
</section>