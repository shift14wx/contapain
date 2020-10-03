<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
	use SoftDeletes;
	protected $table = 'sub_categorias_padre';
	protected $primaryKey = 'is_sub_categoria_padre';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' =>  'datetime:Y-m-d',
    ];

    protected $appends = [ "id", "tabla" ];

    public function getIdAttribute()
    {
        return $this->attributes["id"] = $this->is_sub_categoria_padre;
    }

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'id_categoria');
	}

    public function getTablaAttribute()
    {
        return $this->attributes['tabla'] = "sub_categoria_padre";
    }

}
