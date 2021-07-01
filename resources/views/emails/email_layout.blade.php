<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Wearhubs Nepal - Email</title>
</head>

<body style="-webkit-font-smoothing:antialiased;
	-webkit-text-size-adjust:none;margin: 0px;
	width: 100%!important;margin-top: 30px;
	height: 100%;background: #F5F6FB; font-family: Helvetica Neue , Helvetica, Helvetica, Arial, sans-serif;">

<!-- HEADER -->
<table class="head-wrap" style="width: 100%;background: #F5F6FB;">
    <tr>
        <td></td>
        <td class="header container" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important;">
            <div class="content" style="max-width:600px;margin:0 auto;display:block;">
                <table bgcolor="#3c8dbc" style="width: 100%;padding: 16px;">
                    <tr>
                        <td>
                            <img src="{{ $company->logo() }}" width="120" />

                        </td>
                        <td align="right">
                            <h4 style="font-weight:600; font-size: 18px; text-transform: uppercase; color:#fff;margin:0;padding:0;font-family:HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; line-height: 1.1; margin-bottom:15px;">{{ config('app.name') }}</h4>
                        </td>
                    </tr>
                </table>
            </div>

        </td>
        <td></td>
    </tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap" style="width: 100%">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important;background: #FFFFFF">
            <div class="content" style="padding:15px;max-width:600px;margin:0 auto;display:block;">
                <table style="width: 100%;">
                    <tr>
                        <td>

                            <div class="content">
                                @yield('content')
                            </div>
                            <!-- social & contact -->
                            <table class="social" width="100%" style="background-color: #ebebeb;margin-top: 20px">
                                <tr>
                                    <td>
                                        <!-- column 1 -->
                                        <table align="left" class="column" style="width: 50%;border-right: 1px solid grey;float:left;float:left;">
                                            <tr style="padding: 15px;">
                                                <td style="padding: 15px;">

                                                    <h5 class="" style="margin:20px 0px;font-weight:900; font-size: 17px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;">Connect With Us:</h5>
                                                    <p style="margin-bottom: 10px;font-weight: normal;font-size:14px;line-height:1.6;">

                                                        <a style="margin-bottom: 10px;
												font-weight: normal;
												font-size:14px;
												line-height:1.6;padding: 3px 7px;
												font-size:12px;
												margin-bottom:10px;
												text-decoration:none;
												color: #FFF;font-weight:bold;
												display:block;
												text-align:center; background-color: #3B5998!important;" href="{{ $company->facebook }}" class="soc-btn fb">Facebook</a>

                                                        <a style="padding: 3px 7px;
												font-size:12px;
												margin-bottom:10px;
												text-decoration:none;
												color: #FFF;font-weight:bold;
												display:block;
												text-align:center;background-color: #1daced!important;" href="{{ $company->twitter }}" class="soc-btn tw">Twitter</a>

                                                    </p>

                                                </td>
                                            </tr>
                                        </table><!-- /column 1 -->

                                        <!-- column 2 -->
                                        <table align="left" class="column" style="width: 50%;float:left;">
                                            <tr style="padding: 15px;">
                                                <td style="padding: 15px;">

                                                    <h5 class="" style="margin:20px 0px;font-weight:900; font-size: 17px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;">Contact Info:</h5>
                                                    <p style="margin-bottom: 10px;font-weight: normal;font-size:14px;line-height:1.6;">Phone: <strong>{{ $company->phone }}</strong><br/>
                                                        Email: <strong><a style="color: #2BA6CB;" href="emailto:{{ $company->email }}">{{ $company->email }}</a></strong></p>
                                                </td>
                                            </tr>
                                        </table><!-- /column 2 -->

                                        <span style="display: block; clear: both;"></span>

                                    </td>
                                </tr>
                            </table><!-- /social & contact -->

                        </td>
                    </tr>
                </table>
            </div><!-- /content -->

        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap" style="width: 100%;	clear:both!important;">
    <tr>
        <td></td>
        <td class="container" style="display:block!important;max-width:600px!important;margin:0 auto!important;clear:both!important;">

            <!-- content -->
            <div class="content" style="padding:15px;max-width:600px;margin:0 auto;display:block;">
                <table style="width: 100%;">
                    <tr>
                        <td align="center">
                            <p style="margin-bottom: 13px;font-weight: normal;font-size:14px;line-height:1.6;border-top: 1px solid rgb(215,215,215); padding-top:15px;font-size:10px;font-weight: bold;">
                                <span style="font-weight:500">Copyright {{ date('Y') }} | {{ url('') }}</span> <br>
                                <a style="color: #2BA6CB;" href="#">Terms</a> |
                                <a style="color: #2BA6CB;" href="#">Privacy</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div><!-- /content -->

        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->

</body>
</html>
