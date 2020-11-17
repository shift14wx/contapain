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
                                 <v-simple-table dark>
                                    <template v-slot:default>
                                       <thead>
                                       <tr>
                                          <th class="text-left">
                                             
                                          </th>
                                          <th class="text-left">
                                             Calories
                                          </th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       <tr>

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
   props:["ventas","parsedRegistros","otrosGastos","otrosProductos","gastosOperativos"],
 components:{
        AppLayout,
    },   
}
</script>