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
            <th>Image</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th width="80">Actions</th>
          </tr>
          </thead>
          <tbody>
         
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection


  @push('script')
    <script>
      $(document).ready(function () {
        $('table').dataTable({
          "paging": true,
          "lengthChange": true,
          "lengthMenu": [10, 15, 20],
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          'columnDefs': [{
            'orderable': false,
            'targets': [3]
          }]
        });
      });
    </script>
  @endpush
