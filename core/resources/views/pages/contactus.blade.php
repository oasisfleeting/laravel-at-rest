<section class="contact" id="contact">
    <div class="container">
        <div class="row m-b-lg animated fadeInDown delayp1">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Lyle Mcclanahan</h1>
                <h2>Kiss Expert</h2>
                <p>Keep It Simple Stupid</p>
                <p>{{ Illuminate\Foundation\Inspiring::quote() }}</p>
                <hr />
            </div>
        </div>
        <div class="row m-b-lg ">
            <div class="col-lg-3 col-lg-offset-3 animated fadeInLeft delayp1">
                <address>
                    <strong><span class="navy">Seeking Employment</span></strong><br>
                    .... East 51st South<br>
                    Wichita, Kansas 67216<br>
                    <abbr title="Phone">P:</abbr> (316) JDK-HTML (535-4865)
                    <br/>
                    <abbr title="Phone">P:</abbr> (316) 202-8274
                </address>
            </div>
            <div class="col-lg-4 animated fadeInRight delayp1">
                <p class="text-color">
                Everything is developed. <br/>
                Simple things are developed well.

                </p>
            </div>
        </div>
		
            <div class="row text-center">
                <div class="contact-form col-md-6 col-sm-12 col-xs-12 col-md-offset-3 animated fadeInUp delayp3" >                            
					@if(Session::has('message'))	  
						   {!! Session::get('message') !!}
					@endif	
						
					<ul class="parsley-error-list">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>                   

                   {!! Form::open(array('url'=>'home/contact', 'class'=>'form','parsley-validate'=>'','novalidate'=>' ')) !!}             
                        <div class="form-group name">
                            <label for="name" class="sr-only">Name</label>
                              {!! Form::text('name', null,array('class'=>'form-control', 'placeholder'=>'Full Name:', 'required'=>'true'  )) !!} 
                        </div><!--//form-group-->
                        <div class="form-group email">
                            <label for="email" class="sr-only">Email</label>
                             {!! Form::text('sender', null,array('class'=>'form-control', 'placeholder'=>'Email:', 'required'=>'true'  )) !!} 
                        </div><!--//form-group-->

                        <div class="form-group email">
                            <label for="subject" class="sr-only">Email</label> 
                              {!! Form::text('subject', null,array('class'=>'form-control', 'placeholder'=>'Subject:', 'required'=>'true email'   )) !!} 
                        </div><!--//form-group-->
                        <div class="form-group message">
                            <label for="message" class="sr-only">Message</label>
                            {!! Form::textarea('message',null,array('class'=>'form-control', 'placeholder'=>'Message:', 'required'=>'true'   )) !!}		                           
                        </div><!--//form-group-->
                        <button class="btn btn-sm btn-primary" type="submit">Send us mail</button>
                        <input type="hidden" name="redirect" value="contact-us">
                    {!! Form::close() !!}<!--//form-->                 
                </div><!--//contact-form-->
            </div><!--//row-->
		
        <div class="row">
        </div>
    </div>
</section>















