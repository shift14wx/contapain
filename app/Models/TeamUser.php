<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamUser
 * 
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property character varying|null $role
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 *
 * @package App\Models
 */
class TeamUser extends Model
{
	protected $table = 'team_user';

	protected $casts = [
		'team_id' => 'int',
		'user_id' => 'int',
		'role' => 'character varying',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'team_id',
		'user_id',
		'role'
	];
}
