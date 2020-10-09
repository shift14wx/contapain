<template>
    <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mayorización y mas informacion del mes de&nbsp;{{ computedDate }}
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
    props:["parsedRegistros","month"],
    data(){
        return{
            "rubros_registro" : this.parsedRegistros,
            "noMostrar" : 0,
            "deferDebe": "",
            "deferHaber": "",
            "mes" : this.month
        }
    },
    components:{
        AppLayout,
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
    },
    computed:{
        computedDate(){
            return moment(this.mes).format("MMMM YYYY");
        }
    },
    created(){
        this.momentSetLocale();
        moment.locale("es");
    }
}
</script>