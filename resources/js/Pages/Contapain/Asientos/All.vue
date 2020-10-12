<template>
<app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Asientos del dia correspondiente a la fecha {{ computedDate }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>
                        <v-data-table
                            :headers="headers"
                            :items="asientos"
                            sort-by="id"
                            class="elevation-1"
                        >
                            <template v-slot:top>
                                <v-toolbar
                                    flat
                                >
                                    <v-toolbar-title>Registros de Asiento del dia {{ computedDate }}</v-toolbar-title>
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
                                                color="success"
                                                dark
                                                class="mb-2"
                                                v-bind="attrs"
                                                v-on="on"
                                                @click="setDefaultToAddForm"
                                            >
                                            <v-icon> mdi-plus </v-icon> &nbsp;
                                                Agregar Asiento
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                <span class="headline">{{ formTitle }}</span>
                                            </v-card-title>

                                            <v-card-text>
                                                <v-form v-model="mandar">
                                                    
                                                <v-container>
                                                    <v-row>
                                                        <v-row>
                                                        <v-col
                                                            cols="12"
                                                            :sm="12"
                                                            :md="12"
                                                        >
                                                        <v-text-field
                                                                v-model="editedItem.concepto_general"
                                                                label="Concepto General"
                                                                clearable
                                                                :rules="[value=> !!value || 'Este campo es requerido' ]"
                                                            ></v-text-field>
                                                        </v-col>
                                                        </v-row>
                                                    </v-row>
                                                </v-container>
                                                </v-form>
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
                                                    v-if="mandar"
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
                                                <v-btn color="primary" @click="closeDelete">Cancel</v-btn>
                                                <v-btn color="danger" @click="deleteItemConfirm">OK</v-btn>
                                                <v-spacer></v-spacer>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-toolbar>
                            </template>

                            <!--

                                ACTIONS BUTTONS
                            -->
                           
                            <template v-slot:item.actions="{ item }">
                                <v-icon
                                    class="mr-2"
                                    @click="showItem(item)"
                                    :color="'success'"
                                >
                                    mdi-eye
                                </v-icon>
                                <v-icon
                                    class="mr-2"
                                    @click="editItem(item)"
                                    :color="'primary'"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon
                                    @click="deleteItem(item)"
                                    :color="'error'"
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
                        <!-- LOADING SNACKBAR-->
                        <v-snackbar
                        color="warning"
                        v-model="snackLoading"
                        left
                        bottom
                        >
                        <v-progress-circular
                        :size="50"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                        {{ "cargando datos" }}

                        <template v-slot:action="{ attrs }">
                            <v-btn
                            text
                            v-bind="attrs"
                            @click="snackLoading = false"
                            >
                            Close
                            </v-btn>
                        </template>
                        </v-snackbar>

                        <!--SUCCESS SNACKBAR-->

                           <v-snackbar
                        :color="snackbar.color"
                        v-model="snack"
                        left
                        top
                        >
                        <v-icon>
                            mdi-success
                        </v-icon>
                        {{ snackbar.text }}

                        <template v-slot:action="{ attrs }">
                            <v-btn
                            text
                            v-bind="attrs"
                            @click="snack = false"
                            >
                            Close
                            </v-btn>
                        </template>
                        </v-snackbar>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from "../../../Layouts/AppLayout";
import Input from "../../../Jetstream/Input";

export default {
    props:["day","selectedAsientos"],
    data(){
        return {
            "snack" : false,
            "snackLoading": false,
            "snackbar": {
                "text": "actualizado",
                "color" : "success",
            },
            "totalHaber": 0.0,
            "totalDebe" : 0.0,
             mandar     : null,
            "fecha_inicio" : this.day,
            "asientos" : this.selectedAsientos,
            "catalogoCuentas" : this.catalogo_cuentas,
            "dia" : this.day,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: true,
                    value: 'id_asiento',
                },
                {
                    text: 'Concepto general del asiento',
                    align: 'start',
                    sortable: true,
                    value: 'concepto_general',
                },
                { text: 'Acciones', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            editedItem: {
                "concepto_general" : ""
            },
            defaultItem: {
                "concepto_general" : ""
            },
            METHODS  : {
                POST : "post",
                PATCH : "patch",
                DELETE : "delete"
            }
        };
    },
    methods:{
        loadingVisit(){
            let timerInterval = null;
            this.$swal.fire({
            title: 'Cargando espere',
            html: 'Espere por favor',
            timer: 10000,
            timerProgressBar: true,
            showConfirmButton: false ,
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
        showItem(item){
            this.loadingVisit();
            this.$inertia.visit( `/contapain/asientos/${item.id_asiento}/registros`).then(()=>{
                this.$swal.close();
            }).catch(()=>{
                this.$swal.close();
            });
        },
        initialize() {
            this.asientos = this.selectedAsientos;
        },
        editItem(item) {
            this.editedIndex = this.asientos.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.asientos.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.asientos.splice(this.editedIndex, 1)
            this.sendRequest( this.METHODS.DELETE, this.editedIndex );
            
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
        setDefaultToAddForm(){
                this.editedItem = Object.assign({}, this.defaultItem)
        },

        save() {
            if (this.editedIndex > -1) { // SI ESTA EDITANDO
                this.sendRequest( this.METHODS.PATCH, this.editedIndex );
            } else { // SI ESTA ALMACENANDO
                this.sendRequest( this.METHODS.POST );
            }
        },
        sendRequest( method = null, index = -1 ){
                       // https://contapain.lndo.site/asientos
            let titulo = "";
                if("post" == method){
                    titulo = "agregar";
                }else if( "patch" == method ){
                    titulo = "editar";
                }else if( "delete" == method ){
                    titulo = "eliminar";
                }else{
                    titulo = "procesar";
                }
          this.$swal.fire({  
              title: `¿Esta seguro de ${titulo} este asiento?`,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Si',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                if( this.METHODS.POST == method && index == -1 ){ // desea almacenar
               this.editedItem._token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
             this.editedItem.fecha_inicio = this.fecha_inicio;
             this.editedItem.json = true;
             console.log(this.editedItem);
                return fetch('/contapain/asientos/agregar',{
                        method: 'POST',
                        headers: {
                        //'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.editedItem)
                    })
                    .then(response => {
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        return response.json();
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                }else if( this.METHODS.PATCH == method && index >= 0 ) { // desea actualizar
                    this.editedItem._token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                    this.editedItem.fecha_inicio = this.fecha_inicio;
                return fetch(`/contapain/asientos`,{
                        method: 'PATCH',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.editedItem)
                    })
                    .then(response => {
                        if ( response.hasOwnProperty("ok") && !response.ok) {
                        throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                }else if( this.METHODS.DELETE == method && index >= 0 ) { // desea elimnar
                    this.editedItem._token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
                return fetch(`/contapain/asientos/${this.editedItem.id_asiento}`,{
                        method: 'DELETE',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.editedItem)
                    })
                    .then(response => {
                        if (!response.ok) {
                        throw new Error(response.statusText)
                        }
                        this.closeDelete()
                        return response.json()
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                        this.closeDelete()
                    })
                }
            },
            allowOutsideClick: () => !this.$swal.isLoading()
            }).then((result) => {
            if (result.isConfirmed) {
                if("post" == method){
                    titulo = "agregado";
                        this.editedItem.id_registro = result.value.id_registro;
                        this.asientos.push(this.editedItem);
                }else if( "patch" == method ){
                    titulo = "editado";
                    this.asientos[this.editedIndex].fecha_inicio = result.value.asiento.fecha_inicio;
                    console.log(result);
                    this.asientos[this.editedIndex].concepto_general = result.value.asiento.concepto_general;
                }else if( "delete" == method ){
                    titulo = "eliminado";
                }else{
                    titulo = "procesar";
                }
                if( method == "patch" && result.value.statusCode == 422 ){
                this.$swal.fire({
                title: `El Asiento ${titulo} no se pudo actualizar debido a que ya existe uno con el mismo nombre`,
                icon: 'warning',
                timer:1500
                })

                }else{    
                this.$swal.fire({
                title: `El Asiento fue ${titulo}`,
                icon: 'success',
                timer:1500
                })
                }
                if("post" == method){
                    window.location.href = `/contapain/asientos/${result.value.id_asiento}/registros`;
                }
            }
            
            this.close()  
            }).catch((err)=>{
                console.log(err);
            //this.closeDelete()   
            this.close()  
            });    
                   
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
        },
        isFloat(n){
            return Number(n) === n && n % 1 !== 0;
        }, 
    },
    computed:{
        computedDate(){
            return moment( this.dia ).locale("es").format("dddd DD MMMM YYYY");
        },
        formTitle () {
            return this.editedIndex === -1 ? 'Nuevo Asiento' : 'Editar Asiento'
        },
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