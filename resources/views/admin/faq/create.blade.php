@extends('admin.layouts.app')

@section('title', 'Add a New ' . ucfirst($routeType))

@section('content')

  <form action="{{$edit?route($routeType.'.update',$faq):route($routeType.'.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="faq_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{ $edit?'Edit':'Add a New' }} {{ ucfirst($routeType) }}</h4>
      </div>

      <div class="card-content">

        <div class="row">

          

          <div class="col-md-10 col-md-offset-1">
            {{--question--}}
            <div class="form-group label-floating">
              <label class="control-label" for="qustion">
                Question
                <small>*</small>
              </label>
              <input type="text"
                     class="form-control"
                     id="question"
                     name="question"
                     required="true"
                     value="{{$edit?$faq->question:old('question')}}"/>
            </div>

           

            {{--answer--}}
            <div class="form-group">
              <label for="answer">Answer*</label>
              <textarea class="form-control asdh-tinymce"
                        id="answer"
                        name="answer"
                        rows="10">{{$edit?$faq->answer:old('answer')}}</textarea>
            </div>


            {{--Priority--}}
            <div class="form-group label-floating">
              <label class="control-label" for="priority">
                Priority
                
              </label>
              <input type="number"
                     class="form-control"
                     id="priority"
                     name="priority"
                  
                     value="{{$edit?$faq->priority:old('priority')}}"/>
            </div>
          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
           <a href="{{route('faq.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2">
            <i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>

      </div>

    </div>
  </form>
@endsection

@push('script')
  @include('extras.tinymce')
  <script>
    $(document).ready(function () {
      $('#question').focus();
      $('#faq_validation').validate({
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