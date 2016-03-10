<?php  namespace App\Models;

/**
 * Class listingsphotos
 *
 * @package App\Models
 */
class listingsphotos extends Spnet
{

	protected $table = 'listings_photos';
	protected $primaryKey = 'id';

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

		return "
 				SELECT
				 listings_photos.id
				,listings_photos.Public
				,listings_photos.MediaModificationTimestamp
				,listings_photos.MediaURL
				,listings_photos.listingId
  				FROM listings_photos
  				";
	}

	/**
	 * @param null $id
	 *
	 * @return string
	 */
	public static function queryWhere($id = null)
	{
		if ($id)
		{
			return " WHERE listings_photos.listingId = " . $id;
		}
		else
		{
			return " WHERE listings_photos.id > 0 ";
		}
	}

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return " GROUP BY listings_photos.id  ";
	}

}
