<?php  namespace App\Models\Core;

use App\Models\Spnet;

/**
 * Class Logs
 *
 * @package App\Models\Core
 */
class Logs extends Spnet
{

	protected $table = 'tb_logs';
	protected $primaryKey = 'auditID';

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

		return "  SELECT tb_logs.* FROM tb_logs  ";
	}

	/**
	 * @return string
	 */
	public static function queryWhere()
	{

		return "  WHERE tb_logs.auditID IS NOT NULL ";
	}

	/**
	 * @return string
	 */
	public static function queryGroup()
	{
		return "  ";
	}

}
