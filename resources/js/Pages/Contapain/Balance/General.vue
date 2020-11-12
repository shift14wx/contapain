<template>

<div>
    <mayorizacion :parsedRegistros="parsedRegistros" :month="monthIn" :anually="true" @dataSet="catchDataSet" :titleProp="'Información General'" />

<!---BALANCE GENERAL-->
<v-app>
<v-container>
    <v-row>
        <v-col>
            <v-card>
                <v-card-title>Balance General</v-card-title>
                <v-card-subtitle>  </v-card-subtitle>
                <v-card-text>

                    <v-simple-table id="balanceGeneral">
                        <template v-slot:default>
                        <thead>
                        <tr>
                            <th>Detalle</th>
                            <th colspan="2" class="text-center deep-purple darken-4 white--text">Sumas</th>
                        </tr>
                        </thead>
                        <tbody>
                                <tr>
                            <th class="text-center"></th>
                            <th class="text-center indigo darken-4 white--text">Parcial</th>
                                <th class="text-center indigo darken-4 white--text">Total</th>
                            </tr>
                           <tr>
                                <td colspan="3" class="font-weight-black">Activo Corriente</td>
                           </tr> 
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistro'+index"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td>{{ rubro.id_detalle_concepto }}</td>
                            </tr>
                           <tr>
                                <td colspan="3" class="font-weight-black">Activo no Corriente</td>
                           </tr> 
                            <tr>
                                <td colspan="3" class="font-weight-black">Activo no Corriente</td>
                           </tr>
                            <tr>
                                <td colspan="3" class="font-weight-black">Pasivo Corriente</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="font-weight-black">Pasivo no Corriente</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="font-weight-black">Patrimonio</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="font-weight-black"> Total Pasivo + Patrimonio</td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</v-container>
</v-app>
</div>

</template>

<script>

import AppLayout from "../../../Layouts/AppLayout";
import Input from "../../../Jetstream/Input";
import mayorizacion from "../Mayorizacion";
export default{
    props:["parsedRegistros","month"],
    data(){
        return{
            "registros": this.parsedRegistros,
            "monthIn" : this.month,
            "dataset" : null
        }
    },
    components:{
        AppLayout,
        Input,
        mayorizacion
    },
    methods:{
        // una vez el componente mayorizacion termine de realizar todas las tareas necesarias para armar el balance de comprobacion, entonces enviara los datos a este componente parsedRegistros
        // asin se podra hacer el balance general en este componente
        catchDataSet(val){
            this.dataset = val;
            console.log("info:",val);      
        }
    },
    mounted(){
        console.log("done");
    }

}

</script>