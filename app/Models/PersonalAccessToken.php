<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalAccessToken
 * 
 * @property int $id
 * @property character varying $tokenable_type
 * @property int $tokenable_id
 * @property character varying $name
 * @property character varying $token
 * @property string|null $abilities
 * @property timestamp without time zone|null $last_used_at
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 *
 * @package App\Models
 */
class PersonalAccessToken extends Model
{
	protected $table = 'personal_access_tokens';

	protected $casts = [
		'tokenable_type' => 'character varying',
		'tokenable_id' => 'int',
		'name' => 'character varying',
		'token' => 'character varying',
		'last_used_at' => 'timestamp without time zone',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'tokenable_type',
		'tokenable_id',
		'name',
		'token',
		'abilities',
		'last_used_at'
	];
}
