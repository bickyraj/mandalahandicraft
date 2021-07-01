@extends('admin.layouts.app')

@section('title', 'Add New Brand')

@push('css')
@endpush

@section('content')

  <form action="{{$edit?route('brands.update',$model):route('brands.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="brands_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-brands="green">
        <h4 class="card-title">{{$edit?'Edit':'Add New'}} Brand</h4>
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
            <label class="" for="name">Brand Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="{{$edit?'brand_name':'brand_name[]'}}"
                   value="{{$edit?$model->brand_name:''}}"
                   required="true"/>
          </div>

          {{--Url--}}
          <div class="form-group">
            <label class="" for="name">Url</label>
            <input type="url"
                   class="form-control"
                   id="name"
                   name="{{$edit?'url':'url[]'}}"
                   value="{{$edit?$model->url:''}}"
            />
          </div>

        </div>

       

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('brands.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
  <script>
    $(document).ready(function () {
      $('#brands_validation').validate({
          submitHandler: function(form) {
          var $buttonToDisable = $('.btn-prevent-multiple-submit2');
          $buttonToDisable.prop('disabled', true);
           $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());
           form.submit();

           }

      });

    });
  </script>
@endpush