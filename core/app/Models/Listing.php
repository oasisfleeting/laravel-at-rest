<?php namespace App\Models;

class listing extends Spnet {

	protected $table = 'listings';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();

	}

	public static function querySelect() {

		return "SELECT DISTINCT
				  listings.*,
				  GROUP_CONCAT(CONCAT_WS('|', listings_photos.id, listings_photos.Public, listings_photos.MediaModificationTimestamp, listings_photos.MediaURL) SEPARATOR ', ') AS photo_id_access_access_timestamp_url
				FROM laravelatrest.listings
				  JOIN listings_photos
				    ON listings_photos.listingId = listings.id";
	}

	public static function queryWhere( $ids = array() ) {

		$ids = array_map( function ( $idees ) {
			return (int) $idees;
		}, $ids );
		if ( $ids ) {
			return " WHERE listings.id IN( " . implode( ',', $ids ) . " )";
		} else {
			return " WHERE listings.id > 0 ";
		}
	}

	public static function queryGroup() {
		return "  ";
	}


}
