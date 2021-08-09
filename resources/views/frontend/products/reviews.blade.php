@extends('frontend.layouts.app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs --}}
    @include('frontend.components.hero', [
        'text' => 'Reviews',
        'breadcrumbLinks' => [
            ['name' => 'Home', 'route' => '/'],
            ['name' => 'Reviews', 'route' => ''],
        ]
    ])
    {{-- Hero > Breadcrumbs --}}

<section class="py-20 bg-light">
    <div class="container">
        <div class="text-dark">
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
@push('scripts')
<script>
    $(function() {
        let success_message = "{!! session()->get('success_message') !!}";
        if (success_message) {
            toastr.success(success_message);
        }
    });
</script>
@endpush
