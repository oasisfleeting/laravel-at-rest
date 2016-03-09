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
 * Class Groups
 *
 * @package App\Models\Core
 */
	class Groups extends \Eloquent {}
}

namespace App\Models\Core{
/**
 * Class Logs
 *
 * @package App\Models\Core
 */
	class Logs extends \Eloquent {}
}

namespace App\Models\Core{
/**
 * Class Pages
 *
 * @package App\Models\Core
 */
	class Pages extends \Eloquent {}
}

namespace App\Models\Core{
/**
 * Class Users
 *
 * @package App\Models\Core
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereLoginAttempt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereReminder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereActivation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Core\Users whereLastActivity($value)
 */
	class Users extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Listing
 *
 * @package App\Models
 * @property integer $id
 * @property string $FullStreetAddress
 * @property string $City
 * @property string $StateOrProvince
 * @property integer $PostalCode
 * @property string $Country
 * @property string $DiscloseAddress
 * @property float $ListPrice
 * @property string $ListPricePublic
 * @property string $ListingURL
 * @property boolean $Bedrooms
 * @property boolean $Bathrooms
 * @property string $PropertyType
 * @property string $ListingKey
 * @property string $ListingCategory
 * @property string $ListingStatus
 * @property string $ListingDescription
 * @property string $MlsId
 * @property string $MlsName
 * @property integer $MlsNumber
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereFullStreetAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereStateOrProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing wherePostalCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereDiscloseAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListPricePublic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListingURL($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereBedrooms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereBathrooms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing wherePropertyType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListingKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListingCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListingStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereListingDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereMlsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereMlsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Listing whereMlsNumber($value)
 */
	class Listing extends \Eloquent {}
}

namespace App\Models{
/**
 * Class listingsphotos
 *
 * @package App\Models
 * @property integer $id
 * @property string $Public
 * @property string $MediaModificationTimestamp
 * @property string $MediaURL
 * @property integer $listingId
 * @method static \Illuminate\Database\Query\Builder|\App\Models\listingsphotos whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\listingsphotos wherePublic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\listingsphotos whereMediaModificationTimestamp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\listingsphotos whereMediaURL($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\listingsphotos whereListingId($value)
 */
	class listingsphotos extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Notification
 *
 * @package App\Models
 */
	class Notification extends \Eloquent {}
}

namespace App\Models\Spnet{
/**
 * Class Menu
 *
 * @package App\Models\Spnet
 */
	class Menu extends \Eloquent {}
}

namespace App\Models\Spnet{
/**
 * Class Module
 *
 * @package App\Models\Spnet
 */
	class Module extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Spnet
 *
 * @package App\Models
 */
	class Spnet extends \Eloquent {}
}

namespace App{
/**
 * Class User
 *
 * @package App
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
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLoginAttempt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereReminder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActivation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastActivity($value)
 */
	class User extends \Eloquent {}
}

