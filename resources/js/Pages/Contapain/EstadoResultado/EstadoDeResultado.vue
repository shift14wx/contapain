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
                                             <td class="font-weight-black">${{totalDeVentas.toFixed(2)}}</td>
                                          </tr>
                                          <tr>
                                             <td>menos</td>
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
                                             <td class="font-weight-black">utilidad Bruta</td>
                                             <td></td>
                                             <td class="font-weight-black"> 
                                                  ${{ ( parseFloat( totalDeVentas - totalCostosDeVentas ).toFixed(2) ) }}
                                             </td>
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
   props:["ventas","parsedRegistros","otrosGastos","otrosProductos","gastosOperativos","totalDeVentas","company","year","totalCostosDeVentas"],
 components:{
        AppLayout,
    },   
}
</script>