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
 * Class Rubro
 *
 * @property int $id_rubro
 * @property character varying $titulo
 * @property int|null $debe
 * @property int|null $haber
 * @property string|null $deleted_at
 * @property timestamp without time zone|null $created_at
 * @property timestamp without time zone|null $updated_at
 *
 * @property Collection|SubRubrosPadre[] $sub_rubros_padres
 * @property Collection|Registro[] $registros
 *
 * @package App\Models
 */
class Rubro extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $table = 'Rubros';
	protected $primaryKey = 'id_rubro';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' =>  'datetime:Y-m-d',
    ];
    protected $appends= [ "sub", "id", "tabla" ];



    public function getIdAttribute()
    {
        return $this->attributes["id"] = $this->id_rubro;
    }

    public function getSubAttribute()
    {
        return $this->attributes['sub'] = $this->sub_rubros_padres()->get()->toArray();
    }

    public function getTablaAttribute()
    {
        return $this->attributes['tabla'] = "rubro";
    }

	public function sub_rubros_padres()
	{
		return $this->hasMany(SubRubrosPadre::class, 'id_rubro');
	}

	public function registros()
	{
		return $this->hasMany(Registro::class, 'id_rubro');
	}
}
