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
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('spnet/themes/snt/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/font-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/snt/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('spnet/themes/prairie/js/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('spnet/themes/snt/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('spnet/themes/snt/js/jquery.mixitup.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('spnet/js/plugins/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('spnet/themes/snt/js/fancybox/source/jquery.fancybox.js') }}"></script>




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
                    <li class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i><i class="caret"></i></a>
               <ul class="dropdown-menu dropdown-menu-right icons-right">
                @foreach(SiteHelpers::langOption() as $lang)
                       <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}"><i class="icon-flag"></i> {{  $lang['name'] }}</a></li>
                   @endforeach
              </ul>
            </li>
                @endif
                <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> My Account <span class="caret"></span></a>
            <ul class="dropdown-menu">
            @if(!Auth::check())
                    <li><a href="{{ url('user/login')}}">Sign In</a></li>
                    <li><a href="{{ url('user/register')}}">Sign Up</a></li>
                @else

                    <li><a href="{{ url('dashboard')}}"><i class="fa fa-desktop"></i> Dashboard</a></li>
                    <li><a href="{{ url('user/profile')}}"><i class="fa fa-user"></i> My Account</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ url('user/logout')}}">Logout</a></li>
                @endif
            </ul>
        </li>             
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
    <!-- console -->
    <link href="{{ asset('spnet/themes/snt/css/console.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('spnet/js/console.js') }}"></script>
   <script type="text/javascript">
       $(document).ready(function(){


        $('#input').cssConsole({
            inputName: 'console',
            charLimit: 60,
            onEnter: function () {
                addLine("> " + $('#input').find('input').val());
                execCommand($('#input').find('input').val());
                $('#input').cssConsole('reset');
            }
        });

        var lineLimit = 28;
        var focus;

        focus = window.setInterval(function () {
            if (!$('#input').find('input').is(":focus")) {
                $('#input').find('input').focus();
            }
        }, 100);

        function addLine(input, style, color) {
            if ($('.console div').length == lineLimit) {
                $('.console div').eq(0).remove();
            }
            style = typeof style !== 'undefined' ? style : 'line';
            color = typeof color !== 'undefined' ? color : 'white';
            $('.console').append('<div class="' + style + ' ' + color + '">' + input + '</div>');
        }

        function execCommand(command) {
            if (commands[command]) {
                return commands[command]();
            } else {
                addLine("Command '" + command + "' was not found.");
            }
        }

       });
   </script>

    <!-- console -->
<script type="text/javascript">(function () {
        document.write('<a style="display:block;overflow:hidden;z-index:9999;position:absolute;top:0;left:0;" href="http://siliconprairiebuilt.com/" target="_blank"><img src="http://siliconprairiebuilt.com/build.php?i=corner-orange-lg.png&s=' + window.location.host + '" /></a>');
    })();</script>


  </body>
</html>