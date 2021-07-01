@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')
  <div class="card">
    @include('extras.index_header')

    <div class="card-content">
@if(auth()->user()->hasRole('admin'))
      <ul class="nav nav-pills nav-pills-warning">
        <li class="active">
          <a href="#adminProducts" data-toggle="tab">Our Products</a>
        </li>
        <li>
          <a href="#vendorProducts" data-toggle="tab">Vendors Products</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="adminProducts">
          <div class="table-responsive">
            <table class="table table-shopping" id="admin_product_table">
              <thead>
              <tr>
                <th width="40">SN.</th>
                <th>Image</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Price</th>
                <th>Category</th>
                <th width="80">Actions</th>
              </tr>
              </thead>
             
            </table>
          </div>
        </div>


        <div class="tab-pane" id="vendorProducts">
          
            <div class="table-responsive">
              <table class="table table-shopping" id="vendor_product_table" style="width:100%">
                <thead>
                <tr>
                <th width="40">SN.</th>
                <th width="200px">Image</th>
                <th width="200px">Vendor Name</th>
                <th width="200px">Vendor Email</th>
                <th width="200px">Title</th>
                <th width="200px">Quantity</th>
                <th width="200px">Discount</th>
                <th width="200px">Price</th>
                <th width="200px">Category</th>
                
              </tr>
                </thead>
               
              </table>
            </div>

            
       
        </div>
      </div>

  @endif

  @if(auth()->user()->hasRole('vendor'))


  <div class="tab-content">
    <div class="table-responsive">
        <table class="table" id="admin_product_table">
          <thead>
          <tr>
            <th width="40">SN.</th>
            <th>Image</th>
            <th>Title</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Price</th>
            <th>Category</th>
            <th width="80">Actions</th>
          </tr>
          </thead>
         
        </table>
      </div>
    
  </div>


  @endif

      
    </div>

  </div>
@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
     $('#admin_product_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('product.index')}}',
        columns: [
            {title:'SN',
                 render: function( data, type, full, meta ) {
                        return meta.row+1;
                    }
            },

            {data:'image',name:'image'},
            // {data: 'image', name: 'image',
            // render: function( data, type, full, meta ) {
            //             return "<img src=\"" + data + "\" style='height:180px;width:120px'/>";
            //         }

            // },
            {data: 'title', name: 'title'},
            {data: 'quantity', name: 'quantity'},
            {data: 'discount', name: 'discount'},
            {data: 'user_price', name: 'user_price'},
            {data:'category.name',name:'category.name'},
            
         {data: 'action', name: 'action', orderable: true, searchable: true}
        

        ],
            initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });



      $('#vendor_product_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{{route('product.vendor_products')}}',
         columns: [
             {title:'SN',
                  render: function( data, type, full, meta ) {
                         return meta.row+1;
                     }
             },

             {data:'image',name:'image'},
             // {data: 'image', name: 'image',
             // render: function( data, type, full, meta ) {
             //             return "<img src=\"" + data + "\" style='height:180px;width:120px'/>";
             //         }

             // },
             {data:'vendor.name',name:'vendor.name'},
             {data:'vendor.email',name:'vendor.email'},
             {data: 'title', name: 'title'},
             {data: 'quantity', name: 'quantity'},
             {data: 'discount', name: 'discount'},
             {data: 'user_price', name: 'user_price'},
             {data:'category.name',name:'category.name'},




         ],
             initComplete: function () {
             this.api().columns().every(function () {
                 var column = this;
                 var input = document.createElement("input");
                 $(input).appendTo($(column.footer()).empty())
                 .on('change', function () {
                     column.search($(this).val(), false, false, true).draw();
                 });
             });
         }
     });




    });


</script>
@endpush



