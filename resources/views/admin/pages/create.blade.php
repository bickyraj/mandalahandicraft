@extends('admin.layouts.app')

@section('title', 'Add New Page')

@section('content')

  <form action="{{$edit?route('admin.pages.update', $model):route('admin.pages.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="attribute_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{$edit?'Edit':'Add a New'}} Page</h4>
      </div>

      <div class="card-content">

        <div class="asdh-add_multiple_container">
          {{--name--}}
          <div class="form-group">
            <label class="" for="name">Page Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{$edit?$model->name:''}}"
                   required="true"/>
            @if(!$edit)
            @endif
          </div>

          <div class="form-group">
            <label class="" for="description">Description</label>
            <input type="text"
                   class="form-control"
                   id="description"
                   name="description"
                   value="{{$edit?$model->description:''}}"
                   required="true"/>
          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('admin.pages.index', request()->id)}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
  <script>
    $(document).ready(function () {
      $('#name').focus();

      $('#attribute_validation').validate({
              submitHandler: function(form) {
              var $buttonToDisable = $('.btn-prevent-multiple-submit2');
              $buttonToDisable.prop('disabled', true);
               $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());
               form.submit();

               }

              });

      @if(!$edit)
      /*Add and remove multiple fields starts*/
      var html = '', multipleAddLimit = 1;

      html += '<div class="form-group asdh-remove_margin_padding_from_add_remove_multiple">';
      html += ' <input type="text" class="form-control" name="name[]" placeholder="Other Attribute Name" required="true" />';
      html += ' <span class="asdh-add_remove_multiple remove" title="Remove"><i class="material-icons">delete</i></span>';
      html += '</div>';
      html += '</div>';

      $('.asdh-add_remove_multiple.add').on('click', function (e) {
        e.preventDefault();
        var $appendTo = $('.asdh-add_multiple_container');
        if (multipleAddLimit < 5) {
          $($appendTo).append(html);
          multipleAddLimit++;
        } else {
          alert('Limit reached, you can only add 5 attribute at a time! ')
        }

        $('.asdh-add_remove_multiple.remove').on('click', function (e) {
          e.preventDefault();
          $(this).parent().parent().remove();
          // I am assigning this value to multipleAddLimit because when remove button is clicked,
          // the event triggers for the number of html added to the container.
          multipleAddLimit = ($appendTo.children().length-1);
          console.log(multipleAddLimit);
        });
      });
      /*Add and remove multiple fields ends*/
      @endif

    });
  </script>
@endpush
