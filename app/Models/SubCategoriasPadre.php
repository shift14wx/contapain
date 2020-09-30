<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubCategoriasPadre
 * 
 * @property int $id_categoria
 * @property int $is_sub_categoria_padre
 * @property character varying|null $titulo
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Categoria $categoria
 *
 * @package App\Models
 */
class SubCategoriasPadre extends Model
{
	use SoftDeletes;
	protected $table = 'sub_categorias_padre';
	protected $primaryKey = 'is_sub_categoria_padre';

	protected $casts = [
		'id_categoria' => 'int',
		'titulo' => 'character varying',
		'created_at' => 'timestamp without time zone',
		'updated_at' => 'timestamp without time zone'
	];

	protected $fillable = [
		'id_categoria',
		'titulo'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'id_categoria');
	}
}
