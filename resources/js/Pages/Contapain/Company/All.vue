<template>
   <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Compañias de este usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>
                        <v-data-table
                            :headers="headers"
                            :items="companies"
                            sort-by="id"
                            class="elevation-1"
                        >
                            <template v-slot:top>
                                <v-toolbar
                                    flat
                                >
                                    <v-toolbar-title>Compañias</v-toolbar-title>
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
                                                Agregar Compañia
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
                                                                prepend-icon="mdi-chart-histogram"
                                                                v-model="editedItem.titulo"
                                                                :rules="[ value => !!value || 'Este campo es necesario' ]"
                                                                label="Nombre de la compañia"
                                                                counter="255"
                                                                persistent-hint
                                                                :hint="'Inserte el nombre de la compañia'"
                                                            ></v-text-field>
                                                             <v-autocomplete
                                                                prepend-inner-icon="mdi-chart-line"
                                                                v-model="editedItem.giro"
                                                                :items="['Comercial', 'Industrial', 'Servicios' ]"
                                                                :rules="[ value => !!value || 'Este campo es necesario' ]"
                                                                label="Giro de la empresa"
                                                            ></v-autocomplete>
                                                            <v-text-field
                                                                counter="255"
                                                                prepend-icon=" mdi-crosshairs-gps"
                                                                v-model="editedItem.direccion"
                                                                :rules="[ value => !!value || 'Este campo es necesario' ]"
                                                                label="Dirección de la compañia"
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
                                            <v-card-title class="headline">¿Deseas eliminar esta Compañia junto con todos sus asientos y registros?</v-card-title>
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
                               <v-btn
                                @click="showItem(item)"
                                :color="'success'"
                               >
                                <v-icon
                                class="mr-2"
                                :color="'white'"
                                >
                                    mdi-checkbox-marked-circle-outline
                                </v-icon>
                                Seleccinar compañia
                               </v-btn>
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
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>

import AppLayout from "../../../Layouts/AppLayout";
import Input from "../../../Jetstream/Input";

export default {

    props:["AllCompanies"],
    components:{
        AppLayout,
        Input
    },
    data(){
        return {
             mandar     : null,
            companies : this.AllCompanies,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'Id',
                    align: 'start',
                    sortable: true,
                    value: 'id_company',
                },
                {
                    text: 'Nombre Compañia',
                    align: 'start',
                    sortable: true,
                    value: 'titulo',
                },
                {
                    text: 'Giro de la Compañia',
                    align: 'start',
                    sortable: true,
                    value: 'giro',
                },
                {
                    text: 'Dirección de la Compañia',
                    align: 'start',
                    sortable: true,
                    value: 'direccion',
                },
                { text: 'Acciones', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            editedItem: {
                "nombre" : ""
            },
            defaultItem: {
                "nombre" : ""
            },
            METHODS  : {
                POST : "post",
                PATCH : "patch",
                DELETE : "delete"
            }
        }
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
            this.$inertia.visit( `/company/select/${item.id_company}`).then(()=>{
                this.$swal.close();
                setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 3000);
            }).catch(()=>{
                this.$swal.close();
            });
        },
        initialize() {
            this.companies = this.selectedAsientos;
        },
        editItem(item) {
            this.editedIndex = this.companies.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.companies.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.companies.splice(this.editedIndex, 1)
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
                       // https://contapain.lndo.site/companies
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
              title: `¿Esta seguro de ${titulo} este compañia}?`,
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
                return fetch('/company',{
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
                return fetch(`/company`,{
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
                return fetch(`/company/${this.editedItem.id_company}`,{
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
                    titulo = "agregada";
                        this.editedItem.id_company = result.value.id_company;
                        this.companies.push(this.editedItem);
                }else if( "patch" == method ){
                    titulo = "editada";
                    this.companies[this.editedIndex].giro = result.value.company.giro;
                    console.log(result);
                    this.companies[this.editedIndex].titulo = result.value.company.titulo;
                    this.companies[this.editedIndex].direccion = result.value.company.direccion;
                }else if( "delete" == method ){
                    titulo = "eliminada";
                }else{
                    titulo = "procesar";
                }
                if( method == "patch" && result.value.statusCode == 422 ){
                this.$swal.fire({
                title: `La compañia ${titulo} no se pudo actualizar debido a que ya existe una compañia con el mismo nombre`,
                icon: 'warning',
                timer:1500
                })

                }else{    
                this.$swal.fire({
                title: `La Compañia fue ${titulo}`,
                icon: 'success',
                timer:1500
                })
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
        formTitle () {
            return this.editedIndex === -1 ? 'Nueva Compañia' : 'Editar Compañia'
        },
    }
}
</script>