@extends('frontend.account.layout')
@section('body')
 <div class="col-md-9 aside">
                        <h2>My Wishlist</h2>
                        <div class="cart-table cart-table--wishlist">
                            @forelse($wishlists as $w)
                            <div class="cart-table-prd">
{{--                                <div class="cart-table-prd-image"><a href="#"><img src="{{$w->firstImage}}" alt=""></a></div>--}}
                                <div class="cart-table-prd-image"><a href="#"><img src="{{ getProductImage($w->id) }}" alt=""></a></div>
                                <div class="cart-table-prd-name">
                                    <h5><a href="#">{{$w->brand?optional($w->brand)->brand_name:'-'}}</a></h5>
                                    <h2><a href="{{route('frontend.products.detail',$w->slug)}}">{{$w->title}}</a></h2>
                                </div>
                                <div class="cart-table-prd-price"><span>price:</span> <b>Rs. {{number_format($w->sellingPrice(),2)}}</b></div>
                                <div class="cart-table-addtocart">
                                     <a href="{{route('add.wish',$w->id)}}" class="icon-cross delete-from-wishlist" title="Remove from wishlist"></a></div>
                            </div>
                            @empty
                             <div class="cart-table-prd">
                                <center>No Items on your wishlist!</center>


                             </div>

                            @endforelse

                        </div>
                    </div>
@endsection

@push('script')
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script>
    $(function() {
        $(document).on("click", ".delete-from-wishlist", function (event) {
            event.preventDefault();
            let url = $(this).attr("href");
            let message = 'You want to remove?'
            swal({
                title: "Are you sure?",
                text: message,
                dangerMode: true,
                buttons: {
                    cancel:'Cancel',
                    confirm: {
                        value: 'Ok',
                        className: 'confirm-delete-btn'
                    }
                }
            }).then(result => {
                if (result) {
                    $.get(url, function (){
                        location.reload();
                    });
                } else {
                }
            });
        });
    });
</script>
@endpush
