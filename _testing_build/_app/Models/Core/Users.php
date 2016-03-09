<?php  namespace App\Models\Core;

use App\Models\Spnet;

/**
 * Class Users
 *
 * @package App\Models\Core
 */
class Users extends Spnet
{

	protected $table = 'tb_users';
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


		return " SELECT  tb_users.*,  tb_groups.name FROM tb_users LEFT JOIN tb_groups ON tb_groups.group_id = tb_users.group_id ";
	}

	/**
	 * @return string
	 */
	public static function queryWhere()
	{

		return "    WHERE tb_users.id !=''   ";
	}

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return "      ";
	}

}
