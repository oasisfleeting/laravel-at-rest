<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class listingsphotos extends Spnet
{

	protected $table = 'listings_photos';
	protected $primaryKey = 'id';

//	public static function getRows($args)
//	{
//		$table = with(new static)->table;
//		$key   = with(new static)->primaryKey;
//
//		extract(array_merge(array('page' => '0', 'limit' => '0', 'sort' => '', 'order' => '', 'params' => '', 'global' => 1), $args));
//
//		$offset           = ($page - 1) * $limit;
//		$limitConditional = ($page != 0 && $limit != 0) ? "LIMIT  $offset , $limit" : '';
//		$orderConditional = ($sort != '' && $order != '') ? " ORDER BY {$sort} {$order} " : '';
//
//		// Update permission global / own access
//		if ($global == 0)
//		{
//			$params .= " AND {$table}.entry_by ='" . \Session::get('uid') . "'";
//		}
//
//		$rows   = array();
//		$result = \DB::select(self::querySelect() . self::queryWhere() . "
//				{$params} " . self::queryGroup() . " {$orderConditional}  {$limitConditional} ");
//
//		if ($key == '')
//		{
//			$key = '*';
//		}
//		else
//		{
//			$key = $table . "." . $key;
//		}
//
//		$total = \DB::select(self::querySelect() . self::queryWhere() . "
//				{$params} " . self::queryGroup() . " {$orderConditional}  ");
//		$total = count($total);
//
//		//		$total = $res[0]->total;
//
//		return $results = array('rows' => $result, 'total' => $total);
//
//	}

	public function __construct()
	{
		parent::__construct();

	}

	public static function querySelect()
	{

		return "
 				SELECT
				listings_photos.id
				,listings_photos.Public
				,listings_photos.MediaModificationTimestamp
				,listings_photos.MediaURL
				,listings_photos.listingId
  				FROM listings_photos ";
	}

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

	public static function queryGroup()
	{
		return " GROUP BY listings_photos.id  ";
	}

}
