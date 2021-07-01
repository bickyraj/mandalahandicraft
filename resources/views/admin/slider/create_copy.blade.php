@extends('admin.layouts.app')

@section('title', 'Add a new '. ucfirst($routeType))

<style>
    @media (min-width: 768px) {
        .modal-xl {
            width: 95% !important;
            max-width:1200px !important;
        }
    }
</style>
@section('content')

  <form action="{{$edit?route($routeType.'.update',$model):route($routeType.'.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="slider_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{ $edit?'Edit':'Add a New '. ucfirst($routeType) }}</h4>
      </div>

      <div class="card-content">
        {{--image--}}
        @if($edit)
          @include('extras.input_image', ['input_image'=>$model->modified_image()])
        @else
          @include('extras.input_image')
        @endif

          <div class="card-body">
              <div class="row">
                  <div class="col-lg-12 col-md-12 sol-sm-12 hidden" id="imagePreviewContainer">
                      <div id="upload-demo"></div>
                  </div>

                  <div class="col-lg-6 col-md-12 sol-sm-12 hidden">
                      <div id="upload-demo-i" style="background:#e1e1e1;width:100%;padding:16px;height:350px;margin-top:30px"></div>
                  </div>
              </div>
          </div>
        {{--./image--}}

        {{--title--}}
        <div class="form-group" {{ $errors->has('title')?'has-error is-focused':'' }}>
          <label for="title">{{ ucwords('title') }}</label>
          <input type="title"
                 class="form-control"
                 id="title"
                 name="title"

                 value="{{$edit?old('title')??$model->title:old('title')}}"/>

                 <span style="color: #808080;font-style: italic; font-size:13px">(Optional Field)</span>

        </div>
        {{--./title--}}

        {{--sub title--}}
        <div class="form-group" {{ $errors->has('sub_title')?'has-error is-focused':'' }}>
          <label for="sub_title">{{ ucwords('sub title') }}</label>
          <input type="sub_title"
                 class="form-control"
                 id="sub_title"
                 name="sub_title"

                 value="{{$edit?old('sub_title')??$model->sub_title:old('sub_title')}}"/>

                 <span style="color: #808080;font-style: italic; font-size:13px">(Optional Field)</span>

        </div>
        {{--./sub title--}}

        {{--offer title--}}
        <div class="form-group" {{ $errors->has('offer_title')?'has-error is-focused':'' }}>
          <label for="offer_title">{{ ucwords('offer title') }}</label>
          <input type="offer_title"
                 class="form-control"
                 id="offer_title"
                 name="offer_title"

                 value="{{$edit?old('offer_title')??$model->offer_title:old('offer_title')}}"/>

                 <span style="color: #808080;font-style: italic; font-size:13px">(Optional Field)</span>

        </div>
        {{--./offer title--}}

        {{--url--}}
        <div class="form-group" {{ $errors->has('url')?'has-error is-focused':'' }}>
          <label for="url">{{ ucwords('url') }} <small>*</small></label>
          <input type="url"
                 class="form-control"
                 id="url"
                 name="url"
                 required="true"
                 value="{{$edit?old('url')??$model->url:old('url')}}"/>

        </div>
        {{--./url--}}

        {{--submit--}}
        <div class="form-footer text-right">
          <a href="{{route('slider.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>
        {{--./submit--}}

      </div>

    </div>
  </form>

  <!-- Small modal -->
  <div class="modal" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Crop Image</button>
              </div>
          </div>
      </div>
  </div>

@endsection

@push('script')
    <script src="{{ asset('plugins/cropper/croppie.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/cropper/croppie.css') }}">
  <script>
    $(document).ready(function () {
      $('#slider_validation').validate({
              submitHandler: function(form) {
              var $buttonToDisable = $('.btn-prevent-multiple-submit2');
              $buttonToDisable.prop('disabled', true);
               $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());
               form.submit();

               }
        });

      let $uploadDemo = $('#upload-demo');
      let $imagePreviewContainer = $('#imagePreviewContainer');
        $uploadCrop = $uploadDemo.croppie({
            enableExif: true,
            viewport: {
                width: 960,
                height: 425,
            },
            boundary: {
                width: 1050,
                height: 600
            },
            enableOrientation: true,
        });

        $('#image').on('change', function () {
            $imagePreviewContainer.removeClass('hidden');

            if(this.files[0].size < 10 * 1024 * 1024) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result,
                        orientation: 1,
                        setZoom: 1
                    }).then(function () {
                        $uploadCrop.croppie('setZoom', 0);
                        $('#image_cropper').removeClass('hidden');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            }else{
                var message = 'File size too large. Support only image smaller than 10MB.\n';
                alert(message);
                // $('#imageAlert').modal({backdrop: 'static', keyboard: false})
                // $('#imageAlert').find('.modal-body h3').text(message);
                // $('#imageAlert').modal('show');
            }
        });

        $uploadCrop.on('update.croppie', function (ev, cropData) {
            updateCroppedImage();
        });

        function updateCroppedImage() {
            $imagePreviewContainer.removeClass('hidden');
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: { width: 1920, height: 850 },
            }).then(function (resp) {
                html = '<img src="' + resp + '" />' +
                    '<input type="hidden" name="cropped_image" value="' + resp + '">';
                $("#upload-demo-i").html(html);
            });
        }

        $(document).on("click", "#removeFile", function () {
           removeImage();
        });

        function removeImage() {
            $("#upload-demo-i").html("");
            $imagePreviewContainer.addClass('hidden');
        }

    });
  </script>
@endpush
