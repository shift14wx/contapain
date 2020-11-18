<template>
   <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                   Estado de Resultado
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>

                        <v-container>
                            <v-row>
                              <v-col>
                                 <v-simple-table >
                                    <template v-slot:default>
                                       <thead>
                                       <tr>
                                          <th colspan="3" class="text-center">
                                             {{company}}<br/>
                                             Estados de resultado <br/>
                                             del primero de Enero al 31 de diciembre del {{year}}
                                          </th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td class="font-weight-black">Ventas</td>
                                             <td></td>
                                             <td class="font-weight-black"> ${{totalDeVentas.toFixed(2)}}</td>
                                          </tr>
                                          <tr>
                                             <td class="grey--text">Total de Ventas: &nbsp; ${{ totalDeVentas.toFixed(2) }}</td>
                                          </tr>
                                          <tr>
                                             <td>menos:</td>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                          <tr>
                                             <td class="font-weight-black">Costo de Ventas</td>
                                             <td></td>
                                             <td class="font-weight-black"> 
                                                ${{totalCostosDeVentas.toFixed(2)}}
                                                <hr style="background-color:black;"/>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="grey--text">Total de Costo de Ventas: &nbsp; ${{totalCostosDeVentas.toFixed(2)}}</td>
                                          </tr>
                                          <tr>
                                             <td class="font-weight-black">utilidad Bruta</td>
                                             <td></td>
                                             <td class="font-weight-black"> 
                                                  ${{ utilidadBruta }}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>menos:</td>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                          <tr>
                                             <td class="font-weight-black"> Gastos de Operacion </td>
                                             <td></td>
                                             <td class="font-weight-black"> ${{ gastosDeOperacionTotal }} </td>
                                          </tr>
                                          <!--GASTOS DE ADMINISTRACION-->
                                          <tr v-if="operacioGastosAdministracion.length > 0">
                                             <td >Gastos de Administracion  <br/> <hr/></td>
                                             <td>${{ totalGastosDeAdministracion }}</td>
                                          </tr>
                                          <tr v-if="operacioGastosAdministracion.length > 0" v-for="( gasto, index ) in operacioGastosAdministracion" :key="'gastosOperacion'+index">
                                             <td>{{gasto["titulo"]}}</td>
                                             <td>${{ totalPorCuenta( gasto["registros"] ) }}</td>
                                             <td></td>
                                          </tr>
                                          <tr  v-if="operacioGastosAdministracion.length > 0">
                                             <td class="grey--text">total de Gastos de Administración: &nbsp; ${{ totalGastosDeAdministracion }}</td>
                                          </tr>
                                          <!--GASTOS DE VENTA-->
                                          <tr v-if="operacionGastosDeVenta.length > 0">
                                             <td>Gastos de Venta <br/> <hr/></td>
                                             <td></td>
                                             <td>${{ totalGastosDeVenta }}</td>
                                          </tr>
                                          <tr v-if="operacionGastosDeVenta.length > 0" v-for="( gasto, index ) in operacionGastosDeVenta" :key="'gastosdeventa'+index">
                                              <td>{{gasto["titulo"]}}</td>
                                             <td>${{ totalPorCuenta( gasto["registros"] ) }}</td>
                                             <td></td>
                                          </tr>
                                          <tr v-if="operacionGastosDeVenta.length > 0">
                                             <td class="grey--text">Total de Gastos de Ventas: &nbsp; ${{ totalGastosDeVenta }}</td>
                                          </tr>
                                          <!--GASTOS DE REBAJA Y DEVOLUCIONES SOBRE VENTAS-->
                                          <tr v-if="operacionesRebajaYDevolucionesSobreVentas.length > 0">
                                             <td >Rebaja y devolución sobre las ventas <br/> <hr/></td>
                                             <td></td>
                                             <td>${{ totalRebajayDevolucionSobreVenta }}</td>
                                          </tr>
                                          <tr v-if="operacionesRebajaYDevolucionesSobreVentas.length > 0" v-for="( gasto, index ) in operacionesRebajaYDevolucionesSobreVentas" :key="'rebaja'+index">
                                             <td>{{gasto["titulo"]}}</td>
                                             <td>${{ totalPorCuenta( gasto["registros"] ) }}</td>
                                             <td></td>
                                          </tr>

                                          <tr v-if="operacionesRebajaYDevolucionesSobreVentas.length > 0">
                                             <td class="grey--text">Total de Rebaja y devoluciones sobre Ventas: &nbsp; ${{ totalRebajayDevolucionSobreVenta }}</td>
                                          </tr>
                                          <!--DESCUENTOS SOBRE VENTA-->
                                          <tr v-if="operacionDescuentoSobreVentas.length > 0">
                                             <td>Descuento Sobre Ventas <br/> <hr/></td>
                                             <td></td>
                                             <td>{{ totalDescuentoSobreVentas }}</td>
                                          </tr>
                                          <tr v-if="operacionDescuentoSobreVentas.length > 0" v-for="( gasto, index ) in operacionDescuentoSobreVentas" :key="'descuentos'+index">
                                             <td>{{gasto["titulo"]}}</td>
                                             <td>{{ totalPorCuenta( gasto["registros"] ) }}</td>
                                             <td></td>
                                          </tr>
                                          <tr v-if="operacionDescuentoSobreVentas.length > 0">
                                             <td>Total de Descuentos sobre Ventas: &nbsp; ${{ totalDescuentoSobreVentas }}</td>
                                          </tr>
                                          <tr>
                                             <td class="font-weight-black">Utilidad de Operación</td>
                                             <td></td>
                                             <td class="font-weight-black"> {{ ( utilidadBruta -gastosDeOperacionTotal ).toFixed(2) }} </td>
                                          </tr>
 
                                          <tr>
                                             <td class="font-weight-black">Otros gastos y/o Productos</td>
                                             <td></td>
                                             <td class="font-weight-black"> ${{ (otrosGastosTotal + otrosProductostotal).toFixed(2) }} </td>
                                          </tr>

                                          <tr>
                                             <td>Otros Productos</td>
                                             <td>${{ otrosProductostotal.toFixed(2) }}</td>
                                          </tr>

                                          <tr>
                                             <td>Otros Gastos</td>
                                             <td>${{ otrosGastosTotal.toFixed(2) }}</td>
                                          </tr>

                                          <tr>
                                             <td class="font-weight-black">Utilidad antes de impuesto y reserva (UAIR)</td>
                                             <td></td>
                                             <td class="font-weight-black"><hr/> <br/> ${{ ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ).toFixed(2) }}</td>
                                          </tr>
                                          <tr>
                                             <td class="grey--text">Total de Otros Gastos y/o Productos: &nbsp; ${{ (otrosGastosTotal+ otrosProductostotal).toFixed(2)}}</td>
                                          </tr>
                                          <tr>
                                             <td>menos:</td>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                          <tr>
                                             <td class="font-weight-black">Reserva legal (7% * Utilidad antes de impuesto + reserva (UAIR))</td>
                                             <td></td>
                                             <td class="font-weight-black"> ${{ ( 0.07 * ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) ).toFixed(2) }} </td>
                                          </tr>

                                          <tr>
                                             <td class="font-weight-black">Utilidad antes de impuesto (UAI)</td>
                                             <td></td>
                                             <td class="font-weight-black"><hr/><br/>${{( ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) -  ( 0.07 * ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) ) ).toFixed(2)}} </td>
                                          </tr>

                                          <tr>
                                             <td>menos:</td>
                                             <td></td>
                                             <td></td>
                                          </tr>

                                          <tr>
                                             <td class="font-weight-black">ISR ( 30% * Utilidad antes de impuesto (UAI) )</td>
                                             <td></td>
                                             <td class="font-weight-black">

                                                {{ ( ( ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) -  ( 0.07 * ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) ) ) * 0.3).toFixed(2) }}

                                             </td>
                                          </tr>

                                          <tr>
                                             <td class="font-weight-black">Utilidad del ejercicio</td>
                                             <td></td>
                                             <td class="font-weight-black"><hr/> <br/> ${{ ( ( ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) -  ( 0.07 * ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) ) ) - ( ( ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) -  ( 0.07 * ( ( utilidadBruta -gastosDeOperacionTotal ) - ( otrosGastosTotal + otrosProductostotal ) ) ) ) * 0.3) ) .toFixed(2) }} </td>
                                          </tr>

                                       </tbody>
                                    </template>
                                 </v-simple-table>
                              </v-col> 
                            </v-row>
                        </v-container>
                    </div>
                </div>
            </div>
   </app-layout>
                                    
</template>

<script>
import AppLayout from "../../../Layouts/AppLayout";
export default {
   props:["ventas","parsedRegistros","otrosGastos","otrosGastosTotal","otrosProductostotal","otrosProductos","gastosOperativos","totalDeVentas","company","year","totalCostosDeVentas", "totalGastosDeAdministracion","totalGastoDeOperacion","totalGastosDeVenta","totalRebajayDevolucionSobreVenta","totalDescuentoSobreVentas", "gastosDeOperacion","operacioGastosAdministracion","operacionGastosDeVenta","operacionesRebajaYDevolucionesSobreVentas","operacionDescuentoSobreVentas"],
 components:{
        AppLayout,
    },   
    methods:{
       totalPorCuenta( registros ){

          let carry = 0.0; 
          registros.forEach(registroDeVenta => {
             console.log( registroDeVenta["debeRubro"]);
           if( parseFloat(registroDeVenta["debe"]) > 0.0 && registroDeVenta["debeRubro"] ==1 ){
                     carry += parseFloat( registroDeVenta["debe"] );
               }else if( parseFloat(registroDeVenta["debe"]) > 0.0 && registroDeVenta["debeRubro"] == 0 ){
                     carry -= parseFloat(registroDeVenta["debe"] );
               } else if( parseFloat( registroDeVenta["haber"] ) > 0.0 && registroDeVenta["haberRubro"] == 1 ){
                     carry += parseFloat( registroDeVenta["haber"] );
               }else if ( parseFloat( registroDeVenta["haber"] ) > 0.0 && registroDeVenta["haberRubro"] == 0 ){
                     carry -= parseFloat( registroDeVenta["haber"] );
               }  
          });
          return carry.toFixed( 2 );
       }
    },
   computed:{
      utilidadBruta(){
         return ( parseFloat( this.totalDeVentas - this.totalCostosDeVentas ).toFixed(2) );
      },
      gastosDeOperacionTotal(){
         return ( this.totalGastoDeOperacion + this.totalGastosDeAdministracion + this.totalGastosDeVenta+ this.totalRebajayDevolucionSobreVenta + this.totalDescuentoSobreVentas ).toFixed(2);
      }
   }
}
</script>