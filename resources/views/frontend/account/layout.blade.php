@extends('frontend.layouts.app')
@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>{{$title}}</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row">
                   @include('frontend.account.menubar')

                   @section('body')

                   @show





                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
 <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script> -->
<script type="text/javascript">
    

// var vueInstance = new Vue({
//  el: '#bsb-cart',
//   data: {
//         rawProducts: [],
//         products: [],
//         shippingAddress: {},
      
//       },
//       methods: {
//         removeFromCart: function (id) {
            
          
//           if (confirm("Are you sure?")) {
//             location = '/remove-from-cart/' + id;
//           }
//         },
       
//         updateCart:function(e){
//             let redirect_url=e.currentTarget.getAttribute('data-url');
//             window.location = redirect_url;
//             return ;


           
//         }
//       },


//     });



</script>


@endpush



    