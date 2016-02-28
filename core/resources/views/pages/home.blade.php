<section class="slider">
    <div class="container-fluid border-shadow">
        <div class="row">
            <div class="col-md-4">
                <div class="overview">
                    <div class="welcome-message">
                        <h2 class="title animated fadeInUp delayp1">Laravel-At-Rest<br/>Summary</h2>
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
                    <div id="terminal" class="cmd_terminal_theme_fallout"></div>
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
                <span class="btn btn-danger btn-lg btn-block">Parse XML <i class="fa fa-retweet">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span class="btn btn-danger btn-lg btn-block">Fetch All <i class="fa fa-share-alt fa-rotate-270">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span class="btn btn-danger btn-lg btn-block">Fetch Paged <i class="fa fa-share-square-o fa-rotate-90">&nbsp;</i></span>
            </div>
            <div class="col-md-3 well center-block">
                <span class="btn btn-danger btn-lg btn-block"> Toggle <i class="fa fa-toggle-off">&nbsp;</i></span>
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
            <h2> <?php echo \Illuminate\Foundation\Inspiring::quote(); ?> </h2>
        </div>
    </div>
</section>
