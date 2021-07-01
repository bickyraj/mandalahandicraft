@extends('admin.layouts.app')

@section('title', 'Add New Size Group')

@section('content')

  <form action="{{ route('groups.store') }}"
        method="post"
        id="groups_validation">
      {{csrf_field()}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">Add New Size Group</h4>
      </div>

      <div class="card-content">
          <div class="asdh-add_multiple_container">
            {{--file--}}
            <div class="form-group">
              <label for="image">Size Group Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
              <label for="image">Assign Sizes <small> ( Press enter to add multiple sizes )</small></label>
              <select name="sizes[][size]" id="selectSize"  class="form-control" multiple="multiple" required>
                <option value="" disabled>Enter size</option>
              </select>
            </div>

          <div class="form-footer text-right">
             <a href="{{route('groups.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
            <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> Save</button>
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
    });
  </script>
@endpush