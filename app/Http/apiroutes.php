<?php

/** Created by IntelliJ IDEA.
 * User: admin
 * Date: 3/2/2016
 * Time: 5:14 AM
 */

//special access
//parselistings and other artisan commands

//$id //price  //asc-desc
//api/v1/listings/pageid/sorted/asc/
//api/v1/listings/pageid/sorted/desc/
///api/v1/listings/pageid/sorted/asc

Route::get('/api/v1/listings/sortprice/{lpsort?}/sortdate/{ldsort?}/pageid/{pageid?}/{photos?}', function ($lpsort = 'asc', $ldsort = 'asc', $pageid = 0, $photos_only = 0)
{
	//scope vars
	$listings    = array();
	$listing     = array();
	$html        = '';
	$html_imgs   = '';
	$photos      = '';
	$total       = 0;
	$listingArgs = '';

	$select = ' SELECT id FROM listings ORDER BY ';
	$select .= ($lpsort == 'asc') ? ' ListPrice asc ' : ' ListPrice  desc ';
	$lids = array_map(function ($in)
	{
		return $in->id;
	}, DB::select($select));

	$field_column   = ' listings_photos.listingId ';
	$sort           = ' FIELD(' . $field_column . ', ' . implode(',', $lids) . ') ';
	$params['sort'] = $sort;

	$li          = new App\Models\Listing();
	$lp          = new App\Models\Listingsphotos();
	$photos_only = ($photos_only === 'photosonly') ? 1 : 0;

	if ($pageid)
	{
		$listingId     = $lids[$pageid - 1];
		$sql           = $li->querySelect() . $li->queryWhere(array($listingId)) . $li->queryGroup();// . ' LIMIT ' . $pageid . ' , 1';
		$pagedListings = DB::select($sql);
		$listings      = $pagedListings;
		$total         = count($listings);
		//print_r($listings);
	}
	else
	{
		$field_column  = ' listings.id ';
		$sql           = $li->querySelect() . $li->queryWhere() . $li->queryGroup() . ' ORDER BY FIELD(' . $field_column . ', ' . implode(',', $lids) . ') '; //{$orderConditional} . {$limitConditional};
		$pagedListings = DB::select($sql);
		$listings      = $pagedListings;
		$total         = count($listings);
	}

	if ($total)
	{
		//fetch many photos per one listing
		for ($i = 0; $i < $total; $i++)
		{
			$listings[$i]    = (array) $listings[$i];
			$sort            = ' MediaModificationTimestamp ';
			$params['sort']  = $sort;
			$params['order'] = ($ldsort === 'desc') ? $ldsort : ' asc ';
			$args            = $params;
			$sql             = $lp->querySelect() . $lp->queryWhere($listings[$i]['id']) . ' ORDER BY ' . $params['sort'] . $params['order'];
			$photos          = DB::select($sql);

			if ($photos_only)
			{
				$id = $listings[$i]['id'];
				unset($listings[$i]);
				$listings[$i]['id'] = $id;
			}

			$listings[$i]['photos'] = array_map(function ($in)
			{
				return (array) $in;
			}, $photos);

			//copy the array
			$listing[$i] = json_encode($listings[$i]);

			$html .= '<div class="clearfix row">';
			$html .= '<dl class="dl-horizontal">';
			foreach ($listings[$i] as $key => $val)
			{
				if (is_array($val))
				{
					for ($j = 0; $j < count($val); $j++)
					{
						$html_imgs .= '<span class="col-md-1"><img style="width:60px;" src="' . $val[$j]['MediaURL'] . '"/></span>';
					}
				}
				else
				{
					$html .= '<dt class="clearfix">' . $key . '</dt>';
					$html .= '<dd class="clearfix" style="white-space:normal">' . $val . '</dd>';
				}

			}
			$html .= '</dl>';

			$html .= '<div class="row" style="height:60px;">' . $html_imgs . '</div>';
			$html .= '</div>';
			$html_imgs = '';
		}
	}
	//$listing['args'] = $listingArgs;
	array_push($listing, $html . print_r($listingArgs, true));

	//	for ($i = 0; $i < count($listingArgs); $i++)
	//	{
	//		$args = $listingArgs[$i];
	//
	//		$stats = '<div class="clearfix row">';
	//		$stats .= '<dl class="dl-horizontal">';
	//		foreach($args as $key=>$val)
	//		{
	//			$stats .= '<dt class="clearfix">' . $key . '</dt>';
	//			$stats .= '<dd class="clearfix" style="white-space:normal">' . $val . '</dd>';
	//		}
	//		$stats .= '</dl></div>';
	//
	//	}
	//	array_push($listing, $stats);

	//array_push($listing, json_encode(array('args'=>$listingArgs)));

	$resp             = array();
	$resp['type']     = 'print';
	$resp['out']      = $listing;
	$resp['callback'] = 'scrolltoprompt';

	return response()->json($resp);

});

Route::get('/api/v1/listings/toggle/pageid/{id?}', function ($id = 0)
{
	$out = 'No page id given so no record could be found for toggling. ';
	if ($id)
	{
		$li = new App\Models\Listing();
		$found = $li->find($id,array('id','ListingStatus'));
		if($found->getAttribute('ListingStatus') === 'Active'){
			$status = array('ListingStatus'=>'Inactive');
			$out = 'Record ' . $id . ' has been set to Inactive status. Chose not to hide the record for easier evaluation of overall functionality. ';
		}else{
			$status = array('ListingStatus'=>'Active');
			$out = 'Record ' . $id . ' is now Active. ';
		}
		$found->update($status);
	}


	$resp = array();
	$resp['type']='print';
	$resp['out']=$out;
	$resp['callback']='scrolltoprompt';
	return response()->json($resp);

});

Route::get('/artisan/{cmd?}', function ($cmd = null)
{

	$art = new App\Http\Controllers\ArtisanController();
	if(in_array($cmd,$art->checkCommand(),true)){

		return $art->genericCommand($cmd);

	}
	return $art->$cmd($cmd);
});
