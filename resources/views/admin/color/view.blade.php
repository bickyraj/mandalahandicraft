@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')
<div class="card">
  @include('extras.index_header')
  
  <div class="card-content">
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th width="40">SN.</th>
          
          <th>Name</th>
          <th>Image</th>
         
          <th width="200" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($colors as $key=>$color)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>
              {{$color->name}}
            </td>
            <td><img src="{{ $color->modified_image() }}" alt="" style="width: 60px"></td>
            <td class="asdh-edit_and_delete td-actions text-center">
              @include('extras.edit_delete', ['modal'=>$color, 'add_sub_category'=>false , 'message'=>'You will not be able to recover your data in the future.'])
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">No data available</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

 
</div>




@endsection



  @push('script')
    <script>
    $(document).ready(function(){
     $('.table').dataTable({
       "paging": true,
       "lengthChange": true,
       "lengthMenu": [10, 15, 20],
       "searching": true,
       "ordering": true,
       "info": false,
       "autoWidth": false,
       'columnDefs': [{
         'orderable': false,
         'targets': [1, 4]
       }]
     });


      });

    </script>
     
  @endpush