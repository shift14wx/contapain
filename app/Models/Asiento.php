<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asiento
 * 
 * @property int $id_asiento
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_cerrado
 * @property character varying|null $concepto_general
 * @property float|null $saldo
 * @property string|null $deleted_at
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * 
 * @property Collection|Registro[] $registros
 *
 * @package App\Models
 */
class Asiento extends Model
{
	use SoftDeletes;
	protected $table = 'Asiento';
	protected $primaryKey = 'id_asiento';

	protected $casts = [
		'concepto_general' => 'character varying',
		'saldo' => 'float',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $dates = [
		'fecha_inicio',
		'fecha_cerrado'
	];

	protected $fillable = [
		'fecha_inicio',
		'fecha_cerrado',
		'concepto_general',
		'saldo'
	];

	public function registros()
	{
		return $this->hasMany(Registro::class, 'id_asiento');
	}
}