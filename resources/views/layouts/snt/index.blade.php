<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> {{ $pageTitle}} | {{ CNF_APPNAME }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="{{ asset('spnet/themes/snt/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/font-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/prairie/js/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/console.css')}}" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('spnet/themes/snt/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('spnet/themes/snt/js/jquery.mixitup.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/themes/snt/js/fancybox/source/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header role="banner" id="top" class="navbar navbar-static-top bs-docs-nav">
    <div class="container">
        <div class="navbar-header">
            <button aria-expanded="false" aria-controls="bs-navbar" data-target="#bs-navbar" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url()}}">
                <img src="{{ asset('spnet/themes/snt/images/logo.png')}}">
            </a>
        </div>
        <nav class="collapse navbar-collapse" id="bs-navbar">
            @include('layouts/snt/topbar')
            <ul class="nav navbar-nav navbar-right">
                @if(CNF_MULTILANG ==1)
                    <li class="user dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i><i class="caret"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right icons-right">
                            @foreach(SiteHelpers::langOption() as $lang)
                                <li>
                                    <a href="{{ URL::to('home/lang/'.$lang['folder'])}}"><i class="icon-flag"></i> {{  $lang['name'] }}
                                    </a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
@include($pages)
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p> {{ CNF_APPNAME }}</p>
            </div>
            <div class="col-md-7 text-right">
                <div class="fright clearfix">
                    <a class="social-icon si-small si-borderless si-facebook" href="https://www.facebook.com/Silicon-PrairieNet-705617042853104/" target="_blank">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a class="social-icon si-small si-borderless si-twitter" href="https://twitter.com/prairiedev" target="_blank">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a class="social-icon si-small si-borderless si-gplus" href="https://plus.google.com/108049501613502409636/about" target="_blank">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-google fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a class="social-icon si-small si-borderless si-github" href="https://github.com/oasisfleeting" target="_blank">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a class="social-icon si-small si-borderless si-linkedin" href="https://www.linkedin.com/in/lylemcclanahan" target="_blank">
                        <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('spnet/js/console.js') }}"></script>
<script>
    $(document).ready(function () {
        /* Start Ptty terminal */
        $('#terminal').Ptty({
            method:'GET'
        });


        var rest_api = [
            {
                cmd_name       : 'parselistings',
                cmd_description: 'consume xml and store in the database',
                cmd_usage      : 'just type "parselistings" ',
                cmd_url        : '/artisan/parselistings',
                cmd_method     : 'GET'
            },
            {
                cmd_name       : 'fetch:all',
                cmd_description: 'Gets a kitty pic from API. Try a number from 01 to 10.',
                cmd_usage      : 'fetchall listings',
                cmd_url        : '/listings/all',
                cmd_method     : 'GET'
            },
            {
                cmd_name       : 'fetch:paged',
                cmd_description: 'Fetched paged data with filter options.',
                cmd_usage      : 'fetchpaged',
                cmd_url        : '/listing/paged',
                cmd_method     : 'GET'
            },
            {
                cmd_name       : 'toggle',
                cmd_description: 'Toggle a listings Public flag',
                cmd_usage      : 'toggle [1-5]',
                cmd_url        : '/listing/toggle',
                cmd_method     : 'GET'
            }];

        for (var i = rest_api.length - 1; i >= 0; i--) {
            $.register_command(
                    rest_api[i].cmd_name,
                    rest_api[i].cmd_description,
                    rest_api[i].cmd_usage,
                    rest_api[i].cmd_url
            );

//            $.set_command_option(
//                    rest_api[i].cmd_method
//            );
        }

        $.register_command(
                'type', // Unicode PS1
                'Subcommand example.',
                'type [no options]',
                {
                    ps : 'type',
                    start_hook      : function(){
                        return {
                            type : 'print',
                            callback : 'typewriter',
                            out : 'parselistings',
                            write : 'parselistings'
                        };
                    },
                    exit_hook       : function(){
                        return {
                            type : 'print',
                            out : 'parselistings'
                        };
                    },
                    dispatch_method : function(args){
                        return {
                            type : 'print',
                            callback : 'typewriter',
                            out : 'parselistings',
                            write : args.join(' ')
                        };
                    }
                }
        );

        // Typewriter effect callback
        $.register_callback('typewriter', function(data){
            var text_input = $('.cmd_terminal_prompt');
            text_input.hide();
            if(typeof data.write === 'string'){
                // decode special entities.
                var str = $('<div/>').html(data.write + ' ').text(),
                        typebox = $('<div></div>').appendTo('.cmd_terminal_content'),
                        i = 0,
                        isTag,
                        text;
                (function typewriter() {
                    text = str.slice(0, ++i);
                    if (text === str) return text_input.show();

                    typebox.html(text);

                    var char = text.slice(-1);
                    if( char === '<' ) isTag = true;
                    if( char === '>' ) isTag = false;

                    if (isTag) return typewriter();
                    setTimeout(typewriter, 40);
                }());
            }
        });


        $.register_callback('scrolltoprompt',function(data){
            $('#terminal').scrollTo('div.cmd_terminal_prompt',5000,'linear');
           //$('#terminal').scrollTo('.cmd_terminal_prompt',2000);
            //$('#terminal').animate({ scrollTop: $('div.contentappendedtwo > div.clearfix:last').position().top },3000).promise().always(function(){
            //    $('#terminal').scrollTo('div.cmd_terminal_prompt',2000);
                        //.animate({ scrollTop: $('div.cmd_terminal_prompt > form').position().top },3000);
           // });
            console.log('test');

        });
    });
</script>
<script type="text/javascript">(function () {
        document.write('<a style="display:block;overflow:hidden;z-index:9999;position:absolute;top:0.5px;left:0;" href="http://siliconprairiebuilt.com/" target="_blank"><img src="http://siliconprairiebuilt.com/build.php?i=corner-black-lg.png&s=' + window.location.host + '" /></a>');
    })();</script>
</body>
</html>