@extends('frontend.layouts.app')

{{-- @section('title', '') --}}

@section('content')
    {{-- Hero > Breadcrumbs --}}
    @include('frontend.components.hero', [
        'text' => $category->name,
        'breadcrumbLinks' => [
            ['name' => 'Home', 'route' => '/'],
            ['name' => 'Category', 'route' => ''],
        ]
    ])
    {{-- Hero > Breadcrumbs --}}

<section class="py-20 bg-light">
    <div class="container">
        <div class="text-dark">
            <div class="mb-10 grid lg:grid-cols-3 gap-20">
                @forelse ($products as $product)
                    @include('frontend.components.productcard', ['product' => $product])
                @empty

                @endforelse
            </div>
            {{-- <a href="{{ route('front.reviews') }}" class="btn btn-secondary">More reviews</a> --}}
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
