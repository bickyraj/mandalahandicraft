@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')

  <div class="card">
    @include('extras.index_header')

    <div class="card-content">
      <div class="table-responsive">
        <table class="table" id="news_table">
          <thead>
          <tr>
            <th width="40">SN.</th>
            <th>Image</th>
            <th>Title</th>
            <th>Slug</th>
            <th width="80">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($news as $key=>$n)
            <tr id="asdh-{{$n->id}}">
              <td>{{$key+1}}</td>
              <td width="60"><img src="{{$n->modified_image()}}" alt="{{$n->title}}"></td>
              <td>{{$n->title}}</td>
              <td>{{$n->slug}}</td>
              <td class="asdh-edit_and_delete td-actions">
                @include('extras.edit_delete', ['modal'=>$n, 'message'=>'You will not be able to recover your data in the future.'])
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4">No data available</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

@if($news->count())
  @push('script')
    <script>
      $(document).ready(function () {
        $('#news_table').dataTable({
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
@endif
