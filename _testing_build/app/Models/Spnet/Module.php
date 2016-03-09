<?php  namespace App\Models\Spnet;

use App\Models\Spnet;

/**
 * Class Module
 *
 * @package App\Models\Spnet
 */
class Module extends Spnet
{

	protected $table = 'tb_module';
	protected $primaryKey = 'module_id';

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();

	}

}
