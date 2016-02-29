<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class listingsphotos extends Spnet  {
	
	protected $table = 'listings_photos';
	protected $primaryKey = '';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return " SELECT listings_photos.* FROM listings_photos 
JOIN listings ON listings.id = listings_photos.listingId ";
	}	

	public static function queryWhere(  ){
		
		return " WHERE listings_photos.listingId > 0 ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
