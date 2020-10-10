<?php

namespace App\Models;

use App\Http\Controllers\AsientosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class registro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ["titulo","debeRubro","haberRubro"];

    protected $guarded =[];

    protected $table="registro";
    protected $primaryKey = 'id_registro';

    private $tablas = [
        "Rubro",
        "SubRubrosPadre",
        "SubRubrosHijo",
        "Categoria",
        "SubCategoriasPadre",
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

        /*$rubro = DB::table("Rubros")
        ->join("sub_rubros_padre","Rubros.id_rubro","=","sub_rubros_padre.id_rubro")
        ->join("sub_rubros_hijo","sub_rubros_padre.id_sub_rubro_padre","=","sub_rubros_hijo.id_sub_rubro_padre")
        ->join("categorias","categorias.id_sub_rubro_hijo","=","sub_rubros_hijo.id_sub_rubro_hijo")
        ->join("sub_categorias_padre","sub_categorias_padre.id_categoria","=","categorias.id_categorias")
        ->select('Rubros.titulo')
        ->where( "Rubros.id_rubro", "=", $this->id_detalle_concepto )
        ->orWhere( "sub_rubros_padre.id_sub_rubro_padre", "=", $this->id_detalle_concepto )
        ->orWhere( "sub_rubros_hijo.id_sub_rubro_hijo", "=", $this->id_detalle_concepto )
        ->orWhere( "categorias.id_categorias", "=", $this->id_detalle_concepto )
        ->orWhere( "sub_categorias_padre.is_sub_categoria_padre", "=", $this->id_detalle_concepto )
        ->toSql();*/
        return $this->attributes["titulo"] = $titulo;
    }

    public function getHaberRubroAttribute()
    {

        return $this->attributes["haberRubro"] = Rubro::find( $this->id_rubro )->toArray()["haber"];
        
    }

    public function getDebeRubroAttribute()
    {
        return $this->attributes["debeRubro"] = Rubro::find( $this->id_rubro )->toArray()["debe"];
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
