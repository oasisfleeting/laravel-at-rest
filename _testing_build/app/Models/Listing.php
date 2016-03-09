<?php  namespace App\Models;

/**
 * Class Listing
 *
 * @package App\Models
 */
class Listing extends Spnet
{

	protected $table = 'listings';
	protected $primaryKey = 'id';
	protected $fillable = array('id', 'FullStreetAddress', 'City', 'StateOrProvince', 'PostalCode', 'Country', 'DiscloseAddress', 'ListPrice', 'ListPricePublic', 'ListingURL', 'Bedrooms', 'Bathrooms', 'PropertyType', 'ListingKey', 'ListingCategory', 'ListingStatus', 'ListingDescription', 'MlsId', 'MlsName', 'MlsNumber');

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * @return string
	 */
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

	/**
	 * @param array $ids
	 *
	 * @return string
	 */
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

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return " GROUP BY listings.id ";
	}

}
