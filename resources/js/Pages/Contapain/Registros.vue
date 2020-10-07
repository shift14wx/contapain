<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                REGISTROS DEL ASIENTO CORRESPONDIENTE A {{ computedDate }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>

                    <v-app>
                        <v-data-table
                            :headers="headers"
                            :items="registros"
                            sort-by="id"
                            class="elevation-1"
                        >
                            <template v-slot:top>
                                <v-toolbar
                                    flat
                                >
                                    <v-toolbar-title>Registros de Asiento con id {{ id_asiento }}</v-toolbar-title>
                                    <v-divider
                                        class="mx-4"
                                        inset
                                        vertical
                                    ></v-divider>
                                    <v-spacer></v-spacer>
                                    <v-dialog
                                        v-model="dialog"
                                        max-width="500px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                color="primary"
                                                dark
                                                class="mb-2"
                                                v-bind="attrs"
                                                v-on="on"
                                            >
                                                Agregar Registro
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formTitle }}</span>
                                            </v-card-title>

                                            <v-card-text>
                                                <v-container>
                                                    <v-row>
                                                        <v-col>
                                                            <v-text-field
                                                                v-model="editedItem.id_registro"
                                                                disabled
                                                                label="Id de registro"
                                                                v-if="(editedIndex > -1)"
                                                            ></v-text-field>
                                                            <input :value="editedItem.id_registro" type="hidden" name="id_registro">
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-autocomplete
                                                                v-model="editedItem.id_detalle_concepto"
                                                                :items="catalogoCuentasParsed"
                                                                :item-value="'id'"
                                                                :item-text="'tituloAndId'"
                                                                label="Detalle o concepto"
                                                            ></v-autocomplete>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.debe"
                                                                label="Debe"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.haber"
                                                                label="Haber"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            sm="6"
                                                            md="4"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.concepto_detallado"
                                                                label="Concepto Detallado"
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="close"
                                                >
                                                    Cancel
                                                </v-btn>
                                                <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="save"
                                                >
                                                    Almacenar
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                    <v-dialog v-model="dialogDelete" max-width="500px">
                                        <v-card>
                                            <v-card-title class="headline">¿Deseas eliminar este registro?</v-card-title>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn class="bg-primary" @click="closeDelete">Cancel</v-btn>
                                                <v-btn color="danger" @click="deleteItemConfirm">OK</v-btn>
                                                <v-spacer></v-spacer>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-toolbar>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editItem(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon
                                    small
                                    @click="deleteItem(item)"
                                >
                                    mdi-delete
                                </v-icon>
                            </template>
                            <template v-slot:no-data>
                                <v-btn
                                    color="primary"
                                    @click="initialize"
                                >
                                    Reset
                                </v-btn>
                            </template>
                        </v-data-table>

                    </v-app>

                </div>
            </div>
        </div>
    </app-layout>

</template>

<script>

import AppLayout from "../../Layouts/AppLayout";
import Input from "../../Jetstream/Input";

export default {
    name: "Registros",
    props: ["id_asiento","selectedRegistros","catalogo_cuentas","selectedAsiento"],
    data(){
        return {
            "idAsiento" : this.id_asiento,
            "registros" : this.selectedRegistros,
            "catalogoCuentas" : this.catalogo_cuentas,
            "asiento" : this.selectedAsiento,
            "catalogoCuentasParsed" : this.catalogo_cuentas.map(cuenta => { return {"tituloAndId":cuenta.tituloAndId,"id":cuenta.id,"titulo":cuenta.titulo}; } ),
            dialog: false,
            dialogDelete: false,
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
            editedIndex: -1,
            editedItem: {
                id_registro: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0,
            },
            defaultItem: {
                name: '',
                calories: 0,
                fat: 0,
                carbs: 0,
                protein: 0,
            },
        };
    },
    computed:{
        computedDate(){
            return moment( this.asiento.fecha_inicio ).locale("es").format("DD dddd MMMM YYYY");
        },
        formTitle () {
            return this.editedIndex === -1 ? 'Nuevo registro' : 'Editar registro'
        },
    },

    watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    methods: {
        initialize() {
            this.registros = this.selectedRegistros;
        },

        editItem(item) {
            this.editedIndex = this.registros.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.registros.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.registros.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.registros[this.editedIndex], this.editedItem)
                this.registros[ this.editedIndex ].titulo = this.catalogoCuentasParsed.find( cat => cat.id == this.editedItem.id_detalle_concepto ).titulo;
            } else {
                console.log( this.editedItem );
                 this.editedItem.titulo = this.catalogoCuentasParsed.find( cat => cat.id == this.editedItem.id_detalle_concepto ).titulo;
                this.registros.push(this.editedItem)
            }
            this.close()
        },
        momentSetLocale() {
            moment.locale('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
                monthsShort: 'Ene._Feb._Mar_Abr._May_Jun_Jul._Agost_Sept._Oct._Nov._Dec.'.split('_'),
                monthsParseExact: true,
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mir._Jue._Vie._Sab.'.split('_'),
                weekdaysMin: 'Di_Lu_Ma_Mi_Ju_Vi_Sa'.split('_'),
                weekdaysParseExact: true,
                longDateFormat: {
                    LT: 'HH:mm',
                    LTS: 'HH:mm:ss',
                    L: 'DD/MM/YYYY',
                    LL: 'D MMMM YYYY',
                    LLL: 'D MMMM YYYY HH:mm',
                    LLLL: 'dddd D MMMM YYYY HH:mm'
                },
                calendar: {
                    sameDay: '[Aujourd’hui à] LT',
                    nextDay: '[Demain à] LT',
                    nextWeek: 'dddd [à] LT',
                    lastDay: '[Hier à] LT',
                    lastWeek: 'dddd [dernier à] LT',
                    sameElse: 'L'
                },
                relativeTime: {
                    future: 'dans %s',
                    past: 'il y a %s',
                    s: 'quelques secondes',
                    m: 'une minute',
                    mm: '%d minutes',
                    h: 'une heure',
                    hh: '%d heures',
                    d: 'un jour',
                    dd: '%d jours',
                    M: 'un mois',
                    MM: '%d mois',
                    y: 'un an',
                    yy: '%d ans'
                },
                dayOfMonthOrdinalParse: /\d{1,2}(er|e)/,
                ordinal: function (number) {
                    return number + (number === 1 ? 'er' : 'e');
                },
                meridiemParse: /PD|MD/,
                isPM: function (input) {
                    return input.charAt(0) === 'M';
                },
                // In case the meridiem units are not separated around 12, then implement
                // this function (look at locale/id.js for an example).
                // meridiemHour : function (hour, meridiem) {
                //     return /* 0-23 hour, given meridiem token and hour 1-12 */ ;
                // },
                meridiem: function (hours, minutes, isLower) {
                    return hours < 12 ? 'PD' : 'MD';
                },
                week: {
                    dow: 1, // Monday is the first day of the week.
                    doy: 4  // Used to determine first week of the year.
                }
            });
        }
    },
    components:{
        Input,
        AppLayout
    },
    created(){
        this.initialize();
        this.momentSetLocale();
        moment.locale("es");
    }
}
</script>

<style scoped>

</style>
