<template>
    <v-container>
        <v-row v-for="( asiento, index ) in asientos" :key="index">
            <v-col cols="12">
                
                        <v-data-table
                            :headers="headers"
                            :items="asiento.registros"
                            sort-by="id"
                            class="elevation-1"
                        >
                            <template v-slot:top>
                                <v-toolbar
                                    flat
                                >
                                    <v-toolbar-title>Registros de Asiento con id {{ asiento.id_asiento }} del {{asiento.fecha_inicio}}</v-toolbar-title>
                                    <v-divider
                                        class="mx-4"
                                        inset
                                        vertical
                                    ></v-divider>
                                    <v-spacer></v-spacer>
                                            <v-btn
                                                color="success"
                                                dark
                                                class="mb-2"
                                                @click="goTo(asiento.id_asiento)"
                                            >
                                            <v-icon> mdi-pencil </v-icon> &nbsp;
                                                Editar Asiento
                                            </v-btn>
                                </v-toolbar>
                            </template>

                            <!--

                                DEBE  HABER CAMPOS
                            -->
                            <template v-slot:item.debe="{ item }">
                                <v-chip
                                class="ma-2"
                                color="green"
                                text-color="white"
                                v-if="showCorrectDebeHaber(item.id_detalle_concepto,'debe')"
                                >
                                ${{item.debe}}
                                </v-chip>

                                 <v-chip
                                 v-else
                                class="ma-2"
                                color="red"
                                text-color="white"
                                >
                                -${{item.debe}}
                                </v-chip>
                            </template>

                             <template v-slot:item.haber="{ item }">
                                <v-chip
                                class="ma-2"
                                color="green"
                                text-color="white"
                                v-if="showCorrectDebeHaber(item.id_detalle_concepto,'haber')"
                                >
                                ${{item.haber}}
                                </v-chip>

                                 <v-chip
                                 v-else
                                class="ma-2"
                                color="red"
                                text-color="white"
                                >
                                -${{item.haber}}
                                </v-chip>
                            </template>
                            <template v-slot:no-data>
                                no hay registros
                            </template>
                        </v-data-table>

                        <!--TOTALES-->
                        <v-simple-table>
                            <template v-slot:default>
                            <thead>
                                <tr>
                                <th class="text-left">
                                </th>
                                <th class="text-left">
                                    Debe
                                </th>
                                <th class="text-left">
                                    Haber
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="d-none">
                                    {{ calcTotalesDebe( index ) }}
                                    {{ calcTotalesHaber( index ) }}
                                </div>
                                <tr
                                class="white--text"
                                :class="{ 'red darken-4': (totalDebe[index] != totalHaber[index]), 'light-blue accent-4' : (totalDebe[index] == totalHaber[index] && ( totalDebe[index]>=0.0 && totalHaber[index] >= 0.0 ) ), 'yellow accent-2' :(totalDebe[index] == totalHaber[index] && ( totalDebe[index]<0.0 && totalHaber[index] < 0.0 ) ) }"
                                >
                                <td><b>Total</b></td>
                                <td> ${{ totalDebe[index] }} </td>
                                <td> ${{ totalHaber[index] }} </td>
                                </tr>
                            </tbody>
                            </template>
                        </v-simple-table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    props: [ "asientos", "catalogo_cuentas" ],
    data(){
        return{
            totalDebe : [],
            totalHaber : [],
            catalogo: this.catalogo_cuentas,
             headers: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: true,
                    value: 'id_registro',
                },
                { text: 'Detalle o concepto', value: 'titulo' },
                { text: 'Debe', value: 'debe' },
                { text: 'Haber', value: 'haber' },
                { text: 'Concepto Detallado', value: 'concepto_detallado' },
                { text: 'Acciones', value: 'actions', sortable: false },
            ],

        }
    },
    methods:{
        goTo(id = null){
            if(id){
                window.location.href = `/contapain/asientos/${id}/registros`;
            }
        },
        showCorrectDebeHaber(idConcepto, tipo){
            let concepto = this.catalogo.find( ( catalogo ) => catalogo.id == idConcepto );
            return concepto[tipo];
        },
        calcTotalesDebe( index ){
            let debe = 0.0;            
            this.asientos[index].registros.forEach(registro => {
                /** DEBE */
                if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"debe") ){ // se suma
                    debe += parseInt( registro.debe );
                }else{ // se resta
                    debe -= parseInt( registro.debe );
                }
            });
            this.totalDebe[index] = debe;
        },
        calcTotalesHaber( index ){
            let haber = 0.0;
            this.asientos[index].registros.forEach(registro => {
                /** HABER */
                 if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"haber") ){ // se suma
                    haber += parseInt( registro.haber );
                }else{ // se resta
                    haber -= parseInt( registro.haber );
                }
            });
            this.totalHaber[index] = haber;
        }

    }
}
</script>