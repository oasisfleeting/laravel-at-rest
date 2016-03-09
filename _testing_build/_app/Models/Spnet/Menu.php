<?php  namespace App\Models\Spnet;

use App\Models\Spnet;

/**
 * Class Menu
 *
 * @package App\Models\Spnet
 */
class Menu extends Spnet
{

	protected $table = 'tb_menu';
	protected $primaryKey = 'menu_id';

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();

	}

}
