<div class="form-group text-center">
{{--    <p class="text-primary">Preferred Dimension: <b>1920 * 850</b> at least</p>--}}
  {{--<label for="image">Image</label>--}}
  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
    <label class="fileinput-new thumbnail" for="image">

      <img src="{{ isset($input_image)?$input_image:material_dashboard_url('img/image_placeholder.png')}}" alt="" style="max-width: 300px">
    </label>
    <div class="fileinput-preview fileinput-exists thumbnail"></div>
    <div>
      <span class="btn btn-rose btn-round btn-file asdh-btn-small">
          <span class="fileinput-new">Select image</span>
          <span class="fileinput-exists">Change</span>
          <input type="file"
                 id="image"
                 name="{{ isset($image_name_field)?$image_name_field:'image' }}"
                 accept="image/*"/>
      </span>
      <a id="removeFile" href="#"
         class="btn btn-danger btn-round fileinput-exists asdh-btn-small"
         data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
    </div>
  </div>
</div>
