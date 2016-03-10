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
	$listings                   = array();
	$listing                    = array();
	$html                       = '';
	$html_imgs                  = '';
	$photos                     = '';
	$total                      = 0;
	$params                     = array('page' => $pageid, 'limit' => ($pageid > 0) ? 1 : 0, 'sort' => '', 'order' => '', 'params' => '', 'global' => 1);
	$listingParams              = array('sort' => ' ListPrice ', 'order' => ($lpsort === 'desc') ? $lpsort : ' asc ', 'params' => '',);
	$photoParams                = array('sort' => ' MediaModificationTimestamp ', 'order' => ($ldsort === 'desc') ? $ldsort : ' asc ', 'params' => ' AND listings_photos.Public = 1 ',);
	$photoPagedParams['params'] = ' AND listings_photos.listingId = ';
	$listPagedParams['params']  = ' AND id = ';

	$photos_only = ((isset($photos_only) && $photos_only > 0) || $photos_only === 'photosonly') ? 1 : 0;

	if ($photos_only)
	{
		if ($pageid)
		{
			//paged photos
			$conditional['params'] = $params['params'] . $photoParams['params'] . $photoPagedParams['params'] . $pageid;
			$args                  = array_merge($params, $photoParams, $conditional);
			$photos                = App\Models\Listingsphotos::getRows($args);
		}
		else
		{
			//all photos only
			$conditional['params'] = $params['params'] . $photoParams['params'];
			$args                  = array_merge($params, $photoParams, $conditional);
			$photos                = App\Models\Listingsphotos::getRows($args);
		}

		$listing = array_map(function ($in)
		{
			$in = (array) $in;
			$html = '<div class="clearfix"><img style="width:60px;" src="'.$in['MediaURL'].'"/></div>';
			return $html . json_encode($in);
		}, $photos['rows']);
	}
	elseif ($pageid)
	{
		//paged listings and photos
		$conditional['params'] = $params['params'] . $listingParams['params'] . $listPagedParams['params'] . $pageid;
		$args                  = array_merge($params, $listingParams, $conditional);
		$pagedListings         = App\Models\Listing::getRows($args);
		$listings              = $pagedListings['rows'];
		$total                 = count($listings);
	}
	else
	{
		//all listings and photos
		//TODO: use eloquent relations
		$conditional['params'] = $params['params'] . $listingParams['params'];// . $listPagedParams['params'];
		$args                  = array_merge($params, $listingParams, $conditional);
		$pagedListings         = App\Models\Listing::getRows($args);
		$listings              = $pagedListings['rows'];
		$total                 = count($listings);
	}

	if ($total)
	{
		//fetch many photos per one listing
		for ($i = 0; $i < $total; $i++)
		{
			$listing[$i]           = (array) $listings[$i];
			$conditional['params'] = $params['params'] . $photoParams['params'] . $photoPagedParams['params'] . $listing[$i]['id'];
			$args                  = array_merge($params, $photoParams, $conditional);
			$photos                = App\Models\Listingsphotos::getRows($args);
			unset($args);
			$listing[$i]['photos'] = array_map(function ($in)
			{
				return (array) $in;
			}, $photos['rows']);
			//unset($listings[$i]);

			$listings[$i] = $listing[$i];
			$listing[$i]  = json_encode($listing[$i]);

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

	array_push($listing, $html);

	$resp             = array();
	$resp['type']     = 'print';
	$resp['out']      = $listing;
	$resp['callback'] = 'scrolltoprompt';


	return response()->json($resp);

});

Route::get('/artisan/{cmd?}', function ($cmd = null)
{

	$art = new App\Http\Controllers\ArtisanController();

	return $art->$cmd($cmd);
});
