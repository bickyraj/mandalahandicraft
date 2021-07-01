@extends('admin.layouts.app')

@section('title', 'Add New Color')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css">
<style>
  .colorpicker-saturation {
    width: 200px !important;
    height: 200px !important;
  }

  .colorpicker-hue, .colorpicker-alpha {
    height: 200px !important;
  }
</style>
@endpush

@section('content')

  <form action="{{$edit?route('color.update',$model):route('color.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="color_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{$edit?'Edit':'Add a New'}} Color</h4>
      </div>

      <div class="card-content">

        <div class="asdh-add_multiple_container">
          {{--file--}}
          <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" readonly value="{{$edit?$model->getOriginal('image'):''}}">
            <input type="file" class="form-control" name="{{$edit?'image':'image[]'}}" accept="image/*">
          </div>
          {{--./file--}}

          {{--name--}}
          <div class="form-group">
            <label class="" for="name">Color Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="{{$edit?'name':'name[]'}}"
                   value="{{$edit?$model->name:''}}"
                   required="true"/>
            @if(!$edit)
              <span class="asdh-add_remove_multiple add" title="Add">
                <i class="material-icons">add_circle</i>
              </span>
            @endif
          </div>


{{--          <div class="form-group">--}}
{{--                      <label class="" for="name">Color Code</label>--}}
{{--                      <input type="text"--}}
{{--                             class="form-control bsb-color-code"--}}
{{--                             id="color_code"--}}
{{--                             name="{{$edit?'color_code':'color_code[]'}}"--}}
{{--                             value="{{$edit?$model->color_code:''}}"--}}
{{--                             required="true"/>--}}
{{--                     --}}
{{--                    </div>--}}
        </div>

       

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('color.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#name').focus();

      function initColorPicker() {
        $('.bsb-color-code').colorpicker();
      }

      initColorPicker();

      
      $('#color_validation').validate({
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

      html += '<div>';
      html += '<div class="form-group" style="margin-top: 30px;">';
      html += ' <input type="text" class="form-control" readonly placeholder="Other Image">';
      html += ' <input type="file" class="form-control" name="image[]" accept="image/*" />';
      html += '</div>';

      html += '<div class="form-group asdh-remove_margin_padding_from_add_remove_multiple" style="margin-top:20px">';
      html += ' <input type="text" class="form-control" name="name[]" placeholder="Other Color Name"  />';
      html += ' <span class="asdh-add_remove_multiple remove" title="Remove"><i class="material-icons">delete</i></span>';
      html += '</div>';
      // html += '<div class="form-group" style="margin-top:20px">';
      // html += '<input type="text" class="form-control bsb-color-code" name="color_code[]" placeholder="Other Color Code"  />';

      // html+='</div>';
      html += '</div>';

      $('.asdh-add_remove_multiple.add').on('click', function (e) {
        e.preventDefault();
        var $appendTo = $('.asdh-add_multiple_container');
        if (multipleAddLimit < 5) {
          $($appendTo).append(html);
          multipleAddLimit++;
        } else {
          alert('Limit reached, you can only add 5 color at a time! ')
        }

        $('.asdh-add_remove_multiple.remove').on('click', function (e) {
          e.preventDefault();
          $(this).parent().parent().remove();
          // I am assigning this value to multipleAddLimit because when remove button is clicked,
          // the event triggers for the number of html added to the container.
          multipleAddLimit = ($appendTo.children().length-1);
          console.log(multipleAddLimit);
        });

        initColorPicker();
      });
      /*Add and remove multiple fields ends*/
      @endif
     

    });
  </script>
@endpush