@extends('admin.layouts.app')

@section('title', 'Add a new '. ucfirst($routeType))

@push('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css">
    <style>
        .file-thumbnail-footer {
            display: none;
        }

        .krajee-default.file-preview-frame {
            width: 80px;
            height: 80px;
        }

        .krajee-default.file-preview-frame .kv-file-content, .krajee-default.file-preview-frame .kv-file-content img {
            width: 100%;
            height: 100% !important;
        }

        .file-caption-name {
            color: #aaa;
        }

        .panel-icon {
            margin: 5px;
            float: left !important;
        }

        .panel .panel-heading {
            border-bottom: 2px solid #e91e63 !important;
            margin-bottom: 10px;
        }

        .panel {
            margin-bottom: 25px;
        }

        .checkbox-inline {
            margin: 30px auto !important;
        }

        .gender-checkbox {
            margin: 10px auto !important;
        }

        .form-group {
            margin-top: 0px !important;
        }

        .select2-selection {
            height: 100% !important;
        }

        .select2-selection__choice__remove {
            float: right !important;
        }


        .multi-color-product-image .file-input {
            margin: 15px 0px !important;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')


    @if($edit)
        <div class="row">
            @foreach($product->images as $image)

                <div class="col-md-3">
                    <div class="card card-product" data-count="2">
                        <div class="card-image" data-header-animation="true">
                            <a href="#pablo">
                                <img class="img" src="{{$image->image()}}" style="width:100%;height: 200px"
                                     alt="{{$product->name}}">
                            </a>
                        </div>
                        <div class="card-content">
                            <center>
                                <button class="btn btn-xs btn-danger remove-image" data-id="{{$image->id}}">Remove
                                </button>
                            </center>

                        </div>

                    </div>
                </div>
            @endforeach


        </div>

    @endif

    <form action="{{$edit?route($routeType.'.update',$product):route($routeType.'.store')}}"
          method="post"
          enctype="multipart/form-data"
          id="product_validation">
        {{csrf_field()}}
        {{$edit?method_field('PUT'):''}}
        <div class="card">

            <div class="card-header card-header-text" data-background-color="green">
                <h4 class="card-title">{!! $edit?'Edit <b>'.$product->title.'</b>':'Add a New '.ucfirst($routeType) !!}</h4>
            </div>

            <div class="card-content">

                {{--About Product--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title"> <i class="fa fa-list panel-icon"></i>  About Product</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6">
                                        {{--title--}}
                                        <div class="form-group label-floating">
                                            <label class="" for="title">
                                                Title
                                                <small>*</small>
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="title"
                                                   name="title"
                                                   required="true"
                                                   value="{{$edit?$product->title:old('title')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{--quantity--}}
                                        <div class="form-group label-floating">
                                            <label class="" for="quantity">
                                                Quantity
                                                <small>*</small>
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="quantity"
                                                   name="quantity"
                                                   required="true"
                                                   value="{{$edit?$product->quantity:old('quantity')}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        {{--user price--}}
                                        <div class="form-group label-floating">
                                            <label class="" for="price">User Price
                                                <small>*</small>
                                            </label>
                                            <div class="form-line">
                                                <input type="text"
                                                       name="user_price"
                                                       id="user_price"
                                                       class="form-control"
                                                       value="{{$edit?$product->user_price:old('user_price')}}"
                                                       required="true">
                                            </div>
                                        </div>
                                        {{--./user price--}}
                                    </div>

                                    <div class="col-md-6">

                                        {{--whole seller price--}}
                                        <div class="form-group label-floating">
                                            <label class="" for="price">Whole Seller Price

                                            </label>
                                            <div class="form-line">
                                                <input type="text"
                                                       name="whole_seller_price"
                                                       id="price"
                                                       class="form-control"
                                                       value="{{$edit?$product->whole_sheller_price:old('whole_seller_price')}}"
                                                >
                                            </div>
                                        </div>
                                        {{--./whole seller price--}}
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{--discount type--}}
                                        <div class="form-group">
                                            <label for="">Discount Type</label><br>
                                            <div class="radio" style="display: inline-block;">
                                                <label>
                                                    <input type="radio"
                                                           name="discount_type"
                                                           value="1"
                                                           @if($edit) @if($product->discount_type==1) checked="true" @endif
                                                           @else checked="true" @endif> Amount
                                                </label>
                                            </div>
                                            <div class="radio" style="display: inline-block;">
                                                <label>
                                                    <input type="radio"
                                                           name="discount_type"
                                                           value="0"
                                                           @if($edit) @if($product->discount_type==0) checked="true" @endif @endif>
                                                    Percentage
                                                </label>
                                            </div>
                                        </div>
                                        {{--./discount type--}}
                                    </div>
                                    <div class="col-md-6">
                                        {{--discount--}}
                                        <div class="form-group">
                                            <label for="discount">Discount</label>
                                            <div class="form-line">
                                                <input type="number"
                                                       name="discount"
                                                       id="discount"
                                                       class="form-control"
                                                       value="{{$edit?$product->discount:old('discount')|0}}"
                                                       required="true">
                                            </div>
                                        </div>
                                        {{--./discount--}}
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                {{--category_id--}}
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id"
                                            id="category_id"
                                            class="selectpicker"
                                            {{--data-style="btn btn-primary btn-round asdh-color-777"--}}
                                            data-style="select-with-transition"
                                            data-size="5"
                                            required="true"
                                            data-live-search="true"
                                            data-url="{{route('ajax.sub-category.show-hide')}}"
                                            @if($edit) data-product-id="{{$product->id}}" @endif>
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if($edit)
                                                    @if($category->id==$product->category_id) selected
                                                    @endif
                                                    @endif
                                            >
                                                {{$category->name}} {{$category->has_children()?'+':''}}
                                            </option>
                                            @if($category->has_children())
                                                @include('admin.product.sub_categories',['category' => $category])
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                </div>
                                {{--./category_id--}}

                            </div>
                        </div>
                    </div>
                </div>

                {{--Product Description--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title"> <i class="fa fa-comment panel-icon"></i>  Product Description</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{--description--}}
                                <div class="form-group">
                                    <label class="" for="description">Description</label>
                                    <textarea class="form-control asdh-tinymce"
                                              id="description"
                                              name="description"
                                              rows="6">{{$edit?$product->description:old('description')}}</textarea>
                                </div>
                                {{--./description--}}
                            </div>
                        </div>
                    </div>
                </div>

                {{--Product Specification--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title"> <i class="fa fa-comments panel-icon"></i>  Product Specification</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{--specification--}}
                                <div class="form-group">
                                    <label class="" for="specification">Specification</label>
                                    <textarea class="form-control asdh-tinymce"
                                              id="specification"
                                              name="specification"
                                              rows="6">{{$edit?$product->specification:old('specification')}}</textarea>
                                </div>
                                {{--./specification--}}
                            </div>
                        </div>
                    </div>
                </div>


                {{--Product Images--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title">
                            <i class="fa fa-image panel-icon"></i>  Product Images
                        </h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{--discount type--}}
                                <div class="form-group">
                                    <label for="">Product Type</label><br>
                                    <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input id="singleColorProduct" class="product-type" type="radio"
                                                   name="product_type"
                                                   value="0"
                                                   @if($edit) @if($product->product_type==0) checked="true" @endif
                                                   @else checked="true" @endif> Single Color Product
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block;">
                                        <label>
                                            <input id="multiColorProduct" class="product-type" type="radio"
                                                   name="product_type"
                                                   value="1"
                                                   @if($edit) @if($product->product_type==1) checked="true" @endif @endif>
                                            Multi Color Product
                                        </label>
                                    </div>
                                </div>
                                {{--./discount type--}}
                                {{--./image--}}

                                @if(!$edit)
                                <div class="color-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="color">Color</label>
                                                <select class="form-control select-single-color" id="selectColor" name="color_id[]">
                                                    @foreach($colors as $color)
                                                        <option data-color="{{ $color->color_code }}" data-image="{{ $color->modified_image() }}" data-text="{{$color->name}}" value="{{$color->id}}">
                                                            {{$color->name}}
                                                        </option>

                                                    @endforeach
                                                </select>
                                                <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-inline">
                                                @foreach($colors as $color)
                                                    <label style="margin: 0 10px">
                                                        <input type="checkbox" name="popular"
                                                               value="1"> {{ $color->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="single-color-product-image">
                                    <div class="form-group color-images-section">
                                        <label><b>Product Images
                                            </b></label>
                                        <input required type="file" class="form-control color-images" id="images" name="color_images[@if(isset($colors[0]->id)){{$colors[0]->id}}@endif][]" accept="image/*"
                                               multiple>
                                    </div>
                                </div>


                                <div class="multi-color-product-image hidden">

                                </div>
                                @else
                                    <div class="color-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <select class="form-control select-single-color" id="selectColor" name="color_id[]">
                                                        @foreach($colors as $color)
                                                            <option data-color="{{ $color->color_code }}" @if($product->product_type==1) multiple @endif data-image="{{ $color->modified_image() }}" data-text="{{$color->name}}"  value="{{$color->id}}">
                                                                {{$color->name}}
                                                            </option>

                                                        @endforeach
                                                    </select>
                                                    <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif


                            </div>
                        </div>
                    </div>
                </div>


                {{--General Information--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title"> <i class="fa fa-adjust panel-icon"></i>  Size Information</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image">Size Information Image</label>
                                    <input type="text" class="form-control" readonly value="{{$edit?$product->getOriginal('image'):''}}">
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{--General Information--}}
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 class="panel-title"> <i class="fa fa-image panel-icon"></i>  General Information</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_id">Size Group</label>
                                            <select name="group_id"
                                                    id="group_id"
                                                    class="selectpicker"

                                                    data-style="select-with-transition"
                                                    data-size="5"
                                                    data-live-search="true"
                                                    data-url="{{route('ajax.size.show-hide')}}"

                                            >
                                                <option value="">Choose Size Group</option>
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}"
                                                            @if($edit && $product->hasSize())
                                                                @if($product->get_group_id()==$group->id)
                                                                    selected

                                                                @endif
                                                            @endif
                                                    >
                                                        {{$group->name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                            <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">


                                        @if($edit && $product->hasSize())

                                            <div class="form-group" id="bsb-size-edit">
                                                <label for="group_size_id">Sizes</label>
                                                <select name="group_size_id[]"
                                                        id="group_size_id"
                                                        class="selectpicker"

                                                        data-style="select-with-transition"
                                                        data-size="5"
                                                        data-live-search="true"
                                                        multiple="true"

                                                >
                                                    <option value="">Choose Sizes</option>
                                                    @foreach($product->get_size_by_group($product->get_group_id()) as $s)
                                                        <option value="{{$s->id}}"
                                                                @foreach($product->sizes as $size)
                                                                @if($size->id==$s->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                        >
                                                            {{$s->size}}
                                                        </option>

                                                    @endforeach
                                                </select>
                                                <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                            </div>
                                        @endif

                                        {{--sizes--}}
                                        <div class="bsb-size">
                                            <!-- add size by ajax -->


                                        </div>
                                        {{--./sizes--}}
                                    </div>


                                </div>
                                {{-- /group --}}


                                <div class="row">

                                    <div class="col-lg-4 col-md-12 col-sm-12">

                                        {{--brand_id--}}
                                        <div class="form-group">
                                            <label for="brand_id">Brand</label>
                                            <select name="brand_id"
                                                    id="brand_id"
                                                    class="selectpicker"
                                                    {{--data-style="btn btn-primary btn-round asdh-color-777"--}}
                                                    data-style="select-with-transition"
                                                    data-size="5"
                                                    data-live-search="true"
                                            >
                                                <option value="">Choose Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}"
                                                            @if($edit) @if($brand->id==$product->brand_id) selected @endif @endif>
                                                        {{$brand->brand_name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                            <div class="material-icons select-drop-down-arrow">keyboard_arrow_down</div>
                                        </div>
                                        {{--./brand_id--}}
                                        {{--   group   --}}
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="checkbox checkbox-inline">
                                                            <label>
                                                                <input type="checkbox" name="popular"
                                                                       value="1" {{ $edit?($product->popular?'checked':''):'' }}> Popular
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="checkbox checkbox-inline">
                                                            <label>
                                                                <input type="checkbox" name="featured"
                                                                       value="1" {{ $edit?($product->featured?'checked':''):'' }}> Featured
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="checkbox checkbox-inline">
                                                            <label>
                                                                <input type="checkbox" name="sale"
                                                                       value="1" {{ $edit?($product->sale?'checked':''):'' }}> Sale
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="checkbox checkbox-inline">
                                                            <label>
                                                                <input type="checkbox" name="hot"
                                                                       value="1" {{ $edit?($product->hot?'checked':''):'' }}> New
                                                            </label>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-2">
                                                        <div class="checkbox checkbox-inline">
                                                            <label>
                                                                <input type="checkbox" data-id="#gender-container" id="toggle-gender"> Gender
                                                            </label>
                                                            <div id="gender-container" style="display: none;">
                                                                <div class="radio" style="display:inline-block;">
                                                                    <label>
                                                                        <input type="radio"
                                                                               name="gender"
                                                                               value="1"
                                                                                {{ $edit?($product->gender===1?'checked':null):null }}> Male
                                                                    </label>
                                                                </div>
                                                                <div class="radio" style="display: inline-block;">
                                                                    <label>
                                                                        <input type="radio"
                                                                               name="gender"
                                                                               value="0"
                                                                                {{ $edit?($product->gender===0?'checked':null):null }}> Female
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--submit--}}
                <div class="form-footer text-right">
                    <a href="{{route('product.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i>
                        Back</a>
                    <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i
                                class="fa fa-save"></i> {{ $edit?'Update':'Save' }}</button>
                </div>
                {{--./submit--}}

            </div>

        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    @include('extras.tinymce')
    <script>
        $(document).ready(function () {

            @if(!$edit)
                $("#multiColorProduct").prop("checked", false);
                $("#singleColorProduct").prop("checked", true);
            @endif

            function formatData (data) {
                // var color = $('#selectColor option[value="'+data.id+'"]').attr("data-color");
                var image = $('#selectColor option[value="'+data.id+'"]').attr("data-image");
                var baseUrl = "{{ url ('') }}";
                let $result = '';
                if(image !== undefined) {
                    $result= $(
                        '<div><h4><span><img src="'+image+'" style="width: 35px;">&nbsp;&nbsp;' +data.text+'</span></h4></div>');

                } else {
                    $result= $(
                        '<span>' + data.text + '</span>'
                    );
                }

                return $result;
            };

            function initSelect() {

                $("#selectColor").val("");

                $("#selectColor").select2({
                    templateResult: formatData,
                    templateSelection: formatData,
                    placeholder: "Choose Color",
                    allowClear: true

                });
            }

            initSelect();



            $('#product_validation').validate({
                errorPlacement: function(error, element) {
                    if (element.hasClass("color-images"))
                        error.insertAfter(".color-images-section");
                },
                submitHandler: function (form) {

                    var $buttonToDisable = $('.btn-prevent-multiple-submit2');

                    $buttonToDisable.prop('disabled', true);

                    $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());

                    form.submit();


                }

            });

            $('input[type="file"]').on("change", function () {
                $('#product_validation').valid();
            });


            $("#images").fileinput({
                'showUpload': false,
                'previewFileType': 'any',
                dropZoneEnabled: true,
                maxFileCount: 7,
                showCancel: true,
            });


            function initColorImages() {
                $(".color-images").fileinput({
                    'showUpload': false,
                    'previewFileType': 'any',
                    dropZoneEnabled: true,
                    maxFileCount: 7,
                    showCancel: true,
                });
            }

            initColorImages();

            // $("#back_images").fileinput({
            //   'showUpload': false,
            //   'previewFileType': 'any',
            //   dropZoneEnabled: false,
            //   maxFileCount: 5,
            // });

            $('.fileinput-remove.fileinput-remove-button').addClass('btn-xs');
            $('.btn.btn-primary.btn-file').addClass('btn-xs');
            $('.file-caption-name').val('Choose Images');


            var $group = $('#group_id');
            var $sizeC = $('.bsb-size');
            var $sizeEdit = $('#bsb-size-edit');
            var $removeImage = $('.remove-image');

            var $toggleGender = $('#toggle-gender');

            @if($edit)
            $group.change(function () {
                $sizeEdit.remove();
                // if ($(this).val() > 0) {
                //   showIfSizesExist($(this));
                // } else {
                //   $sizeC.children().remove();
                // }
            });

            @endif



            $group.change(function () {
                $sizeC.children().remove();
                if ($(this).val() > 0) {
                    showIfSizesExist($(this));
                } else {
                    $sizeC.children().remove();
                }
            });

            $toggleGender.on('change', function () {
                var $this = $(this);
                var $elementToToggle = $($this.data('id'));
                if ($this.is(':checked')) {
                    $elementToToggle.show();
                } else {
                    $elementToToggle.hide();
                    $('input[name="gender"]').prop('checked', false);
                }
            });

            $('#name').focus();


            $removeImage.on('click', function () {
                $this = $(this);
                var img_id = $this.data('id');
                $.ajax({
                    url: "{{route('product.remove_image')}}",
                    data: {id: img_id},
                    type: 'get',
                    success: function (data) {
                        if (data.status) {

                            $this.parents().eq(3).remove();


                        }
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });


            });

            function showIfSizesExist($this) {
                var $sizeC = $('.bsb-size');
                $.ajax({
                    url: $this.data('url'),
                    data: {group_id: $this.val()},
                    type: 'get',
                    success: function (data) {
                        if (data.status) {
                            // if size from previous request is present then remove them
                            $sizeC.children().remove();
                            // append size to the container
                            $sizeC.append(data.data);
                            // refresh bootstrap-select
                            $('#group_size_id').selectpicker('refresh');
                        } else {
                            // remove any sub-categories if present to prevent conflict while saving on database
                            $sizeC.children().remove();
                        }
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });
            }


            var bsb_color = $(".bsb-color");
            bsb_color.data("prev", bsb_color.val());

            var multipleAddLimit = 0;

            $(document).on("change", ".product-type", function (event) {
                let value = $(this).val();

                if (value == 0) {
                    $(".multi-color-product-image").addClass('hidden');
                    $(".multi-color-product-image").html('');
                    $(".single-color-product-image").removeClass('hidden');
                    $("#selectColor").removeAttr('multiple');

                    $("#selectColor").removeClass('select-multiple-color');
                    $("#selectColor").addClass('select-single-color');

                } else {
                    $(".multi-color-product-image").removeClass('hidden');
                    $(".single-color-product-image").addClass('hidden');
                    $("#selectColor").attr('multiple', 'multiple');
                    $("#selectColor").addClass('select-multiple-color');
                    $("#selectColor").removeClass('select-single-color');
                }

                initSelect();
            });

            $(document).on("change", ".select-single-color", function(){
                let value = $(this).val();
                $("#images").attr("name","color_images["+value+"][]");
            });

            $(document).on("select2:select", ".select-multiple-color", function(event) {
                let selector = $(".select-multiple-color");
                var value = event.params.data.id;
                let option = selector.find('option[value="'+value+'"]');
                let image = option.attr("data-image");
                let colorText = option.attr("data-text");

                let colorImage ='<div id="colorImage'+value+'"><div class="form-group color-images-section">\n' +
                '                                        <i class="fa fa-image panel-icon"></i>  Product Images for\n' +
                   ' <span> ' +colorText+' <img src="'+image+'" style="width: 35px;"></span>'+
                '                                            </b></label>\n' +
                '                                        <input required type="file" class="form-control color-images" name="color_images['+value+'][]" accept="image/*"\n' +
                '                                               multiple>\n' +
                '                                    </div></div>';

                let multiColorContainer = $(".multi-color-product-image");

                multiColorContainer.append(colorImage);

                initColorImages();
            });

            $(document).on("select2:unselect", ".select-multiple-color", function(event) {
                var value = event.params.data.id;
                $('#colorImage'+value).remove();
            });

            // when selecting color
            // $(document).on("change", ".select-multiple-color", function(){
                // let th = $(this);
                // let option = th.find('option:selected');
                //
                // let colorText = option.attr("data-text");
                // let color = option.attr("data-color");
                // alert(color);
                // if(option.is(':selected')) {
                //
                // } else {
                //
                // }
                // alert(color);
                // let colorImage ='<div class="form-group">\n' +
                // '                                        <i class="fa fa-image panel-icon"></i>  Product Images for\n' +
                //     '                            <span class="label" style="padding: 7px 30px; width:50px; height: 25px;  background-color: Blue">Blue Color</span>' +
                // '                                            </b></label>\n' +
                // '                                        <input type="file" class="form-control color-images" id="" name="color_images[]" accept="image/*"\n' +
                // '                                               multiple>\n' +
                // '                                    </div>';
                //
                // let multiColorContainer = $(".multi-color-product-image");
                //
                // multiColorContainer.append(colorImage);
            // });

        });
    </script>
@endpush