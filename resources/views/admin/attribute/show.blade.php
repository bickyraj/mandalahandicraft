@extends('admin.layouts.app')

@section('title', 'All attributes of ' . $attribute->name)

@section('content')

  <div class="card">
    <div class="card-header card-header-text" data-background-color="green">
      <h4 class="card-title">All Sub attributes of <b>{{ $attribute->name }}</b></h4>

    </div>
    {{--create new--}}

    <a href="{{ route($routeType.'.create',['attribute_id'=>$attribute->id]) }}"
       class="btn btn-success btn-round btn-xs pull-right">
      <i class="material-icons">add_circle_outline</i> New Sub attribute
    </a>

    <a href="{{ request()->is('admin/attribute*')? route('attribute.index'):'' }}"
       class="btn btn-default btn-round btn-xs pull-right">
      <i class="fa fa-arrow-circle-left"></i> Go Back
    </a>


    <div class="card-content">
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th width="40">SN.</th>
            <th>Image</th>
            <th>Name</th>
            <th width="100">Actions</th>
          </tr>
          </thead>
          <tbody>
          @forelse($sub_attributes as $key=>$sub_attribute)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>
                <img src="{{ $sub_attribute->image() }}" alt="" style="width: 50px;height: 50px;">
              </td>
              <td>
                @if($sub_attribute->has_children())
                  <a href="{{ route('sub-attribute.show', $sub_attribute) }}">
                    {{ $sub_attribute->name }} ({{ $sub_attribute->sub_attributes()->count() }})
                    <i class="material-icons" style="font-size:16px;">remove_red_eye</i>
                  </a>
                @else
                  {{ $sub_attribute->name }}
                @endif
              </td>
              <td class="asdh-edit_and_delete td-actions">
                <a href="{{ route('sub-attribute.create',['attribute_id'=>$sub_attribute->id]) }}"
                   type="button"
                   class="btn btn-warning asdh-edit"
                   title="Add Sub attribute to this sub attribute">
                  <i class="material-icons">add</i>
                </a>
                @include('extras.edit_delete', ['modal'=>$sub_attribute , 'message'=>'You will not be able to recover your data in the future.'])
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

@if($sub_attributes->count())
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
            'targets': [1,3]
          }]
        });
      });
    </script>
  @endpush
@endif
