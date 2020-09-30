<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Registro
 * 
 * @property int $id_registro
 * @property int|null $id_detalle_concepto
 * @property float|null $debe
 * @property float|null $haber
 * @property character varying|null $concepto_detallado
 * @property int $id_rubro
 * @property int $id_asiento
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Rubro $rubro
 * @property Asiento $asiento
 *
 * @package App\Models
 */
class Registro extends Model
{
	use SoftDeletes;
	protected $table = 'registro';
	protected $primaryKey = 'id_registro';

	protected $casts = [
		'id_detalle_concepto' => 'int',
		'debe' => 'float',
		'haber' => 'float',
		'concepto_detallado' => 'character varying',
		'id_rubro' => 'int',
		'id_asiento' => 'int',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'id_detalle_concepto',
		'debe',
		'haber',
		'concepto_detallado',
		'id_rubro',
		'id_asiento'
	];

	public function rubro()
	{
		return $this->belongsTo(Rubro::class, 'id_rubro');
	}

	public function asiento()
	{
		return $this->belongsTo(Asiento::class, 'id_asiento');
	}
}
