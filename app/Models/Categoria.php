<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
	use SoftDeletes;
	protected $table = 'categorias';
    protected $primaryKey = 'id_categorias';
    
    protected $guarded = [];

    protected $casts = [
        "id_categorias" => "int",
        'created_at' => 'datetime:Y-m-d',
        'updated_at' =>  'datetime:Y-m-d',
    ];
    protected $appends= [ "sub", "id", "tabla", "tituloAndId" ];

    public function getTituloAndIdAttribute()
    {
        return $this->attributes["tituloAndId"] = $this->id." ".$this->titulo;
    }

    public function getIdAttribute()
    {
        return $this->attributes["id"] = $this->id_categorias;
    }

    public function getSubAttribute()
    {
        return $this->attributes['sub'] = $this->sub_categorias_padres()->get()->toArray();
    }

    public function getTablaAttribute()
    {
        return $this->attributes['tabla'] = "categoria";
    }

	public function sub_rubros_hijo()
	{
		return $this->belongsTo(SubRubrosHijo::class, 'id_sub_rubro_hijo');
	}

	public function sub_categorias_padres()
	{
		return $this->hasMany(SubCategoriasPadre::class, 'id_categoria');
	}
}
