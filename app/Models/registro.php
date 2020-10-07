<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class registro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ["titulo"];

    protected $guarded =[];

    protected $table="registro";
    protected $primaryKey = 'id_registro';

    private $tablas = [
        "Rubro",
        "SubRubrosPadre",
        "SubRubrosHijo",
        "Categoria",
        "SubCategoriasPadre"
    ];

    public function Asiento()
    {
        return $this->belongsTo(Asiento::class, 'id_asiento');
    }

    public function getTituloAttribute()
    {
        $titulo = null;
            foreach ($this->tablas as $key => $tabla)
            {
                    $tablaAConsultar = app()->make("App\Models\\".$tabla);
                    $objeto = $tablaAConsultar->find($this->id_detalle_concepto);
                    if($objeto!=null){
                        $objeto = $objeto->toArray();   
                    if( is_array( $objeto ) && array_key_exists( "titulo", $objeto ) ){
                        $titulo = $objeto["titulo"];
                    }
                    }
            }
        return $this->attributes["titulo"] = $titulo;
    }

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_detalle_concepto'=> 'required',
        'debe' => 'required',
        'haber'=> 'required',
        'id_rubro'=> 'required',
        'id_asiento' => 'required'
    ];

}
