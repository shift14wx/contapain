<template>
    <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mayorización y mas informacion del {{ anually ? '' : 'mes' }} de&nbsp;{{ computedDate }}
                </h2>
                <br>
                <a href="#balanceGeneral" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Mostrar Balance de comprobación
                </a>
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
                                                    <tr>
                                                        <td>

                                                        </td>
                                                    </tr>
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
                                                        <div class="d-none">
                                                            {{calcularTotales(index)}}
                                                        </div>
                                                        <td>Totales</td>
                                                        <td class="text-center"> ${{ totales[ index ][ "debe" ] }}  </td>
                                                        <td class="text-center"> ${{ totales[ index ][ "haber" ] }}  </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                </template>
                                            </v-simple-table>
                                        </v-card-text>
                                    </v-card>
                                </v-col>
                            </v-row>
                                <v-col cols="12" id="balanceGeneral">
                                     <v-card>
                                        <v-card-title>Balance de comprobación</v-card-title>
                                        <v-card-subtitle>  </v-card-subtitle>
                                        <v-card-text>
                                             <v-simple-table light>
                                                    <template v-slot:default>
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th colspan="2" class="text-center indigo darken-4 white--text">MOVIMIENTOS</th>
                                                            <th colspan="2" class="text-center deep-purple darken-4 white--text">SALDOS</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                             <tr>
                                                                <th class="text-center ">Codigo</th>
                                                            <th class="text-center">Descripción</th>
                                                            <th class="text-center indigo darken-4 white--text">DEUDOR</th>
                                                                <th class="text-center indigo darken-4 white--text">ACREEDOR</th>
                                                            <th class="text-center deep-purple darken-4 white--text">DEUDOR</th>
                                                                <th class="text-center deep-purple darken-4 white--text">ACREEDOR</th>
                                                            </tr>

                                                          <tr
                                                            v-for="( rubro, index ) in rubros_registro"
                                                            :key="rubro.id_detalle_concepto"
                                                            >
                                                                <td class="text-center">{{ rubro.id_detalle_concepto }}</td>
                                                                <td class="text-center">{{ rubro.titulo }}</td>
                                                                <td> ${{  totales[ index ][ "debe" ]  }} </td>
                                                                <td> ${{  totales[ index ][ "haber" ]  }} </td>
                                                                <!--TOTALES-->
                                                                <td> {{  ( parseFloat( totales[ index ][ "debe" ] ) - parseFloat( totales[ index ][ "haber" ] ) ) >= 0.0 ? "$"+( parseFloat( totales[ index ][ "debe" ] ) - parseFloat( totales[ index ][ "haber" ] ) ).toFixed(2)  : ''  }} </td>

                                                                <td> {{  ( parseFloat( totales[ index ][ "debe" ] ) - parseFloat( totales[ index ][ "haber" ] ) ) <= 0.0 ? "$"+ Math.abs( ( parseFloat( totales[ index ][ "debe" ] ) - parseFloat( totales[ index ][ "haber" ] ).toFixed(2) ).toFixed(2) ) : ''  }} </td>
                                                          </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-center"> <b>Total</b></td>
                                                            <td class="text-center"><b>${{ totDebMov }} </b></td>
                                                            <td class="text-center"><b>${{ totHabMov }} </b></td>
                                                            <td class="text-center"><b>${{ totDebSal }} </b></td>
                                                            <td class="text-center"><b>${{ totHabSal }} </b></td>
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

<style>
/*
.bg-indigo{
    background-color: #3F51B5 !important;
    color: white !important;
}*/

</style>

<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
    props:["parsedRegistros","month", "anually"],
    data(){
        return{
            "totales":[],
            "rubros_registro" : this.parsedRegistros,
            "noMostrar" : 0,
            "deferDebe": "",
            "deferHaber": "",
            "mes" : this.month,
            "anual" : this.anually,
            totDebMov:0.0,
            totDebSal:0.0,
            totHabMov:0.0,
            totHabSal:0.0
        }
    },
    components:{
        AppLayout,
    },
    methods:{
        isFloat(n){
            return Number(n) === n && n % 1 !== 0;
        }, 
        // esta funcion se encargara de hacer las sumas del balance de comprobación
        calcularTotalesMovSal(){

            // MOVIMIENTOS
            this.totales.forEach( (a)=>{
                this.totDebMov += Number(a.debe) ? parseFloat(  a.debe ) : 0.0;
                this.totHabMov += Number(a.haber) ? parseFloat( a.haber )  : 0.0;
            } );
            this.totDebMov = this.totDebMov.toFixed(2);
            this.totHabMov = this.totHabMov.toFixed(2);

            // saldos
            this.totales.forEach(( tot )=>{
                let result = tot.debe - tot.haber;
                if( result>= 0.0 ){
                    console.log( parseFloat(result).toFixed(2) );
                    this.totDebSal += parseFloat(result);
                }else{
                    this.totHabSal += parseFloat(result);
                }
            });
           this.totDebSal = parseFloat(this.totDebSal).toFixed(2);
           this.totHabSal = parseFloat(this.totHabSal).toFixed(2);
           this.totHabSal = Math.abs( this.totHabSal );
        },
        loadingVisit(){
            let timerInterval = null;
            this.$swal.fire({
            title: 'Cargando espere',
            html: 'Espere por favor',
            timer: 10000,
            timerProgressBar: true,
            showConfirmButton: false,
            willOpen: () => {
                $swal.showLoading()
                timerInterval = setInterval(() => {
                /*const content = Swal.getContent()
                if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                    b.textContent = Swal.getTimerLeft()
                    }
                }*/
                }, 100)
            },
            allowOutsideClick: () => false,
            onClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            /*if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }*/
            })
        },
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
            let idAsiento = parseInt(document.querySelector(`#${tipo}${rubro}${registro}`).textContent);
            if(idAsiento){
            this.loadingVisit();
             this.$inertia.visit(`/contapain/asientos/${idAsiento}/registros`).then(()=>{
                this.$swal.close();
            }).catch(()=>{
                this.$swal.close();
            });
            }
           
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
                this.noMostrar = haber.id_registro;
                this.deferHaber = haberCopy.id_asiento;
                return haberCopy.haber;
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
        },
        calcularTotales( indexRubro ){
            this.totales[ indexRubro ] = {
                "debe": 0,
                "haber": 0
            };
            let debe = this.rubros_registro[ indexRubro ].registros.map( (reg)=> reg.debe );
            let haber = this.rubros_registro[ indexRubro ].registros.map( (reg)=> reg.haber );
            this.totales[ indexRubro ]["debe"] = debe.reduce( (a,b)=>parseFloat(a)+parseFloat(b));
            this.totales[ indexRubro ]["haber"] =  haber.reduce( (a,b)=>parseFloat(a)+parseFloat(b));
        }
    },
    computed:{
        computedDate(){
            return moment(this.mes).format(this.anually ? "YYYY" : "MMMM YYYY");
        }
    },
    created(){
        this.momentSetLocale();
        moment.locale("es");
    },
    mounted(){
        setTimeout(() => {
        this.calcularTotalesMovSal();
        }, 1000);
    }
}
</script>