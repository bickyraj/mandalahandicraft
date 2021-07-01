<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="_token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }}</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ url('') }}/frontend/images/favicon.ico">
<!-- Vendor CSS -->
<link href="{{ frontend_url('js/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ frontend_url('js/vendor/slick/slick.min.css') }}" rel="stylesheet">
<link href="{{ frontend_url('js/vendor/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ frontend_url('js/vendor/animate/animate.min.css') }}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{{ frontend_url('css/style-light.css') }}" rel="stylesheet">
<link href="{{ frontend_url('css/style.css') }}" rel="stylesheet">
<!--icon font-->
<link href="{{ frontend_url('fonts/icomoon/icomoon.css') }}" rel="stylesheet">
<!--custom font-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@stack('css')
