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
                while ( $titulo== null )
                {
                    $tablaAConsultar = app()->make("App\Models\\".$tabla);
                    $objeto = $tablaAConsultar->find($this->id_detalle_concepto)->toArray();
                    if( is_array( $objeto ) && array_key_exists( "titulo", $objeto ) ){
                        $titulo = $objeto["titulo"];
                    }
                }

            }
        return $this->attributes["titulo"] = $titulo;
    }

}
