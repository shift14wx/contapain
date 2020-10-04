<template>
        <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Asientos
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>

                        <v-app>

                            <v-row>
                                <v-col v-if="AsientosObjectos">

                                    <!-- HEADER CALENDAR -->
                                    <v-sheet height="64">
                                        <v-toolbar
                                            flat
                                        >
                                            <v-btn
                                                outlined
                                                class="mr-4"
                                                color="grey darken-2"
                                                @click="setToday"
                                            >
                                                AHORA
                                            </v-btn>
                                            <v-btn
                                                fab
                                                text
                                                small
                                                color="grey darken-2"
                                                @click="prev"
                                            >
                                                <v-icon small>
                                                    mdi-chevron-left
                                                </v-icon>
                                            </v-btn>
                                            <v-btn
                                                fab
                                                text
                                                small
                                                color="grey darken-2"
                                                @click="next"
                                            >
                                                <v-icon small>
                                                    mdi-chevron-right
                                                </v-icon>
                                            </v-btn>
                                            <v-toolbar-title v-if="$refs.calendar">
                                                {{ $refs.calendar.title }}
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                    </v-sheet>
                                    <!-- END HEADER -->
                                    <v-sheet height="500">
                                        <v-calendar
                                            ref="calendar"
                                            color="primary"
                                            v-model="focus"
                                            @change="updateRange"
                                            @click:date="viewDay"
                                        >
                                            <template v-slot:day="{ present, past, date }">
                                                <v-row
                                                    class="fill-height"
                                                >
                                                    <template v-if="past && ( parseInt( existAsiento(date) )+1 )">
                                                        <v-sheet
                                                            :title="AsientosObjectos[ existAsiento(date) ].concepto_general"
                                                            :color="getColor( existAsiento(date) )"
                                                            :width="`100%`"
                                                            height="100%"
                                                            tile
                                                        >
                                                            <h1 class="text-center">Saldo: $ {{ AsientosObjectos[ existAsiento(date) ].saldo }} </h1>
                                                        </v-sheet>
                                                    </template>
                                                </v-row>
                                            </template>
                                        </v-calendar>
                                    </v-sheet>
                                </v-col>
                            </v-row>

                        </v-app>


                    </div>
                </div>
            </div>

            <!--FULL SCREEN DIALOG-->
            <dialog-fullscreen v-model="showDialog" >
                <template v-slot:title>
                    <p>Asiento {{ selectedAsiento || 'nuevo' }}</p>
                </template>Asiento
                <template v-slot:content>
                    <form-asiento :selected_fecha_inicio="fecha_inicio_selected"></form-asiento>
                </template>
            </dialog-fullscreen>

        </app-layout>

</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import dialogFullscreen from "../../Components/dialogfullscreen";
import formAsiento from "./Asientos/formAsiento";
import axios from "axios";
export default {
    http: {
        headers: {
            'X-CSRF-TOKEN': axios.defaults.headers.common['X-XSRF-TOKEN']
        }
    },
    props:["Asientos"],
    name:"Asientos",
    components:{
        AppLayout,
        dialogFullscreen,
        formAsiento
    },
    data: () => ({
        showDialog:false,
        focus: '',
        AsientosObjectos: null,
        colors: ['#ffc107', '#fb8c00', '#000000'],
        category: ['Development', 'Meetings', 'Slacking'],
        showFormularioAgregar : false,
        selectedAsiento: "",
        fecha_inicio_selected: moment().format("YYYY-MM-DD")
    }),
    methods: {
        existAsiento( date ){
            let exist = this.AsientosObjectos.findIndex( asiento => asiento["fecha_inicio"] === date );
            console.log("exist: ",exist,"date: ",date);
            return exist;
        },
        viewDay ({ date }) {
            this.fecha_inicio_selected = date;
            let index = this.existAsiento(date);
            if( index >= 0 ){
                this.$inertia.visit(`/contapain/asientos/${ this.AsientosObjectos[ index ].id_asiento }/registros`, {
                    method: 'get'
                })
                // esta validacion es apra saber que mostrar en el fullscreen modal si el saldo existe entonces
                // solo se mostrara el formulario pero sin poder editarlo junto con los registros del mismo
                this.selectedAsiento = moment(this.AsientosObjectos[ index ].fecha_inicio).format("DD dddd MM YYYY");
                let exitsSaldo = this.AsientosObjectos[ index ].saldo != null;
            }else{
                this.selectedAsiento = "";
                // si no se encuentra entonces en ese dia no se ha agregado un asiento
                // se presentara el formulario
                this.showFormularioAgregar = true;
                this.showDialog = true;
            }
            this.focus = date
            //this.type = 'day'
        },
        getEventColor (event) {
            return event.color
        },
        setToday () {
            this.focus = ''
        },
        prev () {
            this.$refs.calendar.prev()
        },
        next () {
            this.$refs.calendar.next()
        },
        updateRange ({ start, end }) {

        },
        getColor( index ){
            return this.AsientosObjectos[ index ].saldo != null ? this.colors[1] : this.colors[0];
        },
        rnd (a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a
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
        }
    },
    mounted() {
        this.AsientosObjectos = this.Asientos;
        this.focus = moment().format("YYYY-MM-DD");
    },
    created(){
        this.momentSetLocale();
        moment.locale("es");
    }
}
</script>

<style scoped>

</style>
