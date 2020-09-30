<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubRubrosHijo
 * 
 * @property int $id_sub_rubro_hijo
 * @property character varying|null $titulo
 * @property int $id_sub_rubro_padre
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property SubRubrosPadre $sub_rubros_padre
 * @property Collection|Categoria[] $categorias
 *
 * @package App\Models
 */
class SubRubrosHijo extends Model
{
	use SoftDeletes;
	protected $table = 'sub_rubros_hijo';
	protected $primaryKey = 'id_sub_rubro_hijo';

	protected $casts = [
		'titulo' => 'character varying',
		'id_sub_rubro_padre' => 'int',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'titulo',
		'id_sub_rubro_padre'
	];

	public function sub_rubros_padre()
	{
		return $this->belongsTo(SubRubrosPadre::class, 'id_sub_rubro_padre');
	}

	public function categorias()
	{
		return $this->hasMany(Categoria::class, 'id_sub_rubro_hijo');
	}
}
