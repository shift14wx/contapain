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
                                color="grey darken-2"
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
                                color="grey darken-2"
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
                                :class="{ 'red darken-4': (totalDebe[index] != totalHaber[index]), 'light-blue accent-4' : (totalDebe[index] == totalHaber[index] && ( totalDebe[index]>=0.0 && totalHaber[index] >= 0.0 ) ), 'orange darken-4' :(totalDebe[index] == totalHaber[index] && ( totalDebe[index]<0.0 && totalHaber[index] < 0.0 ) ) }"
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
        <v-row>
            <v-col  cols="12">
                <v-card
                :color="'#1F7087'"
                dark
                >
                    <div class="">
                        <div>
                            <v-card-title
                            class="headline"
                            v-text="'Total del mes de '+fecha.format('MMMM')"
                            ></v-card-title>

                            <v-card-subtitle v-text="'Asientos de este mes '"></v-card-subtitle>
                                <v-card-text>
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
                                            {{ calcTotalesDebeNeto() }}
                                            {{ calcTotalesHaberNeto() }}
                                        </div>
                                        <tr
                                        class="white--text"
                                        :class="{ 'red darken-4': (totalDebeNeto != totalHaberNeto), 'light-blue accent-4' : (totalDebeNeto == totalHaberNeto && ( totalDebeNeto>=0.0 && totalHaberNeto >= 0.0 ) ), 'orange darken-4' :(totalDebeNeto == totalHaberNeto && ( totalDebeNeto<0.0 && totalHaberNeto < 0.0 ) ) }"
                                        >
                                        <td><b>Totales</b></td>
                                        <td> ${{ totalDebeNeto }} </td>
                                        <td> ${{ totalHaberNeto }} </td>
                                        </tr>
                                    </tbody>
                                    </template>
                                    </v-simple-table>
                                </v-card-text>
                        </div>
                    </div>
                </v-card>
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
            totalDebeNeto: 0.0,
            totalHaberNeto: 0.0,
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
        momentSetLocale(){
            moment.locale('es', {
                months : 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
                monthsShort : 'Ene._Feb._Mar_Abr._May_Jun_Jul._Agost_Sept._Oct._Nov._Dec.'.split('_'),
                monthsParseExact : true,
                weekdays : 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort : 'Dom._Lun._Mar._Mir._Jue._Vie._Sab.'.split('_'),
                weekdaysMin : 'Di_Lu_Ma_Mi_Ju_Vi_Sa'.split('_'),
                weekdaysParseExact : true,
                longDateFormat : {
                    LT : 'HH:mm',
                    LTS : 'HH:mm:ss',
                    L : 'DD/MM/YYYY',
                    LL : 'D MMMM YYYY',
                    LLL : 'D MMMM YYYY HH:mm',
                    LLLL : 'dddd D MMMM YYYY HH:mm'
                },
                calendar : {
                    sameDay : '[Aujourd’hui à] LT',
                    nextDay : '[Demain à] LT',
                    nextWeek : 'dddd [à] LT',
                    lastDay : '[Hier à] LT',
                    lastWeek : 'dddd [dernier à] LT',
                    sameElse : 'L'
                },
                relativeTime : {
                    future : 'dans %s',
                    past : 'il y a %s',
                    s : 'quelques secondes',
                    m : 'une minute',
                    mm : '%d minutes',
                    h : 'une heure',
                    hh : '%d heures',
                    d : 'un jour',
                    dd : '%d jours',
                    M : 'un mois',
                    MM : '%d mois',
                    y : 'un an',
                    yy : '%d ans'
                },
                dayOfMonthOrdinalParse : /\d{1,2}(er|e)/,
                ordinal : function (number) {
                    return number + (number === 1 ? 'er' : 'e');
                },
                meridiemParse : /PD|MD/,
                isPM : function (input) {
                    return input.charAt(0) === 'M';
                },
                // In case the meridiem units are not separated around 12, then implement
                // this function (look at locale/id.js for an example).
                // meridiemHour : function (hour, meridiem) {
                //     return /* 0-23 hour, given meridiem token and hour 1-12 */ ;
                // },
                meridiem : function (hours, minutes, isLower) {
                    return hours < 12 ? 'PD' : 'MD';
                },
                week : {
                    dow : 1, // Monday is the first day of the week.
                    doy : 4  // Used to determine first week of the year.
                }
            });
        },
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
                    debe += parseFloat( registro.debe );
                /** DEBE */
                /*if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"debe") ){ // se suma
                    debe += parseFloat( registro.debe );
                }else{ // se resta
                    debe -= parseFloat( registro.debe );
                }*/
            });
            this.totalDebe[index] = debe.toFixed(2);
        },
        calcTotalesHaber( index ){
            let haber = 0.0;
            this.asientos[index].registros.forEach(registro => {
                    haber += parseFloat( registro.haber );
                /** HABER */
                 /*if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"haber") ){ // se suma
                    haber += parseFloat( registro.haber );
                }else{ // se resta
                    haber -= parseFloat( registro.haber );
                }*/
            });
            this.totalHaber[index] = haber.toFixed(2);
        },
        calcTotalesDebeNeto(){
            this.totalDebeNeto = this.totalDebe.reduce((a,b)=>a+b);
        },
        calcTotalesHaberNeto(){
            this.totalHaberNeto = this.totalHaber.reduce((a,b)=>a+b);
        }

    },
    computed:{
        fecha:function () {
            return moment();
        }        
    },
    created(){
        this.momentSetLocale();
        moment.locale("es");
    }
}
</script>