@extends('admin.layouts.app')

@section('title', 'Add a New User')

@section('content')

  <form action="{{$edit?route($routeType.'.update',$model):route($routeType.'.store')}}" method="post" enctype="multipart/form-data" id="user_validation">
   {{csrf_field()}}
   {{$edit?method_field('PUT'):''}}

    <div class="card">
      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{$edit?'Edit':'Create New'}} User</h4>
      </div>

      <div class="card-content">

        <div class="row">
          <div class="col-md-2">
            {{--image--}}
            @if($edit)
             @include('extras.input_image',['input_image'=>$model->image('','','','users')])
            @else
            @include('extras.input_image')
            @endif

            <hr>
            {{--roles--}}
            <div class="form-group">
              <!-- <label for="roles">Assign roles</label>
              @foreach($roles as $role)
                <div class="checkbox">
                  <label>
                    <input
                    type="checkbox"
                    name="role[]"
                    value="{{$role->id}}"
                    @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif
                    @if($edit)
                    @foreach($model->roles as $r)
                    @if($r->id==$role->id)
                    checked
                    @endif

                    @endforeach

                    @endif
                    > {{$role->name()}}
                  </label>
                </div>
              @endforeach -->

              @if($edit && auth()->user()->hasRole('admin') && auth()->user()->id==$model->id)
              @else
              <label for="roles">User Role</label>
              <div class="checkbox">
                <label>
                  <input
                  type="checkbox"
                  name="role"
                  value="3"
                  @if(old('role')==3) checked @endif

                  checked
                  disabled="true"


                  > Vendor
                </label>
              </div>
              @endif
            </div>
            <hr>
          </div>
          <div class="col-md-10">
            <div class="row">
              {{--name--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="name">
                    Name
                    <small>*</small>
                  </label>
                  <input type="text"
                         class="form-control"
                         id="name"
                         name="name"
                         required="true"
                         value="{{$edit?$model->name:old('name')}}"/>
                </div>
              </div>
              {{--email--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="email">
                    Email
                    <small>*</small>
                  </label>
                  <input type="email"
                         class="form-control"
                         id="email"
                         name="email"
                         required="true"
                         email="true"
                         value="{{$edit?$model->email:old('email')}}"/>
                </div>
              </div>
            </div>


            @if(!$edit)

           <!--  <div class="row">
              {{--password--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="password">
                    Password
                    <small>*</small>
                  </label>
                  <input type="password"
                         class="form-control"
                         id="password"
                         name="password"
                         required="true"
                         value="{{old('password')}}"/>
                </div>
              </div>
              {{--password confirmation--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="password_confirmation">
                    Confirm Password
                    <small>*</small>
                  </label>
                  <input type="password"
                         class="form-control"
                         id="password_confirmation"
                         name="password_confirmation"
                         required="true"
                         value="{{old('password_confirmation')}}"/>
                </div>
              </div>
            </div> -->
            @endif

            <div class="row">
              {{--address--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="address">
                    Address
                  </label>
                  <input type="text"
                         class="form-control"
                         id="address"
                         name="address"
                         value="{{$edit?$model->address:old('address')}}"/>
                </div>
              </div>
              {{--phone--}}
              <div class="col-md-6">
                <div class="form-group label-floating">
                  <label class="control-label" for="phone">
                    Phone
                  </label>
                  <input type="text"
                         class="form-control"
                         id="phone"
                         name="phone"
                         number="true"

                         value="{{$edit?$model->phone:old('phone')}}"/>
                </div>
              </div>
            </div>

            {{--about--}}
            <div class="form-group">
              <label class="control-label" for="about">About</label>
              <textarea class="form-control asdh-tinymce" id="about" name="about" rows="10">{{$edit?$model->about:old('about')}}</textarea>
            </div>

          </div>
        </div>

        {{--submit--}}
        <div class="form-footer text-right">
          <a href="{{route('user.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i>  {{$edit?'Update':'Save'}}</button>
        </div>

      </div>
    </div>
  </form>
@endsection

@push('script')
  @include('extras.tinymce')
  <script>
    $(document).ready(function () {
      $('#name').focus();
      $('#user_validation').validate({
              rules: {
                phone: {
                  required: true,
                  maxlength: 10
                }
              },


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
