<?php  namespace App\Models\Core;

use App\Models\Spnet;

/**
 * Class Groups
 *
 * @package App\Models\Core
 */
class Groups extends Spnet
{

	protected $table = 'tb_groups';
	protected $primaryKey = 'group_id';

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

		return " SELECT  
	tb_groups.group_id,
	tb_groups.name,
	tb_groups.description,
	tb_groups.level


FROM tb_groups  ";
	}

	/**
	 * @return string
	 */
	public static function queryWhere()
	{

		return "  WHERE tb_groups.group_id IS NOT NULL    ";
	}

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return "    ";
	}

}
