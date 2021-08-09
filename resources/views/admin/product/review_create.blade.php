@extends('admin.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/jcrop/jquery.Jcrop.min.css') }}">
@endpush

@section('title', 'Add New Faq')

@section('content')

  <form action="{{$edit?route('admin.product.review.update', $model):route('admin.product.review.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="attribute_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{$edit?'Edit':'Add a New'}} Product Review</h4>
      </div>

      <div class="card-content">

        <div class="asdh-add_multiple_container">
            <input type="hidden" name="product_id" value="{{ request()->id }}">

            {{--image--}}
            @if($edit)
                <div class="col-md-10">
                    @if($model->image())
                        <div>
                            <img src="{{ $model->image() }}" style="width: 600px; max-width:100%; display:none;" alt="" id="original_image">
                            <img style="width: 600px;" id="preview" src="{{ $model->modified_image() }}">
                        </div>
                    @else
                        <img id="preview" alt="">
                    @endif
                    <br>
                    <span class="btn btn-sm btn-rose btn-primary btn-file">
                    <span>Browse</span>
                    <input type="file" name="image" id="input-image-file"
                           onchange="fileSelectHandler()" {{ ($model->image && file_exists($model->modified_image()) && file_exists($model->image())) ? '' : ''}} />
                    </span>
                    @if($model->image && file_exists($model->modified_image()) && file_exists($model->image()))
                        <a href="javascript:void(0)" class="btn btn-danger imagecrop"
                           title="crop image"
                           onclick="CropPreviousImage()">Crop Image</a>
                        <a href="javascript:void(0)" class="btn btn-danger" id="cancelimage"
                           title="cancel"
                           onclick="CancelImage()" style="display:none;">Cancel</a>
                    @endif
                    <div class="image-error" style="color:red"></div>
                    <input type="hidden" value="" name="croppreviousimage" id="croppreviousimage">
                    <input type="hidden" id="x1" name="x1"/>
                    <input type="hidden" id="y1" name="y1"/>
                    <input type="hidden" id="x2" name="x2"/>
                    <input type="hidden" id="y2" name="y2"/>
                    <input type="hidden" id="w" name="w"/>
                    <input type="hidden" id="h" name="h"/>
                    {{-- <small class="help-block text-danger">{{$errors->first('image')}}</small> --}}
                </div>

              {{-- @include('extras.input_image', ['input_image'=>$model->modified_image()]) --}}
            @else

            <div class="form-group text-center">
            {{--    <p class="text-primary">Preferred Dimension: <b>1920 * 850</b> at least</p>--}}
              {{--<label for="image">Image</label>--}}
              {{-- cropper --}}
              <label class="fileinput-new thumbnail" for="demo-hor-inputemail">Image</label>
              <div class="fileinput fileinput-new text-center">
                  <div class="col-md-10">
                      <small class="help-block text-danger">{{ $errors->first('image')}}</small>
                      <img id="preview" class="mar-btm"><br>

                      <span class="btn btn-sm btn-rose btn-primary btn-file">
                          <span>Browse</span>
                          <input type="file" name="image" id="input-image-file" onchange="fileSelectHandler()"
                             />
                      </span>
                      <div class="image-error" style="color:red"></div>
                      <input type="hidden" id="x1" name="x1"/>
                      <input type="hidden" id="y1" name="y1"/>
                      <input type="hidden" id="x2" name="x2"/>
                      <input type="hidden" id="y2" name="y2"/>
                      <input type="hidden" id="w" name="w"/>
                      <input type="hidden" id="h" name="h"/>
                  </div>
              </div>
            </div>
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

          {{--name--}}
          <div class="form-group">
            <label class="" for="name">Name</label>
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
            <label class="" for="title">Title</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="{{$edit?$model->title:''}}"
                   required="true"/>
            @if(!$edit)
            @endif
          </div>

          <div class="form-group">
            <label class="" for="country">Country</label>
            <input type="text"
                   class="form-control"
                   id="country"
                   name="country"
                   value="{{$edit?$model->country:''}}"
                   required="true"/>
            @if(!$edit)
            @endif
          </div>
          <div class="form-group">
            <label class="" for="rating">Rating</label>
            <input type="number"
                   class="form-control"
                   min="1"
                   id="rating"
                   max="5"
                   name="rating"
                   value="{{$edit?$model->rating:''}}"
                   required="true"/>
            @if(!$edit)
            @endif
          </div>

          <div class="form-group">
            <label class="" for="review">Review</label>
            <textarea name="review" class="form-control" id="" cols="30" rows="10" required>{{$edit?$model->review:''}}</textarea>
          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('get_reviews', request()->id)}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
<script src="{{ asset('plugins/jcrop/jquery.Jcrop.min.js') }}"></script>
<script>
    var aspRatio = 1/1;
    // convert bytes into friendly format
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB'];
        if (bytes === 0) return 'n/a';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
    }

    // check for selected crop region
    function checkForm() {
        if (parseInt($('#w').val())) return true;
        $('.image-error').html('Please select a crop region and then press Upload').show();
        return false;
    }

    function CancelImage() {
        $('#input-image-file').val('');
        $('.imagecrop').show();
        $('#original_image').show();
        $('#cancelimage').hide();
        $('.jcrop-holder').hide();
        $('#croppreviousimage').val('false');
        $('.image-error').hide();

    }

    function CropPreviousImage() {
        var oImage = document.getElementById('preview');
        // oImage.src = e.target.result;
        $('#croppreviousimage').val('true');
        $('#original_image').hide();
        $('.imagecrop').hide();
        $('#cancelimage').show();
        $('.jcrop-holder').show();
        var previoussource = "{{ asset('uploads/sliders/full/'. ($model->image ?? '')) }}";
        $('#preview').prop('src', previoussource);
        $('#preview').Jcrop({
            setSelect: [0, 0, 200, 100],
            boxWidth: 200,
            // boxHeight: 600,
            minSize: [200, 100], // min crop size
            aspectRatio: aspRatio,
            bgFade: true, // use fade effect
            bgOpacity: .3, // fade opacity
            onChange: updateInfo,
            onSelect: updateInfo,
            onRelease: clearInfo,
            trueSize: [oImage.naturalWidth, oImage.naturalHeight],
        }, function () {
            // use the Jcrop API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the Jcrop API in the jcrop_api variable
            jcrop_api = this;
        });
    }

    // update info by cropping (onChange and onSelect banners handler)
    function updateInfo(e) {
        $('#x1').val(e.x);
        $('#y1').val(e.y);
        $('#x2').val(e.x2);
        $('#y2').val(e.y2);
        $('#w').val(e.w);
        $('#h').val(e.h);
    }

    // clear info by cropping (onRelease event handler)
    function clearInfo(e) {
        $('#x1').val(e.x);
        $('#y1').val(e.y);
        $('#x2').val(e.x2);
        $('#y2').val(e.y2);
        $('#w').val(200);
        $('#h').val(100);
    }
    // Create variables (in this scope) to hold the Jcrop API and image size
    var jCropApi, boundX, boundY;

    function fileSelectHandler() {
        // get selected file
        var oFile = $('#input-image-file')[0].files[0];

        if (!$('#input-image-file')[0].files[0]) {
            $('.jcrop-holder').remove();
            return;
        }
        // hide all errors
        $('.image-error').hide();
        // check for image type (jpg and png are allowed)
        var rFilter = /^(image\/jpeg|image\/png|image\/jpg|image\/gif|image\/xcf|image\/svg)$/i;
        if (!rFilter.test(oFile.type)) {
            $('#submit').prop("disabled", "disabled");
            $('.image-error').html('Please select a valid image file (jpg and png are allowed)').show();
            return;
        } else {
            $('#submit').prop("disabled", false);
        }
        // preview element
        var oImage = document.getElementById('preview');
        // prepare HTML5 FileReader
        var oReader = new FileReader();
        oReader.onload = function (e) {
            // e.target.result contains the DataURL which we can use as a source of the image
            oImage.src = e.target.result;
            oImage.onload = function () { // onload event handler
                var height = oImage.naturalHeight;

                var width = oImage.naturalWidth;

                // console.log(height);
                // console.log(width);
                window.URL.revokeObjectURL(oImage.src);

                if (height < 100 || width < 200) {

                    oImage.src = "";
                    $('#input-image-file').val('');
                    // $('#submit').prop("disabled","disabled");

                    $('.image-error').html('You have selected too small file, please select a one image with minimum size 200 X 200 px').show();

                } else {

                    $('#submit').prop("disabled", false);

                }
                var sResultFileSize = bytesToSize(oFile.size);

                // destroy Jcrop if it is existed
                if (typeof jCropApi !== 'undefined') {
                    jCropApi.destroy();
                    jCropApi = null;
                    $('#preview').width(oImage.naturalWidth);
                    $('#preview').height(oImage.naturalHeight);
                }
                setTimeout(function () {
                    // initialize Jcrop
                    $('#preview').Jcrop({
                        setSelect: [0, 0, 200, 100],
                        boxWidth: 500,
                        // boxHeight: 200,
                        minSize: [200, 100], // min crop size
                        aspectRatio: aspRatio,
                        bgFade: true, // use fade effect
                        bgOpacity: .3, // fade opacity
                        onChange: updateInfo,
                        onSelect: updateInfo,
                        onRelease: clearInfo,
                        trueSize: [oImage.naturalWidth, oImage.naturalHeight]
                    }, function () {
                        // use the Jcrop API to get the real image size
                        var bounds = this.getBounds();
                        boundx = bounds[0];
                        boundy = bounds[1];
                        // Store the Jcrop API in the jCropApi variable
                        jCropApi = this;
                    });
                }, 500);
            };
        };
        // read selected file as DataURL
        oReader.readAsDataURL(oFile);
    }
</script>

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
