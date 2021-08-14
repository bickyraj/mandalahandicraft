@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')
<div class="card">
    <div class="card-header card-header-text" data-background-color="green">
      <h4 class="card-title">All Pages</h4>

    </div>
    {{--create new--}}
    <a href="{{ route($routeType.'.create', request()->id) }}" class="btn btn-success btn-round btn-xs create-new">
      <i class="material-icons">add_circle_outline</i> New {{$routeType}}
    </a>

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
        @forelse($pages as $key=>$page)
          <tr>
            <td>{{ $key+1 }}</td>
            <td width="200" class="text-center">
                {{ $page->name }}
            </td>
            <td class="asdh-edit_and_delete td-actions text-center">
              <a href="{{ route('admin.pages'.'.edit', $page) }}" type="button" class="btn btn-success asdh-edit" title="Edit">
                <i class="material-icons">edit</i>
              </a>
              <button type="button"
                      class="btn btn-danger asdh-delete"
                      data-toggle="modal"
                      data-target="#delete_popup_{{'pages'.$page->id}}"
                      title="Delete">
                <i class="material-icons">close</i>
              </button>

              <div class="modal fade asdh-delete make-darker"
                   id="delete_popup_{{'pages'.$page->id}}"
                   tabindex="-1"
                   role="dialog"
                   aria-labelledby="myModalLabel"
                   aria-hidden="true">
                <div class="modal-dialog">
                  <form action="{{route('admin.pages.destroy', $page->id)}}" method="POST" class="modal-content">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                      </button>
                      <h4 class="modal-title">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                      {{-- <p>{{ $message }}</p> --}}
                    </div>
                    <div class="modal-footer text-center">
                      <button type="submit" class="btn btn-danger">Yes Delete It</button>
                      <button type="button" class="btn btn-success" data-dismiss="modal">No Don't Delete It</button>
                    </div>
                  </form>
                </div>
              </div>
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
    {{ $pages->links() }}
  </div>
</div>
@endsection
@if($pages->count())
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

        var $page = $('.faq-priority');
        var initialPriorityValue;
        $page.on('focus', function () {
          initialPriorityValue = $(this).val();

        });
        $page.on('blur', function () {
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
