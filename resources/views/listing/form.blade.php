@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('listing?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'listing/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Property Listings</legend>
									
								  <div class="form-group  " >
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="FullStreetAddress" class=" control-label col-md-4 text-left"> FullStreetAddress </label>
									<div class="col-md-6">
									  {!! Form::text('FullStreetAddress', $row['FullStreetAddress'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="City" class=" control-label col-md-4 text-left"> City </label>
									<div class="col-md-6">
									  {!! Form::text('City', $row['City'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="StateOrProvince" class=" control-label col-md-4 text-left"> StateOrProvince </label>
									<div class="col-md-6">
									  {!! Form::text('StateOrProvince', $row['StateOrProvince'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="PostalCode" class=" control-label col-md-4 text-left"> PostalCode </label>
									<div class="col-md-6">
									  {!! Form::text('PostalCode', $row['PostalCode'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Country" class=" control-label col-md-4 text-left"> Country </label>
									<div class="col-md-6">
									  {!! Form::text('Country', $row['Country'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="DiscloseAddress" class=" control-label col-md-4 text-left"> DiscloseAddress </label>
									<div class="col-md-6">
									  {!! Form::text('DiscloseAddress', $row['DiscloseAddress'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListPrice" class=" control-label col-md-4 text-left"> ListPrice </label>
									<div class="col-md-6">
									  {!! Form::text('ListPrice', $row['ListPrice'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListPricePublic" class=" control-label col-md-4 text-left"> ListPricePublic </label>
									<div class="col-md-6">
									  {!! Form::text('ListPricePublic', $row['ListPricePublic'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListingURL" class=" control-label col-md-4 text-left"> ListingURL </label>
									<div class="col-md-6">
									  {!! Form::text('ListingURL', $row['ListingURL'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Bedrooms" class=" control-label col-md-4 text-left"> Bedrooms </label>
									<div class="col-md-6">
									  {!! Form::text('Bedrooms', $row['Bedrooms'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Bathrooms" class=" control-label col-md-4 text-left"> Bathrooms </label>
									<div class="col-md-6">
									  {!! Form::text('Bathrooms', $row['Bathrooms'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="PropertyType" class=" control-label col-md-4 text-left"> PropertyType </label>
									<div class="col-md-6">
									  {!! Form::text('PropertyType', $row['PropertyType'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListingKey" class=" control-label col-md-4 text-left"> ListingKey </label>
									<div class="col-md-6">
									  {!! Form::text('ListingKey', $row['ListingKey'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListingCategory" class=" control-label col-md-4 text-left"> ListingCategory </label>
									<div class="col-md-6">
									  {!! Form::text('ListingCategory', $row['ListingCategory'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListingStatus" class=" control-label col-md-4 text-left"> ListingStatus </label>
									<div class="col-md-6">
									  {!! Form::text('ListingStatus', $row['ListingStatus'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ListingDescription" class=" control-label col-md-4 text-left"> ListingDescription </label>
									<div class="col-md-6">
									  {!! Form::text('ListingDescription', $row['ListingDescription'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="MlsId" class=" control-label col-md-4 text-left"> MlsId </label>
									<div class="col-md-6">
									  {!! Form::text('MlsId', $row['MlsId'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="MlsName" class=" control-label col-md-4 text-left"> MlsName </label>
									<div class="col-md-6">
									  {!! Form::text('MlsName', $row['MlsName'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="MlsNumber" class=" control-label col-md-4 text-left"> MlsNumber </label>
									<div class="col-md-6">
									  {!! Form::text('MlsNumber', $row['MlsNumber'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('listing?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop