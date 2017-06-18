<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Model{
/**
 * Class Character
 *
 * @package App\Model
 * @property int $id
 * @property int $game_id
 * @property string $name
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Character whereUpdatedAt($value)
 */
	class Character extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Combo
 *
 * @property int $id
 * @property int $character_id
 * @property int $damage
 * @property int $stun
 * @property string $memo
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereCharacterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereDamage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereMemo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereStun($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereUserId($value)
 */
	class Combo extends \Eloquent {}
}

namespace App\Model{
/**
 * Class Game
 *
 * @package App\Model
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereLogo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Move
 *
 * @property int $id
 * @property int $character_id
 * @property string $name
 * @property int $damage
 * @property int $stun
 * @property int $meter
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereCharacterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereDamage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereMeter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereStun($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Move whereUpdatedAt($value)
 */
	class Move extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Recipe
 *
 * @property int $id
 * @property int $combo_id
 * @property int $move_id
 * @property int $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereComboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereMoveId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Recipe whereUpdatedAt($value)
 */
	class Recipe extends \Eloquent {}
}

namespace App\Model{
/**
 * Class User
 *
 * @package App\Model
 * @property String $name
 * @property int $id
 * @property string $login_id
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereLoginId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $login_id
 * @property string $email
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLoginId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

