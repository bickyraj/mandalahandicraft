@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural('Site Settings')))

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/jcrop/jquery.Jcrop.min.css') }}">
@endpush
@section('content')
<div class="{{-- card card-nav-tabs card-plain --}}">
  <div class="card-header card-header-danger">
      <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
      <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
              <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                      <a class="nav-link active" href="#home" data-toggle="tab">Home Page</a>
                  </li>
                  {{-- <li class="nav-item">
                      <a class="nav-link" href="#updates" data-toggle="tab">Updates</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#history" data-toggle="tab">History</a>
                  </li> --}}
              </ul>
          </div>
      </div>
  </div><div class="card-body ">
      <div class="tab-content text-left">
          <div class="tab-pane active" id="home">
              <h2>Block 1</h2>
              <form class="" method="POST" action="{{ route('admin.site_settings.home.store') }}" id="setting-home-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group">
                      <label class="col-lg-2 col-form-label">Title </label>
                      <div class="col-lg-7">
                        <input type="text" id="input-trip-name" class="form-control" name="block1[title]" value="{{ Setting::get('homePage')['block1']['title']??'' }}">
                        {{-- <span class="form-text text-muted">Please enter your full name</span> --}}
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                      <label class="col-lg-2 col-form-label">Content</label>
                      <div class="col-lg-7">
                        <textarea name="block1[content]" class="form-control" id="" cols="30" rows="10"><?= Setting::get('homePage')['block1']['content']??'' ?></textarea>
                      </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                  {{-- <pre>{{ Setting::get('homePage') }}</pre> --}}
                  <label class="col-lg-2 col-form-label">Image</label>

                  {{--image--}}
                      <div class="col-md-10">
                          @if(Setting::get('homePage')['block1']['image'])
                              <div>
                                  <img src="{{ asset('uploads/site-settings/full') . '/' . Setting::get('homePage')['block1']['image'] }}" style="width: 600px; max-width:100%; display:none;" alt="" id="original_image">
                                  <img style="width: 600px;" id="preview" src="{{ asset('uploads/site-settings/modified') . '/' .Setting::get('homePage')['block1']['image'] }}">
                              </div>
                          @else
                              <img id="preview" alt="">
                          @endif
                          <br>
                          <span class="btn btn-sm btn-rose btn-primary btn-file">
                          <span>Browse</span>
                          <input type="file" name="image" id="input-image-file"
                                 onchange="fileSelectHandler()" />
                          </span>
                          @if(Setting::get('homePage')['block1']['image'])
                              <a href="javascript:void(0)" class="btn btn-sm btn-danger imagecrop"
                                 title="crop image"
                                 onclick="CropPreviousImage()">Crop Image</a>
                              <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="cancelimage"
                                 title="cancel"
                                 onclick="CancelImage()" style="display:none;">Cancel</a>
                          @endif
                          <div class="image-error" style="color:red"></div>
                          <input type="hidden" value="" name="croppreviousimage" id="croppreviousimage">
                          <input type="hidden" id="x1" name="cropped_data[x1]"/>
                          <input type="hidden" id="y1" name="cropped_data[y1]"/>
                          <input type="hidden" id="x2" name="cropped_data[x2]"/>
                          <input type="hidden" id="y2" name="cropped_data[y2]"/>
                          <input type="hidden" id="w" name="cropped_data[w]"/>
                          <input type="hidden" id="h" name="cropped_data[h]"/>
                          {{-- <small class="help-block text-danger">{{$errors->first('image')}}</small> --}}
                      </div>

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
                </div>
                <hr>
                <div class="">
                  <button type="submit" id="home-page-save-btn" class="btn btn-primary">
                        <i class="flaticon2-arrow-up"></i>
                      Save</button>
                  <a href="{{ route('admin.site_settings.general') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
@push('script')
<script src="{{ asset('plugins/jcrop/jquery.Jcrop.min.js') }}"></script>
<script>
    var aspRatio = 4/5;
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
        var previoussource = "{{ asset('uploads/site-settings/full/'. (Setting::get('homePage')['block1']['image'] ?? '')) }}";
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
@endpush
