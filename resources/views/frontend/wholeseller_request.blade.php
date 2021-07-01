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


    .my-btn {
        padding: 10px 22px;
        font-size: 11px;
        line-height: 16px;
        text-transform: uppercase;
        border-radius: 0;
        border: 0;
        border-radius: 5px;
        font-weight: 500;
        font-family: "Montserrat", sans-serif;
        cursor: pointer;
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
                    <li><span>Become Whole Seller</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-md-6">
                        <h2 class="text-center">CREATE ACCOUNT AS WHOLE SELLER</h2>
                        <div class="form-wrapper">
                            <p>To request an account to become wholeseller,please fill all information below.</p>
                            <form action="{{route('request.wsellerStore')}}" method="post" id="register_form" data-toggle="validator" enctype="multipart/form-data">
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
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Telephone Number" required data-error="Phone number is required" pattern="^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$" maxlength="14" data-pattern-error="The phone number is invalid!">
                                    <span class="help-block with-errors"></span>
                                </div>
                                 <div class="form-group">
                                    <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Permanent Address" required data-error="The address field is required!">
                                    <span class="help-block with-errors"></span>
                                </div>

                                <div class="form-group">

                                <label class="my-btn btn-primary" for="my-file-selector">
                                    <input name="document" id="my-file-selector" required data-error="Please select your document for upload.." type="file" style="display:none" 
                                    onchange="$('#upload-file-info').html(this.files[0].name)">
                                    Upload Document
                                </label>
                                <span class='label label-info' id="upload-file-info"></span>
                                <span class="help-block with-errors"></span>

                                </div>

                                <div class="text-center">
                                    <button class="btn" type="submit" >Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

