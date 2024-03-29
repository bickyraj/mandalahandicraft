@extends('admin.layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('title', 'Add New Category')

@section('content')

  <form action="{{$edit?route('category.update',$model):route('category.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="category_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{$edit?'Edit':'Add a New'}} Category</h4>
      </div>

      <div class="card-content">

        <div class="asdh-add_multiple_container">
          {{--file--}}
          {{-- <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" readonly value="{{$edit?$model->getOriginal('image'):''}}">
            <input type="file" class="form-control" name="{{$edit?'image':'image[]'}}" accept="image/*">
          </div> --}}
          {{--./file--}}

          {{--name--}}
          <div class="form-group">
            <label class="" for="name">Category Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{$edit?$model->name:''}}"
                   required="true"/>
          </div>
          <div class="form-group">
            <label class="" for="name">Attributes</label>
            <select class="js-example-basic-multiple form-control" name="attributes[]" multiple="multiple">
                @foreach ($attributes as $attribute)
                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('category.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {
    $('.js-example-basic-multiple').select2();
      $('#name').focus();

      $('#category_validation').validate({
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

      html += '<div class="form-group asdh-remove_margin_padding_from_add_remove_multiple">';
      html += ' <input type="text" class="form-control" name="name[]" placeholder="Other Category Name" required="true" />';
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
          alert('Limit reached, you can only add 5 category at a time! ')
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
