@extends('admin.layouts.app')

@section('title', 'Edit Size Group')
<style>
  .add-sizes-button {
    margin: 20px !important;
  }
</style>
@section('content')
  <form action="{{ route('groups.update', $group) }}"
        method="post"
        id="groups_validation">
      {{csrf_field()}}

    {{ method_field('PUT') }}
    <div class="card">

      <button type="button" class="btn btn-primary pull-right btn-sm add-sizes-button"><i class="fa fa-plus"></i> Add More Sizes</button>


      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">Edit Size Group</h4>
      </div>

      <div class="card-content">
        <div class="asdh-add_multiple_container">

            {{--file--}}
            <div class="form-group">
              <label for="image">Size Group Name</label>
              <input type="text" class="form-control" name="name" required value="{{ $group->name }}">
            </div>

            <div class="form-group">
              <label for="image">Update Sizes <small> ( Press enter to add multiple sizes )</small></label>
                  @if(isset($group->group_sizes) && !empty($group->group_sizes))
                    @foreach($group->group_sizes as $key=>$size)
                      <div class="form-group">
                        <label for="">Size {{ $key+1 }}</label>
                        <input type="text" class="form-control" name="sizes[{{ $size->id }}]" value="{{ $size->size }}" required>
                        <span class="asdh-add_remove_multiple remove" title="Remove"><i class="material-icons">delete</i></span>
                      </div>
                    @endforeach

                      <div class="new-sizes">

                      </div>
                  @endif
            </div>

          <div class="form-footer text-right">
             <a href="{{route('groups.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
            <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> Update</button>
          </div>

       </div>

      </div>
    </div>
  </form>
@endsection

@push('script')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

  <script>
    $(document).ready(function () {
      $("#selectSize").select2({
        tags:true
      });

      let sizeCount = 1;
      $(document).on("click", ".add-sizes-button", function () {
        if (sizeCount > 5) {
          alert("limit reached");
        } else {
          let newSize = '<div class="form-group">\n' +
                  '                        <label for="">New Size</label>\n' +
                  '                        <input type="text" class="form-control" name="new_sizes['+sizeCount+']" value="" required>\n' +
                  '                        <span class="asdh-add_remove_multiple remove" title="Remove"><i class="material-icons">delete</i></span>\n' +
                  '                      </div>';
          sizeCount++;

          $(".new-sizes").append(newSize);

        }
      });

      $(document).on("click", ".remove", function (event) {
        $(this).closest(".form-group").remove();
      });
    });
  </script>
@endpush