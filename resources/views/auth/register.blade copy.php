@extends('frontend.layouts.app')
@push('css')
<style type="text/css">
    .disable-button
    {
        color: #fff;
        background-color: #000;
        outline: 0;
        transition: all 0.2s ease;
    }
</style>
@endpush
@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>Create account</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-md-6">
                        <h2 class="text-center">CREATE AN ACCOUNT</h2>
                        <div class="form-wrapper">
                            <p>To access your whishlist, address book and contact preferences and to take advantage of our speedy checkout, create an account with us now.</p>
                            <form action="{{route('register')}}" method="post" id="register_form" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="first_name" class="form-control" placeholder="First name" required data-required-error="The first name field is required" value="{{old('first_name')}}">
                                            <span class="help-block with-errors"></span>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{old('last_name')}}" required data-required-error="The last name filed is required">
                                             <span class="help-block with-errors" ></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="E-mail" required data-required-error="The email field is required" data-error="Bruh, that email address is invalid" >
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password"  name="password" class="form-control" placeholder="Password" data-minlength="5" required data-required-error="The password filed is required" >
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" data-match="#password" required data-match-error="The confirmed password doesn't match with password">
                                    <span class="help-block with-errors"></span>
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Telephone Number" required data-error="Phone number is required" pattern="^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$" maxlength="10" data-pattern-error="The phone number is invalid!">
                                    <span class="help-block with-errors"></span>
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Permanent Address" required data-error="The address field is required!">
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="clearfix">
                                    <input id="checkbox1" name="checkbox" type="checkbox" checked="checked" > <label for="checkbox1">By registering your details you agree to our Terms and Conditions and privacy and cookie policy</label></div>
                                <div class="text-center">
                                    <button class="btn" type="submit" id="signup" >create an account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(function(){





        $('#checkbox1').on('click',function(){
             if($(this).is(':checked'))
            {
                console.log('checked');
                $('#signup').prop('disabled',false);
                $('#signup').removeClass('disable-button');

            }else
            {
                console.log('not checked');
                $('#signup').prop('disabled',true);
                $('#signup').addClass('disable-button');

            }



        });






    });

</script>

@endpush
