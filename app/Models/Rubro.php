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

//
//	protected $casts = [
//		'titulo' => 'character varying',
//		'debe' => 'int',
//		'haber' => 'int',
//		'created_at' => 'timestamp without time zone',
//		'updated_at' => 'timestamp without time zone'
//	];

	protected $fillable = [
		'titulo',
		'debe',
		'haber'
	];

	public function sub_rubros_padres()
	{
		return $this->hasMany(SubRubrosPadre::class, 'id_rubro');
	}

	public function registros()
	{
		return $this->hasMany(Registro::class, 'id_rubro');
	}
}
