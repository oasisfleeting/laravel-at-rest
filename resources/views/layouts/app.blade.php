<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ CNF_APPNAME }} </title>
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="{{ asset('spnet/js/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/fonts/awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/bootstrap.summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/datepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/select2/select2.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/iCheck/skins/square/green.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/markitup/skins/simple/style.css') }}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/markitup/sets/default/style.css') }}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/markitup/sets/default/style.css') }}" rel="stylesheet">

    <link href="{{ asset('spnet/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/css/icons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/js/plugins/toastr/toastr.css')}}" rel="stylesheet">
    @if(!Session::get('themes') or Session::get('themes') =='')
        <link href="{{ asset('spnet/css/spnet.css')}}" rel="stylesheet">
    @else
        <link href="{{ asset('spnet/css/'.Session::get('themes').'.css')}}" rel="stylesheet">
    @endif

    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/fancybox/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/prettify.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/switch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/spnet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/jquery.jCombo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/toastr/toastr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/bootstrap.summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/simpleclone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/markitup/jquery.markitup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/markitup/sets/default/set.js') }}"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="sxim-init">
<div id="wrapper">
    @include('layouts/sidemenu')
    <div class="gray-bg " id="page-wrapper">
        @include('layouts/headmenu')

        @yield('content')
    </div>

    <div class="footer fixed">
        <div class="pull-right">

        </div>
        <div>
            <strong>Copyright</strong> &copy; 2014-{{ date('Y')}} . {{ CNF_COMNAME }}
        </div>
    </div>

</div>

<div class="modal fade" id="spnet-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">

                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="spnet-modal-content">

            </div>

        </div>
    </div>
</div>

<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title">Select Color Schema</div>
            <div class="setings-item">
                <ul>
                    <li><a href="{{ url('home/skin/spnet') }}"> Default Skin
                            <span class="pull-right default-skin"> </span></a></li>
                    <li><a href="{{ url('home/skin/spnet-dark-blue') }}"> Dark Blue Skin
                            <span class="pull-right dark-blue-skin"> </span> </a></li>
                    <li><a href="{{ url('home/skin/spnet-light-blue') }}"> Light Blue Skin
                            <span class="pull-right light-blue-skin"> </span> </a></li>

                </ul>

            </div>

        </div>
    </div>
</div>
<script language="javascript">
    jQuery(document).ready(function ($) {
        $('.markItUp').markItUp(mySettings);
    });
</script>

{{ Sitehelpers::showNotification() }}
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#sidemenu').sximMenu();
        $('.spin-icon').click(function () {
            $(".theme-config-box").toggleClass("show");
        });

        setInterval(function () {
            var noteurl = $('.notif-value').attr('code');
            $.get(noteurl + '/notification/load', function (data) {
                $('.notif-alert').html(data.total);
                var html = '';
                $.each(data.note, function (key, val) {
                    html += '<li><a href="' + val.url + '"> <div> <i class="' + val.icon + ' fa-fw"></i> ' + val.title + '  <span class="pull-right text-muted small">' + val.date + '</span></div></li>';
                    html += '<li class="divider"></li>';
                });
                html += '<li><div class="text-center link-block"><a href="' + noteurl + '/notification"><strong>View All Notification</strong> <i class="fa fa-angle-right"></i></a></div></li>';
                $('.notif-value').html(html);
            });
        }, 60000);

    });

</script>
</body>
</html>
