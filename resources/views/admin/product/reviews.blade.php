@extends('admin.layouts.app')

@section('title', 'All Reviews Of '.ucwords($product->title))

@section('content')

  <div class="card">
    <div class="card-header card-header-text" data-background-color="green">
      <h4 class="card-title">All <b>Reviews of {{ucwords($product->title)}}</b></h4>
    </div>

    <div class="card-content">
      <div class="table-responsive">
        <table class="table" id="bsb-reviews-table">
          <thead>
          <tr>
            <th width="60">#</th>
            <th width="100px">Review By</th>
            <th width="100px">Rating</th>
            <th>Comments</th>
            <th>Actions</th>
          </tr>
          </thead>
          
        </table>
      </div>
    </div>
  </div>
@endsection


  @push('script')
    <script>
     
      $('#bsb-reviews-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{{route('get_reviews',$product->id)}}',
         columns: [
             {title:'SN',
                  render: function( data, type, full, meta ) {
                         return meta.row+1;
                     }
             },

            {data:'user.name',name:'user.name'},
            {data:'rating',name:'rating'},
            {data:'review',name:'review'},
            {data:'action',name:'action'},




         ],
         order:[[1,'desc']],
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
    </script>
  @endpush
