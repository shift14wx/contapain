<template>
    <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mayorización y mas informacion del mes de 
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>

                        <v-container>
                            <v-row>
                                <v-col v-for="( rubro, index ) in rubros_registro" :key="index" lg="4" md="6" sm="6" xs="12">
                                    <v-card>
                                        <v-card-title>{{rubro.titulo}}</v-card-title>
                                        <v-card-subtitle> {{ rubro.id_detalle_concepto }} </v-card-subtitle>
                                        <v-card-text>
                                             <v-simple-table dark>
                                                <template v-slot:default>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">id asiento</th>
                                                    <th class="text-center">
                                                        Debe
                                                    </th>
                                                    <th class="text-center">
                                                        Haber
                                                    </th>
                                                        <th class="text-center">id asiento</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                    v-for="(registro, indexRegistro) in rubro.registros"
                                                    :key="registro.id_registro"
                                                    :class="{'d-none':( noMostrar == registro.id_registro )}"
                                                    >
                                                    <td>
                                                        <v-btn
                                                        @click="goTo(index, indexRegistro,'debe')"
                                                        :id="`debe${index}${indexRegistro}`"
                                                        >
                                                            {{ ( registro.debe > 0 ) ? registro.id_asiento : proximoDebe( index, indexRegistro ) }}
                                                        </v-btn>
                                                    </td>
                                                    <td > {{ ( registro.debe > 0 ) ? "$"+registro.debe : deferDebe }}
                                                        </td>
                                                    <td > {{( registro.haber > 0 ) ? "$"+registro.haber : proximoHaber( index, indexRegistro ) }}</td>
                                                    <td >
                                                        <v-btn
                                                        @click="goTo(index, indexRegistro,'haber')"
                                                        :id="`haber${index}${indexRegistro}`"
                                                        >{{ ( registro.haber > 0 ) ? registro.id_asiento : deferHaber }}
                                                        </v-btn>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Totales</td>
                                                        <td ></td>
                                                        <td ></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                </template>
                                            </v-simple-table>
                                        </v-card-text>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>

                    </div>
                </div>
            </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
    props:["parsedRegistros"],
    data(){
        return{
            "rubros_registro" : this.parsedRegistros,
            "noMostrar" : 0,
            "deferDebe": "",
            "deferHaber": ""

        }
    },
    components:{
        AppLayout,
    },
    methods:{
        goTo(rubro, registro, tipo){
            console.log( `#${tipo}${rubro}${registro}` );
            let idAsiento = parseInt(document.querySelector(`#${tipo}${rubro}${registro}`).textContent);
            this.$inertia.visit(`/contapain/asientos/${idAsiento}/registros`).then(()=>{

            });
        },
        proximoDebe( indexRubro, indexRegistro ){
            try {
                let debe = this.rubros_registro[indexRubro].registros.find( (registro,index) => {
                if( index > indexRegistro && registro.debe > 0 ){ // nos aseguramos de que sea mayor al index que estamos pintando osea el current haber y que el debe sea mayor a cero
                return registro; // retornamos el debe de este registro del current rubro
                }
            });

            if( debe != undefined && debe.hasOwnProperty( "debe" ) ){
                this.noMostrar = debe.id_registro;
                let debeCopy = Object.assign({},debe);
                this.deferDebe = "$"+debeCopy.debe;
                return debeCopy.id_asiento;
            }else{
                
                this.deferDebe = "";
                return "";
            }
            } catch (error) {
                console.log(error);
            }
            
        },
        proximoHaber( indexRubro, indexRegistro ){
            try {
                let haber = this.rubros_registro[indexRubro].registros.find( (registro,index) => {
                if( index > indexRegistro && registro.haber > 0 ){ // nos aseguramos de que sea mayor al index que estamos pintando osea el current haber y que el debe sea mayor a cero
                return registro; // retornamos el debe de este registro del current rubro
                }
            });

            if( haber != undefined && haber.hasOwnProperty( "haber" ) ){
                let haberCopy = Object.assign({},haber);
                this.deferHaber = "$"+debeCopy.haber;
                return haberCopy.id_asiento;
            }else{
                this.deferHaber = "";
                return "";
            }
            } catch (error) {
                console.log(error);
            }
            
        },
        deleteRegistroFromRubro( indexRubro, id_registro ){
            // no se utiliza esta funci
           this.rubros_registro[indexRubro].registros = this.rubros_registro[indexRubro].registros.filter( ( reg )=>{ return reg.id_registro != id_registro } );
            return true;
        }
    }
}
</script>