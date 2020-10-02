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
                    <p>Asiento {{ selectedAsiento|| 'nuevo' }}</p>
                </template>Asiento
                <template v-slot:content>
                    <form-asiento></form-asiento>
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
        selectedAsiento: ""
    }),
    methods: {
        existAsiento( date ){
            let exist = this.AsientosObjectos.findIndex( asiento => asiento["fecha_inicio"] === date );
            return exist;
        },
        viewDay ({ date }) {

            let index = this.existAsiento(date);
            console.log(index);
            if( index >= 0 ){
                // esta validacion es apra saber que mostrar en el fullscreen modal si el saldo existe entonces
                // solo se mostrara el formulario pero sin poder editarlo junto con los registros del mismo
                this.selectedAsiento = moment(this.AsientosObjectos[ index ].created_at).format() ;
                let exitsSaldo = this.AsientosObjectos[ index ].saldo != null;
            }else{
                // si no se encuentra entonces en ese dia no se ha agregado un asiento
                // se presentara el formulario
                this.showFormularioAgregar = true;
            }
            this.focus = date
            this.showDialog = true;
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
    },
    mounted() {
        console.log(this.Asientos);
        this.AsientosObjectos = this.Asientos;
        this.focus = moment().format("YYYY-MM-DD");
    }
}
</script>

<style scoped>

</style>
