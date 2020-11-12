<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * 
 * @property character varying $id
 * @property int|null $user_id
 * @property character varying|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 *
 * @package App\Models
 */
class Session extends Model
{
	protected $table = 'sessions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'character varying',
		'user_id' => 'int',
		'ip_address' => 'character varying',
		'last_activity' => 'int'
	];

	protected $fillable = [
		'user_id',
		'ip_address',
		'user_agent',
		'payload',
		'last_activity'
	];
}
