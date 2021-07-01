<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width"/>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-id" content="{{ auth()->user()->id }}">
<!-- Bootstrap core CSS -->
<link href="{{material_dashboard_url('css/bootstrap.min.css')}}" rel="stylesheet"/>
<!-- Material Dashboard CSS -->
<link href="{{material_dashboard_url('css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet"/>
<!-- Fonts and icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Favicon-->
<link rel="icon" href="{{$company->logo()}}">
<title>Admin - @yield('title')</title>

<!-- My css -->
<link href="{{asset("css/asdh_admin.css")}}" rel="stylesheet">
<link href="{{asset("backend/css/style.css")}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
@stack('css')