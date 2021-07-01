@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))
<style>

</style>
@section('content')
<div class="card">
  @include('extras.index_header')
  
  <div class="card-content">
    <div class="alert alert-success">Note: This page is to make different groups for the sizes of the product. Eg. Shoes might have sizes like 7, 8, 9 and pant might have sizes like 30, 31, 32 etc.</div>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th width="40">SN.</th>
          <th class="">Size Group</th>
          <th class="">Sizes</th>
          <th class="">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($groups as $key=>$group)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $group->name }}</td>
            <td>
              <select name="" id="" class="form-control">
                @if(isset($group->group_sizes))
                  @foreach($group->group_sizes as $size)
                    <option value="">
                      {{ $size->size }}
                    </option>
                  @endforeach
                @endif
              </select>
            </td>

            <td class="asdh-edit_and_delete td-actions text-center">
              @include('extras.edit_delete', ['modal'=>$group, 'add_sub_category'=>false , 'message'=>'You will not be able to recover your data in the future.'])
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
    $(document).ready(function () {

    });
  </script>
@endpush
