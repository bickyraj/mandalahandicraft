@extends('admin.layouts.app')

@section('title', 'Add New '. ucfirst($routeType))

@section('content')

  <form action="{{$edit?route($routeType.'.update',$model):route($routeType.'.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="sub_category_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{ $edit?'Edit':'Add a New' }} {{ ucfirst($routeType) }}</h4>
      </div>

      <div class="card-content">

        <div class="row">
          <div class="{{ $edit?'col-md-12':'col-md-4' }}">
            {{--category_id--}}
            <div class="form-group">
              <label class="control-label" for="category_id">Category</label>
              <select name="category_id"
                      id="category_id"
                      class="selectpicker"
                      data-style="select-with-transition"
                      data-size="5"
                      data-live-search="true"
                      required="true">
               <!--  <option value="">Choose Category</option> -->
              
                  <option value="{{$category->id}}"
                     selected >{{$category->name}}</option>
              
              </select>
              <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
            </div>
            {{--./category_id--}}
          </div>
          <div class="{{ $edit?'col-md-12':'col-md-12' }}">
            <div class="asdh-add_multiple_container">
              {{--file--}}
              <div class="form-group">
                <label for="image">Image</label>
                <input type="text"
                       class="form-control"
                       readonly
                       value="{{$edit?$model->getOriginal('image'):''}}">
                <input type="file" class="form-control" name="{{$edit?'image':'image[]'}}" accept="image/*">
              </div>
              {{--./file--}}

              {{--name--}}
              <div class="form-group">
                <label class="" for="name">Name
                  <small>*</small>
                </label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="{{$edit?'name':'name[]'}}"
                       value="{{$edit?$model->name:''}}"
                       placeholder="Enter Sub Category Name"
                       required="true"/>
                @if(!$edit)
                  <span class="asdh-add_remove_multiple add" title="Add">
                <i class="material-icons">add_circle</i>
              </span>
                @endif
              </div>
              {{--./name--}}
            </div>
          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2">{{$edit?'Update':'Save'}}</button>
        </div>
        {{--./submit--}}

      </div>

    </div>
  </form>
@endsection

@push('script')
  @include('extras.tinymce')
  <script>
    $(document).ready(function () {
      $('#name').focus();

      $('#sub_category_validation').validate({
              submitHandler: function(form) {
              var $buttonToDisable = $('.btn-prevent-multiple-submit2');
              $buttonToDisable.prop('disabled', true);
               $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());
               form.submit();

               }

              });

      @if(!$edit)
      /*Add and remove multiple fields starts*/
      var html = '', multipleAddLimitStart = 1, multipleAddLimitEnd = 5;

      html += '<div>';
      html += '<div class="form-group" style="margin-top: 30px;">';
      html += ' <input type="text" class="form-control" readonly placeholder="Other Image">';
      html += ' <input type="file" class="form-control" name="image[]" accept="image/*" />';
      html += '</div>';

      html += '<div class="form-group asdh-remove_margin_padding_from_add_remove_multiple">';
      html += ' <input type="text" class="form-control" name="name[]" placeholder="Other Sub Category Name"/>';
      html += ' <span class="asdh-add_remove_multiple remove" title="Remove"><i class="material-icons">delete</i></span>';
      html += '</div>';
      html += '</div>';

      $('.asdh-add_remove_multiple.add').on('click', function (e) {
        e.preventDefault();
        var $appendTo = $('.asdh-add_multiple_container');
        if (multipleAddLimitStart < multipleAddLimitEnd) {
          $($appendTo).append(html);
          multipleAddLimitStart++;
        } else {
          alert('Limit reached.')
        }

        $('.asdh-add_remove_multiple.remove').on('click', function (e) {
          e.preventDefault();
          $(this).parent().parent().remove();
          // I am assigning this value to multipleAddLimitStart because when remove button is clicked,
          // the event triggers for the number of html added to the container.
          multipleAddLimitStart = ($appendTo.children().length-1);
        });
      });
      /*Add and remove multiple fields ends*/
      @endif
    });
  </script>
@endpush