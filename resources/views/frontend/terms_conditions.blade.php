@extends('frontend.layouts.app')
@section('content')
<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><span>Terms of use</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <!-- Page Title -->
            <div class="page-title text-center">
                <div class="title">
                    <h1>Our Terms & Conditions</h1>
                </div>
            </div>
            <!-- /Page Title -->

            {!! $company->terms_condition !!}
           
        </div>
    </div>
</div>
@endsection