<?php namespace App\Models;

class listing extends Spnet
{

	protected $table = 'listings';
	protected $primaryKey = 'id';

	public function __construct()
	{
		parent::__construct();

	}

	public static function querySelect()
	{

		return "  SELECT
					  listings.id
					  ,listings.FullStreetAddress
					  ,listings.City
					  ,listings.StateOrProvince
					  ,listings.PostalCode
					  ,listings.Country
					  ,listings.DiscloseAddress
					  ,listings.ListPrice
					  ,listings.ListPricePublic
					  ,listings.ListingURL
					  ,listings.Bedrooms
					  ,listings.Bathrooms
					  ,listings.PropertyType
					  ,listings.ListingKey
					  ,listings.ListingCategory
					  ,listings.ListingStatus
					  ,listings.ListingDescription
					  ,listings.MlsId
					  ,listings.MlsName
					  ,listings.MlsNumber
					FROM listings ";
	}

	public static function queryWhere($ids = array())
	{
		if ($ids)
		{
			return " WHERE listings.id IN( " . implode(',', $ids) . " )";
		}
		else
		{
			return " WHERE listings.id > 0 ";
		}
	}

	public static function queryGroup()
	{
		return " GROUP BY listings.id ";
	}

}
