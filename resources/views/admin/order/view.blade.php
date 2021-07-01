@extends('admin.layouts.app')

@section('title', 'All Orders')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    #processing-cover {
      position   : fixed;
      left       : 0;
      right      : 0;
      top        : 0;
      bottom     : 0;
      background : rgba(0, 0, 0, 0.9);
      z-index    : 9999;
      display    : none;
    }

    #processing {
      position      : fixed;
      top           : 50%;
      left          : 50%;
      background    : #555;
      color         : #fff;
      padding       : 10px 15px;
      border-radius : 25px;
    }
    
    .nav-tabs {
    background: darkseagreen;
    border: 0;
    border-radius: 3px;
    padding: 0 15px;
}

[v-cloak] {
    display: none !important;
}
  </style>
@endpush

@section('content')

  <div id="vue-instance" v-cloak>
    <div class="card">
      <div class="card-header card-header-text"
           data-background-color="green">
        <h4 class="card-title">All Orders</h4>
      </div>

      <div class="card-content">
       <!--  <div class="order-status-indicator order-pending"></div>
        Pending
        <div class="order-status-indicator order-processing"></div>
        Processing
        <div class="order-status-indicator order-delivered"></div>
        Delivered -->
        @if(auth()->user()->hasRole('admin'))
          <ul class="nav nav-pills nav-pills-warning">
                <li class="active">
                    <a href="#admin" data-toggle="tab" aria-expanded="false">Admin Orders</a>
                </li>
                <li class="">
                    <a href="#vendor" data-toggle="tab" aria-expanded="true">Vendor Orders</a>
                </li>
                                        
            </ul>
            
            
            <div class="tab-content">
                <div class="tab-pane active" id="admin">
                   
                    
           
                      
                  <div class="table-responsive">
                    <table class="table datatable">
                      <thead>
                      <tr>
                        <th width="100">Order ID</th>
                        <th>Ordered At</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Address</th>
                        <th width="80">Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                         @forelse($admin_orders as $key=>$order)
                          <tr class="order">
                            <td>{{$order->order_code}}</td>
                            <td>{{$order->created_at->format('M d, h:i a')}}</td>
                            <td>{{optional($order->user)->name}}</td>
                            <td>{{$order->user->phone}}</td>
                            <td>{{$order->user->address}}</td>
                          
                            <td class="asdh-edit_and_delete td-actions">
                              <button type="button"
                                      class="btn btn-warning"
                                      data-toggle="modal"
                                      data-target="#view-products"
                                      @click="getProducts({{ $order->id }},'owner')"
                                      title="View Detail">
                                <i class="material-icons">remove_red_eye</i>
                              </button>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="6">No data available</td>
                          </tr>
                        @endforelse
                      
                      </tbody>
                    </table>
                  </div>
            
        </div>
        <!--end of admin orders-->
                
      <div class="tab-pane" id="vendor">
                    
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
            <tr>
              <th width="100">Order ID</th>
              <th>Ordered At</th>
              <th>Vendor Name</th>
              <th>Vendor Email</th>
              <th>Customer Address</th>
              
              <th width="80">Actions</th>
            </tr>
            </thead>
            <tbody>

               @forelse($vendor_orders as $key=>$order)
                <tr class="order">
                  <td>{{$order->order_code}}</td>
                  <td>{{$order->created_at->format('M d, h:i a')}}</td>
                  <td>{{optional($order->user)->name}}</td>
                  <td>{{$order->user->phone}}</td>
                  <td>{{$order->user->address}}</td>
                  
                  <td class="asdh-edit_and_delete td-actions">
                    <button type="button"
                            class="btn btn-warning"
                            data-toggle="modal"
                            data-target="#view-products"
                            @click="getProducts({{ $order->id }},'vendor')"
                            title="View Detail">
                      <i class="material-icons">remove_red_eye</i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">No data available</td>
                </tr>
              @endforelse
              
           
            </tbody>
          </table>
        </div>

   </div>
</div>

            @endif

   @if(auth()->user()->hasRole('vendor'))
   <div class="table-responsive">
     <table class="table datatable">
       <thead>
       <tr>
         <th width="100">Order ID</th>
         <th>Ordered At</th>
         <th>Customer Name</th>
         <th>Customer Phone</th>
         <th>Customer Address</th>
         <th width="80">Actions</th>
       </tr>
       </thead>
       <tbody>
          @forelse($vendor_orders as $key=>$order)
           <tr class="order-{{ $order->status }}">
             <td>{{$order->order_code}}</td>
             <td>{{$order->created_at->format('M d, h:i a')}}</td>
             <td>{{optional($order->user)->name}}</td>
             <td>{{$order->user->phone}}</td>
             <td>{{$order->user->address}}</td>
           
             <td class="asdh-edit_and_delete td-actions">
               <button type="button"
                       class="btn btn-warning"
                       data-toggle="modal"
                       data-target="#view-products"
                       @click="getProducts({{ $order->id }},'owner')"
                       title="View Detail">
                 <i class="material-icons">remove_red_eye</i>
               </button>
             </td>
           </tr>
         @empty
           <tr>
             <td colspan="6">No data available</td>
           </tr>
         @endforelse
       
       </tbody>
     </table>
   </div>





   @endif





           
         
       

     
      </div>
    </div>


    @include('admin.order.popup')

  </div>

  <div id="processing-cover">
    <div id="processing"><i class="fa fa-spinner fa-spin"></i> Sending Email</div>
  </div>


@endsection


  @push('script')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <script>

       function showProcessing() {
        document.getElementById('processing-cover').style.display = 'block';
      }

      function hideProcessing() {
        document.getElementById('processing-cover').style.display = 'none';
      }


      

 new Vue({
        el: '#vue-instance',

        data: {
          products: [],
          shipping:{},
          order_status:['pending','processing','delivered'],
          user_id:0,
         
          
        },

        

        methods: {

           getProducts: function (orderId,type) {
           
               this.products = [];

            axios.get('{{ url('admin/order') }}' + '/' + orderId + '/products?type='+type)
                 .then(function (response) {
                
                 

                   this.products = response.data.products;
                   console.log(this.products);


                   this.shipping=response.data.shipping;
                  
                 }.bind(this))
                 .catch(function (reason) {
                   console.log(reason);
                 });
          },
         

          changeStatus: function (id,order_id,event) {
            
            
           let url='{{url('admin/order/change-status')}}'+'/'+id;
            showProcessing();
            axios.get(url + "?status=" + event.target.value+'&order_id='+order_id)
                 .then(function (response) {
                 
                   hideProcessing();
                     toastr.success(response.data)
                     // location.reload()
                
                   })
                 .catch(function (reason) {
                   hideProcessing();
                  
                 })
          },

          detail(slug)
          {
             let location = '/products/' + slug;
            window.open(location, "_blank");    
            
          }
         
        },
         computed: {
          totalQuantity: function () {
            return this.products.reduce(function (sum, currentValue) {
              return sum + currentValue.quantity;
            }, 0);
          },

          totalPrice: function () {
            // Fixed reduce function which takes in an Array and returns sum
            return this.products.reduce(function (sum, currentValue) {
              console.log(sum);
              
              return sum + currentValue.rate * currentValue.quantity;
            }, 0);
          }
        },
        mounted(){
          Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
           this.user_id=this.$userId
           
        }

       
      });


     

      // $(document).ready(function () {
      //   $('.datatable').dataTable({
      //     "paging": true,
      //     "lengthChange": true,
      //     "lengthMenu": [10, 15, 20],
      //     "searching": true,
      //     "ordering": true,
      //     "info": false,
      //     "autoWidth": false,
      //     "order": [],
      //     'columnDefs': [{
      //       'orderable': false,
      //       'targets': [0, 1, 5, 6]
      //     }]
      //   });
      // });
    </script>
  @endpush
