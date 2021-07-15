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
          <th class="text-center">Name</th>
          <th width="200" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($attributes as $key=>$attribute)
          <tr>
            <td>{{ $key+1 }}</td>
            <td width="200" class="text-center">
                <a href="{{ route($routeType.'.show', $attribute) }}"
                   title="View Sub Categories Of {{ $attribute->name }}">
                  {{ $attribute->name }}
                  <i class="material-icons" style="font-size:16px;">remove_red_eye</i>
                </a>
            </td>
            <td class="asdh-edit_and_delete td-actions text-center">
              @include('extras.edit_delete', ['modal'=>$attribute, 'add_sub_attribute'=>true , 'message'=>'You will not be able to recover your data in the future.'])
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

  <div class="text-center">
    {{ $attributes->links() }}
  </div>
</div>




@endsection


@if($attributes->count())
  @push('script')
    <script>
      $(document).ready(function () {
        $('.show-on-menu').on('change', function () {
          var url = $(this).data('url');

          $.ajax({
            url: url,
            success: function (response) {
              showSuccessMessage(response.message);
            },
            error: function (response) {
              console.log('Error: ', response);
            }
          })
        });

        $('.make-exclusive').on('change', function () {
          var url = $(this).data('url');

          $.ajax({
            url: url,
            success: function (response) {
              showSuccessMessage(response.message);
            },
            error: function (response) {
              console.log('Error: ', response);
            }
          })
        });

        var $attribute = $('.attribute-priority');
        var initialPriorityValue;
        $attribute.on('focus', function () {
          initialPriorityValue = $(this).val();

        });
        $attribute.on('blur', function () {
          if (initialPriorityValue !== $(this).val()) {
            $.ajax({
              url: $(this).data('url'),
              data: {
                priority: $(this).val()
              },
              success: function (response) {
                showSuccessMessage(response.message);
                setTimeout(function(){ location.reload(); }, 1000);
              },
              error: function (response) {
                console.log('Error: ', response);
              }
            })
          }
        });
      });
    </script>
  @endpush
@endif
