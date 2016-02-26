<?php namespace App\Models;

class listing extends Spnet {

	protected $table = 'listings';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();

	}

	public static function querySelect() {

		return " SELECT listings.*, group_concat(listings_photos.id , listings_photos.Public, listings_photos.MediaModificationTimestamp, listings_photos.MediaURL  SEPARATOR', ') AS photos FROM listings
  JOIN listings_photos ON listings_photos.listingId = listings.id ";
	}

	public static function queryWhere($ids = array()) {

		$ids=array_map(function($idees){
			return (int)$idees;
		},$ids);
		return " WHERE listings.id > 0 ";  //IN( " . implode(',',$ids) .  " )";
	}

	public static function queryGroup() {
		return "  ";
	}


}
