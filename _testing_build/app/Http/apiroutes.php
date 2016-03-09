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

Route::get('/api/v1/listings/{order}/{sort?}/{pageid?}/{photos?}', function ($sort = 'asc', $order = '', $pageid = 0, $photos_only = 0)
{
	//scope vars
	$listings = '';
	$photos = '';


	//clean input
	$sort = strtolower($sort);
	if ($sort === 'listprice')
	{
		$sort = 'ListPrice';
	}
	elseif ($sort === 'listdate')
	{
		$sort = 'ListDate';
	}
	else
	{
		$sort = '';
	}

	//still cleaning
	$order       = strtolower($order);
	$order       = ($order === 'desc') ? $order : 'asc';
	$pageid      = filter_var($pageid, FILTER_SANITIZE_NUMBER_INT);
	$photos_only = filter_var($photos_only, FILTER_SANITIZE_NUMBER_INT);

	//query and request params
	$params['order'] = $order;
	$params['sort']  = $sort;
	$params['page']  = $pageid;

	$params['limit']  = $pageid == 0 ? 0 : 1;
	$params['filter'] = '';
	$params['params'] = " AND listings_photos.Public = 1 AND listings_photos.listingId = ";

	//print_r($params);

	$listings = array();
	if ($photos_only != 0)
	{
		//photos only
		$params['params'] = " AND listings_photos.Public = 1 ";
		$photos           = App\Models\Listingsphotos::all(array('id', 'Public', 'MediaModificationTimestamp', 'MediaURL', 'listingId'));
	}
	elseif ($pageid == 0)
	{
		//get all listings and photos
		//unsure how laravel 5 handles one to many.. guessing relations
		$params['params'] = "";
		$listings         = App\Models\Listing::getRows($params);
	}
	else
	{
		//paged data
		$listings = App\Models\Listing::find($pageid, array('id', 'FullStreetAddress', 'City', 'StateOrProvince', 'PostalCode', 'Country', 'DiscloseAddress', 'ListPrice', 'ListPricePublic', 'ListingURL', 'Bedrooms', 'Bathrooms', 'PropertyType', 'ListingKey', 'ListingCategory', 'ListingStatus', 'ListingDescription', 'MlsId', 'MlsName', 'MlsNumber',));
		$listings = $listings->toArray();
	}

	if(isset($listings['total']))
	{
		//fetch many photos per one listing
		for ($i = 0; $i < $listings['total']; $i++)
		{
			if ($params['sort'] === 'ListPrice')
			{
				$params['sort'] = '';
			}

			$params['params'] .= $listings['rows'][$i]->id;
			$photos                 = App\Models\Listingsphotos::getRows($params);
			$listings[$i]['photos'] = array_map(function ($in)
			{
				return (array) $in;
			}, $photos['rows']);
		}
	}

	$page       = $pageid >= 1 && $pageid !== false ? $pageid : 1;
	$pagenumber = ($page * $params['limit']) - $params['limit'];

});

Route::get('/artisan/{cmd?}', function ($cmd = null)
{

	$art = new App\Http\Controllers\ArtisanController();

	return $art->$cmd($cmd);
});
