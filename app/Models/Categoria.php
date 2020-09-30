<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categoria
 * 
 * @property int $id_sub_rubro_hijo
 * @property int $id_categorias
 * @property character varying|null $titulo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property SubRubrosHijo $sub_rubros_hijo
 * @property Collection|SubCategoriasPadre[] $sub_categorias_padres
 *
 * @package App\Models
 */
class Categoria extends Model
{
	use SoftDeletes;
	protected $table = 'categorias';
	protected $primaryKey = 'id_categorias';

	protected $casts = [
		'id_sub_rubro_hijo' => 'int',
		'titulo' => 'character varying',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'id_sub_rubro_hijo',
		'titulo'
	];

	public function sub_rubros_hijo()
	{
		return $this->belongsTo(SubRubrosHijo::class, 'id_sub_rubro_hijo');
	}

	public function sub_categorias_padres()
	{
		return $this->hasMany(SubCategoriasPadre::class, 'id_categoria');
	}
}
