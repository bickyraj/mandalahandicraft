@extends('frontend.layouts.app')

@section('content')
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>About Us</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="text-center">ABOUT US</h2>
                        {!! $company->about !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

