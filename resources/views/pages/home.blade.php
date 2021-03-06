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
<section class="sortingsect">
    <div class="container">
        <div class="row">
            <div style="height:2px;" class="clearfix"></div>
            <div class="col-md-3 well center-block">
                <span id="sortprice" data-sort="asc" class="sortbtn btn btn-danger btn-lg btn-block">ListPrice ASC</span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="sortdate" data-sort="asc" class="sortbtn btn btn-danger btn-lg btn-block">ListDate ASC </span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="photosonly" data-photosonly="0" class="photosbtn btn btn-danger btn-lg btn-block">Photos Only Off </span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="pagedbtn" data-paged="0" data-pagenum="0" class="pagedbtn btn btn-danger btn-lg btn-block">Paged Data Off </span>
            </div>
        </div>
    </div>
</section>
<section class="restbuttons">
    <div class="container">
        <div class="row">
            <div style="height:2px;" class="clearfix"></div>
            <div class="col-md-4 well center-block">
                <span id="fetch_listings" data-cmd="fetch:listings" class="fetchbtn btn btn-danger btn-lg btn-block">Parse XML and Fetch All <i class="fa fa-retweet">&nbsp;</i></span>
            </div>
            <!--
            <div class="col-md-3 well center-block">
                <span id="fetch_filtered" data-cmd="fetch:filtered" class="fetchbtn btn btn-danger btn-lg btn-block">Fetch All <i class="fa fa-share-alt fa-rotate-270">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span id="fetch_photos" data-cmd="fetch:photos" class="fetchbtn btn btn-danger btn-lg btn-block">Fetch Paged <i class="fa fa-share-square-o fa-rotate-90">&nbsp;</i></span>
            </div>
            -->
            <div class="col-md-4 well center-block">
                <span id="toggle" data-cmd="toggle" class="togglebtn btn btn-danger btn-lg btn-block">Toggle <i id="toggleicon" class="fa fa-toggle-off">&nbsp;</i></span>
            </div>
            <div class="col-md-4 well center-block">
                <span id="pagenumbtn" data-page="0" class="pagenumbtn btn btn-danger btn-lg btn-block">Page #0 >> </span>
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

        function reRegisterCallBefores() {
            $.register_callbefore('typewriterbefore', function (data) {
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
        }

        var reRegisterCallBacks = function () {
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

            $.register_callback('scrolltoprompt', function (data) {
                $('#terminal').scrollTo('div.cmd_terminal_prompt', 1000, 'linear');
            });
        }

        var reRegisterCommands = function (url) {
            $.register_command(
                    url,
                    'send url to terminal for api result ',
                    'api/v1/listings/sortprice/[asc | desc]/sortdate/[asc | desc]/pageid/[0-5][/photosonly]',
                    {
                        ps             : 'php artisan',
                        start_hook     : function (url) {
                            return {
                                type    : 'print',
                                callback: 'typewriterbefore',
                                out     : url + ' before out ',
                                write   : url.join(' ') + ' before write '
                            }
                        },
                        exit_hook      : function () {
                            return {
                                type: 'print',
                                out : 'Good Bye '
                            };
                        },
                        dispatch_method: function (args) {
                            return $.ajax({
                                url     : args,
                                data    : '',
                                success : function (response) {
                                    console.log(response);
                                    return response;
                                },
                                dataType: 'json'
                            });
                        }
                    }
            );

            $.register_command(
                    'fetch:listings',
                    'consume xml and store in the database',
                    'fetch:listings',
                    '/artisan/fetchlistings'
            )

            var commands = ['clear-compiled', 'down', 'env', 'help', 'inspire', 'list', 'migrate', 'optimize', 'serve', 'tinker', 'up', 'app:name', 'auth:clear-resets', 'cache:clear', 'cache:table', 'config:cache', 'config:clear', 'db:seed', 'event:generate', 'handler:command', 'handler:event', 'ide-helper:generate', 'ide-helper:meta', 'ide-helper:models', 'key:generate', 'make:command', 'make:console', 'make:controller', 'make:event', 'make:job', 'make:listener', 'make:middleware', 'make:migration', 'make:model', 'make:policy', 'make:provider', 'make:request', 'make:seeder', 'make:test', 'migrate:install', 'migrate:refresh', 'migrate:reset', 'migrate:rollback', 'migrate:status', 'queue:failed', 'queue:failed-table', 'queue:flush', 'queue:forget', 'queue:listen', 'queue:restart', 'queue:retry', 'queue:subscribe', 'queue:table', 'queue:work', 'route:cache', 'route:clear', 'route:list', 'schedule:run', 'session:table', 'vendor:publish', 'view:clear'];

            for (var i = commands.length - 1; i >= 0; i--) {
                $.register_command(
                        commands[i],
                        ' artisan control ',
                        ' artisan control ',
                        '/artisan/' + commands[i]
                )
            }


        }

        var sendKeys = function (url) {
            $.flush_commands();
            //reRegisterCallBacks();
            //reRegisterCallBefores();
            //reRegisterCommands(url);
//            $.register_command(
//                    'buildUrl',
//                    '',
//                    '',
//                    url
//                    //'/artisan/fetchlistings'
//            )

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
                    cmd_url        : url,
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


            $('#terminal').find('form').find('input[type=text]').val('fetch:filtered').parent('form').submit();
        }


        var parseControlLogic = function (cmd) {
            // listdate|listprice   - sortprice
            // asc|desc             - sortdate
            // paged[x]             - pagedbtn
            // photos[1|0]          - photosonly
            var url = 'api/v1/listings/';
            url += 'sortprice/' + $('#sortprice').attr('data-sort');
            url += '/sortdate/' + $('#sortdate').attr('data-sort');
            url += '/pageid/' + $('#pagenumbtn').attr('data-page');
            if ($('#photosonly').attr('data-photosonly') == 1) {
                url += '/photosonly'; // + $('#photosonly').attr('data-photosonly');
            }
            console.log(window.location + url);
            sendKeys(url);
        };

        //$('#terminal').find('form').find('input[type=text]').val(rest_api[1].cmd_name).parent('form').submit();

        $('#toggle').click(function () {
            var pagenum = $('#pagenumbtn').attr('data-page');
            $.register_command(
                    'toggle',
                    'toggle a listing by id',
                    ' usage: toggle [1-5]',
                    'api/v1/listings/toggle/pageid/' + pagenum
            );
            $('#terminal').find('form').find('input[type=text]').val('toggle ' + pagenum).parent('form').submit();
        });

        $('#pagenumbtn').click(function () {

            if ($('#pagedbtn').attr('data-paged') == 1) {
                var num = parseInt($(this).attr('data-page'));
                num += 1;
                if (num > 5)
                    num = 1;
                $(this).attr('data-page', num);
                $(this).text('Page #' + num + ' >>');
            }
            parseControlLogic('');
        });

        $('.sortbtn').click(function () {
            var data = {};
            $(this).toggleClass('btnon');
            if ($(this).hasClass('btnon')) {
                $(this).text($(this).text().replace('ASC', 'DESC'));
                $(this).attr('data-sort', 'desc');
            }
            else {
                $(this).text($(this).text().replace('DESC', 'ASC'));
                $(this).attr('data-sort', 'asc');
            }
            parseControlLogic('')
        });

        $('.photosbtn').click(function () {
            $(this).toggleClass('btnon');
            if ($(this).hasClass('btnon')) {
                $(this).text($(this).text().replace('Off ', 'On '));
                $(this).attr('data-photosonly', '1');
            }
            else {
                $(this).text($(this).text().replace('On ', 'Off '));
                $(this).attr('data-photosonly', '0');
            }
        });

        $('.pagedbtn').click(function () {
            $(this).toggleClass('btnon');
            if ($(this).hasClass('btnon')) {
                $(this).text($(this).text().replace('Off ', 'On '));
                $(this).attr('data-paged', '1');
                $('#pagenumbtn').attr('data-page', 1);
                $('#pagenumbtn').text('Page #' + 1 + ' >>');
            }
            else {
                $(this).text($(this).text().replace('On ', 'Off '));
                $(this).attr('data-paged', '0');

                //reset pager
                $('#pagenumbtn').attr('data-page', 0);
                $('#pagenumbtn').text('Page #' + 0 + ' >>');

            }
        });

        $('.fetchbtn').click(function () {
            var cmd = $(this).data('cmd');
            var url = parseControlLogic(cmd);
            console.log(window.location.pathname + cmd);
            //


            //console.log(cmd)
        });

        //order sort page photosbool
        //        var rest_api = [
        //            {
        //                cmd_name       : 'fetch:listings',
        //                cmd_description: 'consume xml and store in the database',
        //                cmd_usage      : 'fetch:listingszz',
        //                cmd_url        : '/artisan/fetchlistings',
        //            },
        //            {
        //                cmd_name       : 'fetch:filtered',
        //                cmd_description: 'fetch paged data with filter options',
        //                cmd_usage      : 'fetch:filtered [listing id (1-5)] [sort by price 1=true 0=false] [order by (1=ascending 0=descending)] [photos only? p=photos l=listings & photos] ',
        //                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/paged1|paged0/photos1|photos0',
        //                //cmd_method     : 'GET'
        //            },
        //            {
        //                cmd_name       : 'fetch:photos',
        //                cmd_description: 'Fetch photos data with filter options.',
        //                cmd_usage      : 'fetch:page:[listing id (1-5)]',
        //                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/pageid1|pageid0/photos1|photos0',
        //                //cmd_method     : 'GET'
        //            },
        //            {
        //                cmd_name       : 'toggle',
        //                cmd_description: 'Toggle a listings Public flag',
        //                cmd_usage      : 'toggle [listing id (1-5)]',
        //                cmd_url        : '/api/v1/listings/listdate|listprice|unsorted/asc|desc/pageid1|pageid0/photos1|photos0',
        //                //cmd_method     : 'GET'
        //            }];
        //
        //        for (var i = rest_api.length - 1; i >= 0; i--) {
        //            $.register_command(
        //                    rest_api[i].cmd_name,
        //                    rest_api[i].cmd_description,
        //                    rest_api[i].cmd_usage,
        //                    rest_api[i].cmd_url
        //            )
        //
        //        }

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
                            'The goal of this application is to show my understanding of the framework and play with Laravel 5.1 for the first time. ' +
                            'I also wanted to use this oppurtunity to showcase my ability with other technologies commonly used in modern web development. ' +
                            'As it is stated on the left of this page I will begin by parsing xml and storing it in the database. '
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


        reRegisterCallBefores();
        reRegisterCallBacks();
        reRegisterCommands('fetch:listings');


        $('#terminal').find('form').find('input[type=text]').val('fetch:listings').parent('form').submit();

    })
    ;
</script>
<script type="text/javascript">(function () {
        document.write('<a style="display:block;overflow:hidden;z-index:9999;position:absolute;top:0.5px;left:0;" href="http://siliconprairiebuilt.com/" target="_blank"><img src="http://siliconprairiebuilt.com/build.php?i=corner-black-lg.png&s=' + window.location.host + '" /></a>');
    })();</script>