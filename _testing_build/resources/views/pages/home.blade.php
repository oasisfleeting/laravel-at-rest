<section class="slider">
    <div class="container-fluid border-shadow">
        <div class="row">
            <div class="col-md-4">
                <div class="overview">
                    <div class="welcome-message">
                        <h2 class="title animated fadeInUp delayp1">Laravel-At-Rest<br />Summary</h2>

                        <div class="cont animated lightSpeedIn delayp1">This coding challenge has two parts. First, you will be creating a job that parses and consumes an XML feed of real estate data. Secondly, you will create a small RESTful API to query and update the data. This is not a pass or fail challenge. We simply want to see what you are capable of. Your submission is evaluated on the following:</div>
                        <h2 class="title animated fadeInUp delayp2">Criteria</h2>
                        <ul class="cont animated lightSpeedIn delayp2">
                            <li>Coding standards</li>
                            <li>Object Oriented Design Principals</li>
                            <li>Efficiency / Scalability</li>
                            <li>Practicality</li>
                        </ul>
                        <h2 class="title animated fadeInUp delayp3">Instructions</h2>
                        <ul class="cont animated lightSpeedIn delayp3">
                            <li>You will need to use the Laravel MVC framework to complete this challenge</li>
                            <li>Create a job in the task scheduler that consumes the attached XML data of real estate listings
                                <ul>
                                    <li>Create a MySQL database schema based on the XML structure</li>
                                    <li>Parse the XML and insert data into the MySQL database</li>
                                </ul>
                            </li>
                            <li>Create 3 RESTful API endpoints
                                <ul>
                                    <li>First endpoint should deliver a full listing of all the data</li>
                                    <li>Second endpoint should deliver paged data with filter options
                                        <ul>
                                            <li>ascending / descending by ListPrice</li>
                                            <li>return photos only</li>
                                            <li>ascending / descending by ListingDate</li>
                                        </ul>
                                    </li>
                                    <li>Third endpoint should toggle / update a listings Active flag</li>
                                </ul>
                            </li>
                        </ul>
                        <h2 class="title animated fadeInUp delayp4">Requirements</h2>
                        <ul class="cont animated lightSpeedIn delayp4">
                            <li>Laravel MVC Framework</li>
                            <li>Endpoints should return JSON</li>
                            <li>Include a DDL for the Database or use Laravels Migrations</li>
                            <li>The job should be configured to run once a day at 2:00am EST</li>
                            <li>Submit project via Github</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="consolewrapper" class="col-md-8">
                <section>
                    <div id="terminal"></div>
                </section>
            </div>
        </div>
    </div>
</section>
<section class="restbuttons">
    <div class="container">
        <div class="row">
            <div style="height:2px;" class="clearfix"></div>
            <div class="col-md-3 well center-block">
                <span id="fetch_listings" data-cmd="fetch:listings" class="fetchbtn btn btn-danger btn-lg btn-block">Parse XML and Fetch All <i class="fa fa-retweet">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="fetch_filtered" data-cmd="fetch:filtered" class="fetchbtn btn btn-danger btn-lg btn-block">Fetch All <i class="fa fa-share-alt fa-rotate-270">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="fetch_photos" data-cmd="fetch:photos" class="fetchbtn btn btn-danger btn-lg btn-block">Fetch Paged <i class="fa fa-share-square-o fa-rotate-90">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="toggle" data-cmd="toggle" class="fetchbtn btn btn-danger btn-lg btn-block"> Toggle <i class="fa fa-toggle-off">&nbsp;</i></span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</section>
<div class="container features  clearfix" style="display:none;">
    <div class="row">
        <div class="col-md-4">
            <div class="box-media">
            </div>
            <div class="box-desc">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-box media-box">
            <div class="box-media">
            </div>
            <div class="box-desc">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-box media-box">
            <div class="box-media">
            </div>
            <div class="box-desc">
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>
<section class="text-promo" style="padding: 100px 0px; background-position: 50% 5.40498px;" class="section parallax bottommargin-lg">
    <div class="container text-center">
        <div class="heading-block center nobottomborder nobottommargin">
            <h2> <?php  echo \Illuminate\Foundation\Inspiring::quote(); ?> </h2>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{ asset('spnet/js/console.js') }}"></script>
<script>
    $(document).ready(function () {
        /* Start Ptty terminal */
        $('#terminal').Ptty();

        var enterCommand = function(cmd){
            $('#terminal').find('form').find('input[type=text]').val(cmd).parent('form').submit();
        }


        $.register_command(
                'type',
                'type',
                '',
                {
                    ps             : 'php artisan',
                    start_hook     : function () {
                        return {
                            type    : 'print',
                            callback: 'typewriter',
                            out     : '',
                            write   : 'babyshoes'
                        };
                    },
                    exit_hook      : function () {
                        return {
                            type: 'print',
                            out : 'Good Bye '
                        };
                    },
                    dispatch_method: function (args) {
                        return {
                            type    : 'print',
                            callback: 'typewriter',
                            out     : '',
                            write   : args.join(' ')
                        };
                    }
                }
        );

        var parseControlLogic = function(){

        };

        $('.fetchbtn').click(function () {
            var cmd = $(this).data('cmd');
            parseControlLogic();
            console.log( window.location.pathname+cmd);
            $('#terminal').find('form').find('input[type=text]').val(cmd).parent('form').submit();
            console.log(cmd)
        });

        //order sort page photosbool
        var rest_api = [
            {
                cmd_name       : 'fetch:listings',
                cmd_description: 'consume xml and store in the database',
                cmd_usage      : 'fetch:listingszz',
                cmd_url        : '/artisan/fetchlistings',
            },
            {
                cmd_name       : 'fetch:filtered',
                cmd_description: 'fetch paged data with filter options',
                cmd_usage      : 'fetch:filtered [listing id (1-5)] [sort by price 1=true 0=false] [order by (1=ascending 0=descending)] [photos only? p=photos l=listings & photos] ',
                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/paged1|paged0/photos1|photos0',
                //cmd_method     : 'GET'
            },
            {
                cmd_name       : 'fetch:photos',
                cmd_description: 'Fetch photos data with filter options.',
                cmd_usage      : 'fetch:page:[listing id (1-5)]',
                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/pageid1|pageid0/photos1|photos0',
                //cmd_method     : 'GET'
            },
            {
                cmd_name       : 'toggle',
                cmd_description: 'Toggle a listings Public flag',
                cmd_usage      : 'toggle [listing id (1-5)]',
                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/pageid1|pageid0/photos1|photos0',
                //cmd_method     : 'GET'
            }];

        for (var i = rest_api.length - 1; i >= 0; i--) {
            $.register_command(
                    rest_api[i].cmd_name,
                    rest_api[i].cmd_description,
                    rest_api[i].cmd_usage,
                    rest_api[i].cmd_url
            )

        }

        /* Wrapper function to add listeners for button actions */
        //function button_listeners() {


        //}


        $.register_command(
                'welcomeletter',
                'Consume xml and store in the database',
                '',
                {
                    ps             : 'php artisan',
                    start_hook     : function () {
                        return {
                            type    : 'print',
                            callback: 'typewriter',
                            out     : '',
                            write   : 'This application is built using Laravel Framework. ' +
                            'The goal of this application is to show my understanding of the framework as well as other ' +
                            'technologies commonly used in modern web development. As stated on the left of this page ' +
                            'I will begin by parsing xml and storing it in the database. '
                        };
                    },
                    exit_hook      : function () {
                        return {
                            type: 'print',
                            out : 'Good Bye '
                        };
                    },
                    dispatch_method: function (args) {
                        return {
                            type    : 'print',
                            callback: 'typewriter',
                            out     : '',
                            write   : args.join(' ')
                        };
                    }
                }
        );

        // Typewriter effect callback
        $.register_callback('typewriter', function (data) {
            var text_input = $('.cmd_terminal_prompt');
            text_input.hide();
            if (typeof data.write === 'string') {
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
                    if (char === '<') isTag = true;
                    if (char === '>') isTag = false;
                    if (isTag) return typewriter();
                    setTimeout(typewriter, 40);
                }());
            }
            $('#terminal').find('input[type=text]').focus();
        });



        function load_callbefores() {
            $.register_callbefore(
                    'register',
                    function (cmd) {
                        var err = false,
                                cmd_opts = ['-u', '-e', '-p'],
                                args = $.tokenize(cmd, cmd_opts);

                        // replace password
                        if (typeof args['-p'] !== 'undefined') {
                            var stars = '*'.repeat(args['-p'].length),
                                    safe = cmd.replace(RegExp('\\s' + args['-p'], "g"), ' ' + stars);
                            $.set_command_option({cmd_in: safe});
                        }

                        err = validate_registration(cmd_opts, args);
                        if (err) {
                            // ouput errors
                            $.set_command_option({cmd_out: err});
                            cmd = false;
                        }

                        return cmd;
                    }
            );
        }





        $.register_callback('scrolltoprompt', function (data) {
            $('#terminal').scrollTo('div.cmd_terminal_prompt', 1000, 'linear');
        });

        //enterCommand('welcomeletter');

    });
</script>
<script type="text/javascript">(function () {
        document.write('<a style="display:block;overflow:hidden;z-index:9999;position:absolute;top:0.5px;left:0;" href="http://siliconprairiebuilt.com/" target="_blank"><img src="http://siliconprairiebuilt.com/build.php?i=corner-black-lg.png&s=' + window.location.host + '" /></a>');
    })();</script>