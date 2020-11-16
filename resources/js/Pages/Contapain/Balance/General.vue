<template>

<div>
    <mayorizacion :parsedRegistros="parsedRegistros" :month="monthIn" :anually="true" @dataSet="catchDataSet" :titleProp="'Información General'" />

<!---BALANCE GENERAL-->
<v-app v-if="dataset">
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
                            <th rowspan="2" class="text-center">Detalles</th>
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
                                <td colspan="2" class="font-weight-black">Activo Corriente</td>
                                <td class="font-weight-black"> ${{ activoCorrienteTotal }} </td>
                           </tr> 
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 1"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                           <tr>
                                <td colspan="2" class="font-weight-black">Activo no Corriente</td>
                                <td class="font-weight-black"> ${{ activoNoCorrienteTotal }} </td>
                           </tr> 
                           <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 2"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-black">Pasivo Corriente</td>
                                <td class="font-weight-black"> ${{ pasivoCorrienteTotal }} </td>
                            </tr>
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 3"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-black">Pasivo no Corriente</td>
                                <td class="font-weight-black"> ${{ pasivoNoCorrienteTotal }} </td>
                            </tr>
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 4"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-black">Patrimonio</td>
                                <td class="font-weight-black"> ${{ patrimonioTotal }} </td>
                            </tr>
                            <tr>
                            <td colspan="2" class="font-weight-black"> patrimonio contribuido </td>
                            <tr>
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 5"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                            <tr>
                            <td colspan="2" class="font-weight-black"> patrimonio ganado </td>
                            <tr>
                            <tr
                            v-for="(rubro, index) in registros"
                            :key="'rubroRegistroActCorr'+index"
                            v-if="rubro.id_clasificacion == 6"
                            >
                            <td>{{ rubro.titulo }}</td>
                            <td class="text-center">{{ haberOdeber( index ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-black"> Total Pasivo + Patrimonio</td>
                                <td class="font-weight-black"> ${{ ( pasivoCorrienteTotal+pasivoNoCorrienteTotal+patrimonioTotal ).toFixed(2) }} </td>
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
        },
        haberOdeber( index ){
            var debeOhaber = parseFloat( this.dataset.totales[index].debe ) || parseFloat( this.dataset.totales[index].haber );
            return "$"+debeOhaber.toFixed(2)
        }
    },
    mounted(){
        console.log("done");
    },
    computed:{
        activoCorrienteTotal(){
            if(this.dataset){
                var activosCorrientes = this.dataset.totales.filter( ( results,index )=> this.registros[index].id_clasificacion == 1 );
                return activosCorrientes.length > 0 ? activosCorrientes.reduce( (a,b)=> [ ( parseFloat(a.debe) || parseFloat(a.haber) ) ] + [ ( parseFloat(b.haber) || parseFloat(b.debe) ) ] ).toFixed(2) : 0.0
            }else{
                return null;
            }
        },
        activoNoCorrienteTotal(){
            if(this.dataset){
                var activosCorrientes = this.dataset.totales.filter( ( results,index )=> this.registros[index].id_clasificacion == 2 );
                return activosCorrientes.length > 0 ? activosCorrientes.reduce( (a,b)=> [ ( parseFloat(a.debe) || parseFloat(a.haber) ) ] + [ ( parseFloat(b.haber) || parseFloat(b.debe) ) ] ).toFixed(2) : 0.0
            }else{
                return null;
            }
        },
        pasivoCorrienteTotal(){
            if(this.dataset){
                var activosCorrientes = this.dataset.totales.filter( ( results,index )=> this.registros[index].id_clasificacion == 3 );
                return activosCorrientes.length > 0 ? activosCorrientes.reduce( (a,b)=> [ ( parseFloat(a.debe) || parseFloat(a.haber) ) ] + [ ( parseFloat(b.haber) || parseFloat(b.debe) ) ] ).toFixed(2) : 0.0
            }else{
                return null;
            }
        },
        pasivoNoCorrienteTotal(){
            if(this.dataset){
                var activosCorrientes = this.dataset.totales.filter( ( results,index )=> this.registros[index].id_clasificacion == 4 );
                return activosCorrientes.length > 0 ? activosCorrientes.reduce( (a,b)=> [ ( parseFloat(a.debe) || parseFloat(a.haber) ) ] + [ ( parseFloat(b.haber) || parseFloat(b.debe) ) ] ).toFixed(2) : 0.0
            }else{
                return null;
            }
        },
        patrimonioTotal(){
            if(this.dataset){
                var activosCorrientes = this.dataset.totales.filter( ( results,index )=> this.registros[index].id_clasificacion > 4 );
                return activosCorrientes.length > 0 ? activosCorrientes.reduce( (a,b)=> [ ( parseFloat(a.debe) || parseFloat(a.haber) ) ] + [ ( parseFloat(b.haber) || parseFloat(b.debe) ) ] ).toFixed(2) : 0.0
            }else{
                return null;
            }
        }


    }

}

</script>