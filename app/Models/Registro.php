<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class registro
 * @package App\Models
 * @version October 1, 2020, 5:17 am UTC
 *
 * @property \App\Models\Rubro $idRubro
 * @property \App\Models\Asiento $idAsiento
 * @property integer $id_detalle_concepto
 * @property number $debe
 * @property number $haber
 * @property string $concepto_detallado
 * @property integer $id_rubro
 * @property integer $id_asiento
 */
class registro extends Model
{
    use SoftDeletes;

    public $table = 'registro';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id_registro';
    
    public $fillable = [
        'id_detalle_concepto',
        'debe',
        'haber',
        'concepto_detallado',
        'id_rubro',
        'id_asiento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_registro' => 'integer',
        'id_detalle_concepto' => 'integer',
        'debe' => 'decimal:2',
        'haber' => 'decimal:2',
        'concepto_detallado' => 'string',
        'id_rubro' => 'integer',
        'id_asiento' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_detalle_concepto' => 'nullable|integer',
        'debe' => 'nullable|numeric',
        'haber' => 'nullable|numeric',
        'concepto_detallado' => 'nullable|string|max:45',
        'id_rubro' => 'required|integer',
        'id_asiento' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idRubro()
    {
        return $this->belongsTo(\App\Models\Rubro::class, 'id_rubro');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idAsiento()
    {
        return $this->belongsTo(\App\Models\Asiento::class, 'id_asiento');
    }
}
?>