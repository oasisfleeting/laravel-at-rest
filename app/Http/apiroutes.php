<?php
/**
 * Created by IntelliJ IDEA.
 * User: admin
 * Date: 3/2/2016
 * Time: 5:14 AM
 */
//echo "<pre>";

Route::get('/api/v1/listings/{id?}/{paged?}/{order?}/{sort?}', ['middleware' => 'auth.basic', function ($id = null,$order=1,$page=1,$sort=0)
{
	$params['sort']   = $sort ? 'MediaModificationTimestamp' : '';
	$params['order']  = filter_var($order, FILTER_VALIDATE_INT) ? 'acs' : 'desc';
	$params['filter'] = '';
	$params['page']   = filter_var($page, FILTER_VALIDATE_INT);
	$params['limit']  = $id==null ? 0 : 1;
	$listings         = array();
	if ($id == null)
	{
		$listings = App\Models\Listing::all(array('id', 'FullStreetAddress', 'City', 'StateOrProvince', 'PostalCode', 'Country', 'DiscloseAddress', 'ListPrice', 'ListPricePublic', 'ListingURL', 'Bedrooms', 'Bathrooms', 'PropertyType', 'ListingKey', 'ListingCategory', 'ListingStatus', 'ListingDescription', 'MlsId', 'MlsName', 'MlsNumber'));
		$listings = $listings->toArray();
		for ($i = 0; $i < count($listings); $i++)
		{
			$params['params']       = " AND listings_photos.Public = 1 AND listings_photos.listingId = " . $listings[$i]['id'];
			$photos                 = App\Models\Listingsphotos::getRows($params);
			$listings[$i]['photos'] = array_map(function ($in){return (array) $in;}, $photos['rows']);
		}
	}
	else
	{

		$listings           = App\Models\Listing::find($id, array('id', 'FullStreetAddress', 'City', 'StateOrProvince', 'PostalCode', 'Country', 'DiscloseAddress', 'ListPrice', 'ListPricePublic', 'ListingURL', 'Bedrooms', 'Bathrooms', 'PropertyType', 'ListingKey', 'ListingCategory', 'ListingStatus', 'ListingDescription', 'MlsId', 'MlsName', 'MlsNumber'));
		$listings           = $listings->toArray();
		$params['params']   = " AND listings_photos.Public = 1 AND listings_photos.listingId = " . $id;
		$photos             = App\Models\Listingsphotos::getRows($params);
		$listings['photos'] = array_map(function ($in){return (array) $in;}, $photos['rows']);

	}

	$page       = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
	//echo '<pre>';
	//return response()->view('',print_r($listings));
	response()->view('pages.json',$content =array('error' => false, 'listings' => $listings, 'status_code' => 200, 'pagenumber'=>($page * $params['limit']) - $params['limit']));

//	return response()->json(
//		array('error' => false, 'listings' => $listings, 'status_code' => 200, 'pagenumber'=>($page * $params['limit']) - $params['limit'])
//	);

}]);

