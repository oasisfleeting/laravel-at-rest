<?php  namespace App\Models;

/**
 * Class Notification
 *
 * @package App\Models
 */
class Notification extends Spnet
{

	protected $table = 'tb_notification';
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

		return "  SELECT tb_notification.* FROM tb_notification  ";
	}

	/**
	 * @return string
	 */
	public static function queryWhere()
	{

		return "  WHERE tb_notification.id IS NOT NULL ";
	}

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return "  ";
	}

}
