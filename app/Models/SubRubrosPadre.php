<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubRubrosPadre
 * 
 * @property int $id_sub_rubro_padre
 * @property character varying $titulo
 * @property int $id_rubro
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Rubro $rubro
 * @property Collection|SubRubrosHijo[] $sub_rubros_hijos
 *
 * @package App\Models
 */
class SubRubrosPadre extends Model
{
	use SoftDeletes;
	protected $table = 'sub_rubros_padre';
	protected $primaryKey = 'id_sub_rubro_padre';

	protected $casts = [
		'titulo' => 'character varying',
		'id_rubro' => 'int',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'titulo',
		'id_rubro'
	];

	public function rubro()
	{
		return $this->belongsTo(Rubro::class, 'id_rubro');
	}

	public function sub_rubros_hijos()
	{
		return $this->hasMany(SubRubrosHijo::class, 'id_sub_rubro_padre');
	}
}
