<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Core{
/**
 * App\Models\Core\Groups
 *
 * @property integer $group_id
 * @property string $name
 * @property string $description
 * @property integer $level
 */
	class Groups {}
}

namespace App\Models\Core{
/**
 * App\Models\Core\Logs
 *
 * @property integer $auditID
 * @property string $ipaddress
 * @property integer $user_id
 * @property string $module
 * @property string $task
 * @property string $note
 * @property string $logdate
 */
	class Logs {}
}

namespace App\Models\Core{
/**
 * App\Models\Core\Pages
 *
 * @property integer $pageID
 * @property string $title
 * @property string $alias
 * @property string $note
 * @property string $created
 * @property string $updated
 * @property string $filename
 * @property string $status
 * @property string $access
 * @property string $allow_guest
 * @property string $template
 * @property string $metakey
 * @property string $metadesc
 */
	class Pages {}
}

namespace App\Models\Core{
/**
 * App\Models\Core\Users
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property boolean $active
 * @property boolean $login_attempt
 * @property string $last_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $reminder
 * @property string $activation
 * @property string $remember_token
 * @property integer $last_activity
 */
	class Users {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property integer $id
 * @property integer $userid
 * @property string $url
 * @property string $title
 * @property string $note
 * @property string $created
 * @property string $icon
 * @property string $is_read
 */
	class Notification {}
}

namespace App\Models\Spnet{
/**
 * App\Models\Spnet\Menu
 *
 * @property integer $menu_id
 * @property integer $parent_id
 * @property string $module
 * @property string $url
 * @property string $menu_name
 * @property string $menu_type
 * @property string $role_id
 * @property integer $deep
 * @property integer $ordering
 * @property string $position
 * @property string $menu_icons
 * @property string $active
 * @property string $access_data
 * @property string $allow_guest
 * @property string $menu_lang
 */
	class Menu {}
}

namespace App\Models\Spnet{
/**
 * App\Models\Spnet\Module
 *
 * @property integer $module_id
 * @property string $module_name
 * @property string $module_title
 * @property string $module_note
 * @property string $module_author
 * @property string $module_created
 * @property string $module_desc
 * @property string $module_db
 * @property string $module_db_key
 * @property string $module_type
 * @property string $module_config
 * @property string $module_lang
 */
	class Module {}
}

namespace App\Models{
/**
 * App\Models\Spnet
 *
 */
	class Spnet {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property boolean $active
 * @property boolean $login_attempt
 * @property string $last_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $reminder
 * @property string $activation
 * @property string $remember_token
 * @property integer $last_activity
 */
	class User {}
}

