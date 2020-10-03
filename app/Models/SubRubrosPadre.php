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
    use HasFactory;
	use SoftDeletes;
	protected $table = 'sub_rubros_padre';
	protected $primaryKey = 'id_sub_rubro_padre';

	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' =>  'datetime:Y-m-d',
	];

	protected $appends = [ "sub", "id", "tabla" ];

	protected $fillable = [
		'titulo',
		'id_rubro'
	];

	public function rubro()
	{
		return $this->belongsTo(Rubro::class, 'id_rubro');
	}

    public function getIdAttribute()
    {
        return $this->attributes["id"] = $this->id_sub_rubro_padre;
    }

	public function getSubAttribute()
    {
        return $this->sub_rubros_hijos()->get()->toArray();
    }

	public function sub_rubros_hijos()
	{
		return $this->hasMany(SubRubrosHijo::class, 'id_sub_rubro_padre');
	}

    public function getTablaAttribute()
    {
        return $this->attributes['tabla'] = "sub_rubro_padre";
    }
}
