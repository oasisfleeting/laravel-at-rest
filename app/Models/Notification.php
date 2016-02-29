<?php namespace App\Models;

class Notification extends Spnet  {
	
	protected $table = 'tb_notification';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_notification.* FROM tb_notification  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_notification.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
