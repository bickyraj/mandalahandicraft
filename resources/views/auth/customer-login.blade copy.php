@extends('frontend.layouts.app')
@push('css')
<style type="text/css">

      .login-form form {
            border-radius: 5px;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 40px 50px;
        }
        .login-form .btn {
            font-size: 18px;
            line-height: 26px;
            font-weight: bold;
            text-align: center;
        }
        .social-btn .btn {
            color: #fff;
            margin: 10px 0;
            font-size: 15px;
            border-radius: 50px;
            text-indent: 10px;
            font-weight: normal;
            border: none;
            text-align: center;
        }
        .social-btn .btn:hover {
            opacity: 0.9;
        }
        .social-btn .btn-primary {
            background: #507cc0;
        }
        .social-btn .btn-info {
            background: #64ccf1;
        }
        .social-btn .btn-danger {
            background: #df4930;
        }
        .social-btn .btn i {
            margin-right: 9px;
            font-size: 20px;
            min-width: 25px;
            position: relative;
            top: 2px;
        }
        .or-seperator {
            margin: 50px 0 15px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .or-seperator b {
            padding: 0 10px;
            width: 40px;
            height: 40px;
            font-size: 16px;
            text-align: center;
            line-height: 40px;
            background: #fff;
            display: inline-block;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            top: -22px;
            z-index: 1;
        }
        .login-form a {
            color: #5cb85c;
        }

</style>
@endpush
@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>Login</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-sm-6 col-md-4">
                        <div id="loginForm">
                            <h2 class="text-center">SIGN IN</h2>
                            <div class="form-wrapper">
                                <p>If you have an account with us, please log in.</p>
                                <form action="{{route('login')}}" method="post" data-toggle="validator">
                                    @csrf
                                    <input type="hidden" name="user" value="normal">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email" required data-error="Enter your email address" value="{{old('email')}}">
                                         <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required data-error="Enter your password">
                                         <span class="help-block with-errors"></span>
                                    </div>
                                    <p class="text-uppercase"><a href="{{ route('password.request') }}" >Forgot Your Password?</a></p>
                                    <!-- <div class="clearfix"><input id="checkbox1" name="checkbox1" type="checkbox" checked="checked"> <label for="checkbox1">Remember me</label></div> -->
                                    <button type="submit" class="btn">Sign in</button>
                                </form>
                            </div>
                        </div>
                        <div id="recoverPasswordForm" class="d-none">
                            <h2 class="text-center">RESET YOUR PASSWORD</h2>
                            <div class="form-wrapper">
                                <p>We will send you an email to reset your password.</p>
                                <form action="#">
                                    <div class="form-group"><input type="text" class="form-control" placeholder="Your Name"></div>
                                    <div class="form-group"><input type="password" class="form-control" placeholder="Password"></div>
                                    <div class="btn-toolbar"><a href="#" class="btn btn--alt js-toggle-forms">Cancel</a> <button class="btn ml-1">Submit</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-divider"></div>
                    <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                        <h2 class="text-center">REGISTER</h2>
                        <div class="form-wrapper">
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p><a href="{{route('register')}}" class="btn">create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
