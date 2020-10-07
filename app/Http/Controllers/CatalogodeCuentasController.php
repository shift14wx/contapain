<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Rubro;
use App\Models\SubCategoriasPadre;
use App\Models\SubRubrosHijo;
use App\Models\SubRubrosPadre;
use Illuminate\Http\Request;

class CatalogodeCuentasController extends Controller
{
    public function storeByJson( Request $request )
    {
        
        $catalogo = $request->only("catalogo")["catalogo"];

        foreach ( $catalogo as $index => $catalogo ) {

            $catalogoCollection = collect( $catalogo );

            $tabla = $catalogoCollection->get('tabla');

            $objectWhitTable = $catalogoCollection->only("titulo", "tabla", "id_$tabla", "haber", "debe" );

            $this->insertInRepectiveTable( $objectWhitTable );

            $id = $catalogoCollection->get("id_$tabla");

            if( $catalogoCollection->has( "subrubro" ) )
            {
                $this->storerubro( $catalogoCollection->get( "subrubro" ), $id, $catalogoCollection->get( "tabla" ) );
            }

        }

    }

    public function storerubro( array $subrubro, int $idRubro, string $nombreTabla )
    {
        
        foreach ( $subrubro as $index => $catalogo ) {

            $catalogoCollection = collect( $catalogo );

            $tabla = $catalogoCollection->get('tabla');

            $objectWhitTable = $catalogoCollection->only("titulo", "tabla", "id_$tabla");

            /**
             * esta verificacionn es debido a que la tabla categorias tiene su id como id_categorias y en sub_categorias_padre la 
             * llave foranea esta como id_categoria, y como tomamos el nombre de la tabla se pasa a singular para ello
             */
            if( $nombreTabla == "categorias" )
            {
                $nombreTabla = "categoria";
            }

            $objectWhitTable->prepend( $idRubro, "id_$nombreTabla" );

            $this->insertInRepectiveTable( $objectWhitTable );

            
            
            $id = $catalogoCollection->get("id_$tabla");

            if($id==null){
                dd($catalogoCollection->all());
            }

            if( $catalogoCollection->has( "subrubro" ) )
            {
                $this->storerubro( $catalogoCollection->get( "subrubro" ), $id, $tabla );
            }

        }

    }

    /**
     * ver a que tabla pertenece el objeto a almacenar
     * @return void
     * retornara el id del objeto almacenado
     * @param Illuminate\Support\Collection $object
     */

     public function insertInRepectiveTable( $object ) : void
     {
         $saved = [];
         $model = null;

         switch ( strtolower( $object->get("tabla") ) ) {
             case 'rubro':
                    $model = new Rubro();
                    $realObject = $object->except("tabla");
                    $realObject = $realObject->all();
                    $model->updateOrCreate(  $realObject , $realObject );
                 break;
                 case 'sub_rubro_padre':
                    $model = new SubRubrosPadre();
                 break;
                 case 'sub_rubro_hijo':
                    $model = new SubRubrosHijo();
                 break;
                 case 'categorias':
                    $model = new Categoria();
                 break;
                 case 'sub_categorias_padre':
                    $model = new SubCategoriasPadre();
                 break;
             
             default:
                break;
         }

         if( $model!=null && strtolower( $object->get("tabla") ) != "rubro" ){
            $realObject = $object->except("tabla");
            $realObject = $realObject->all();
            $model->updateOrCreate(  $object->only("titulo")->toArray() , $realObject );
           
         }

     }
}
