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

                    <v-card>
                        <v-card-title>{{ asiento.concepto_general }}</v-card-title>
                        <v-card-text>
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
                                                color="success"
                                                dark
                                                class="mb-2"
                                                v-bind="attrs"
                                                v-on="on"
                                                @click="setDefaultToAddForm"
                                            >
                                            <v-icon> mdi-plus </v-icon> &nbsp;
                                                Agregar Registro
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
                                                        <v-col>
                                                            <input :value="editedItem.id_registro" type="hidden" name="id_registro">
                                                        </v-col>
                                                        <v-col
                                                            cols="12"
                                                            :sm="12"
                                                            :md=" 12"
                                                        >
                                                            <v-autocomplete
                                                                v-model="editedItem.id_detalle_concepto"
                                                                :items="catalogoCuentasParsed"
                                                                :item-value="'id'"
                                                                :rules="[ value => !!value || 'Este campo es necesario' ]"
                                                                :item-text="'tituloAndId'"
                                                                label="Detalle o concepto"
                                                            ></v-autocomplete>
                                                        </v-col>
                                                        <v-row>
                                                            
                                                        <v-col
                                                        
                                                            v-if="!(parseFloat(editedItem.haber) > 0.0)"
                                                            cols="12"
                                                            :sm="(parseFloat(editedItem.haber) > 0.0) ? 6 : 12"
                                                            :md="(parseFloat(editedItem.haber) > 0.0) ? 6 : 12"
                                                        >
                                                            <div class="d-none">
                                                                {{ editedItem.haber =0.0 }}
                                                            </div>
                                                            <v-text-field
                                                                prepend-icon="mdi-currency-usd"
                                                                v-model="editedItem.debe"
                                                                :rules="[ value => !!value || 'Este campo es necesario', value => !isNaN(parseFloat(value)) || 'Solo digitos' ]"
                                                                type="decimal"
                                                                label="Debe"
                                                                persistent-hint
                                                                :hint="'Si desea ver el campo de haber solo deje a cero este campo o vacio'"
                                                            ></v-text-field>
                                                        </v-col>
                                                        <v-col
                                                        
                                                            v-if="!(parseFloat(editedItem.debe) > 0.0)"
                                                            cols="12"
                                                            :sm="(parseFloat(editedItem.debe) > 0.0) ? 6 : 12"
                                                            :md="(parseFloat(editedItem.debe) > 0.0) ? 6 : 12"
                                                        >
                                                            <div class="d-none">
                                                                {{ editedItem.debe =0.0 }}
                                                            </div>
                                                            <v-text-field
                                                                prepend-icon="mdi-currency-usd"
                                                                v-model="editedItem.haber"
                                                                 :rules="[ value => !!value || 'Este campo es necesario', value => !isNaN(parseFloat(value)) || 'Solo digitos' ]"
                                                                type="decimal"
                                                                label="Haber"
                                                                persistent-hint
                                                                :hint="'Si desea ver el campo de debe solo deje a cero este campo o vacio'"
                                                            ></v-text-field>
                                                        </v-col>
                                                        </v-row>
                                                        <v-col
                                                            cols="12"
                                                            sm="12"
                                                            md="12"
                                                        >
                                                            <v-text-field
                                                                v-model="editedItem.concepto_detallado"
                                                                label="Concepto Detallado"
                                                            ></v-text-field>
                                                        </v-col>
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
                                ${{item.debe}}
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
                                ${{item.haber}}
                                </v-chip>
                            </template>

                            <template v-slot:item.actions="{ item }">
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
                                <tr
                                class="white--text"
                                :class="{ 'red darken-4': (totalDebe != totalHaber), 'light-blue accent-4' : (totalDebe == totalHaber && ( totalDebe>=0.0 && totalHaber >= 0.0 ) ), 'orange darken-4' :(totalDebe == totalHaber && ( totalDebe<0.0 && totalHaber < 0.0 ) ) }"
                                >
                                <td><b>Total</b></td>
                                <td> ${{ totalDebe }} </td>
                                <td> ${{ totalHaber }} </td>
                                </tr>
                                <tr>
                                    <td><b>Saldo</b></td>
                                    <td></td>
                                <td > <b>${{ saldo }} </b></td>
                                </tr>
                            </tbody>
                            </template>
                        </v-simple-table>

                        </v-card-text>
                    </v-card>

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

import AppLayout from "../../Layouts/AppLayout";
import Input from "../../Jetstream/Input";

export default {
    name: "Registros",
    props: ["id_asiento","selectedRegistros","catalogo_cuentas","selectedAsiento"],
    data(){
        return {
            "snack" : false,
            "snackLoading": false,
            "snackbar": {
                "text": "El saldo fue actualizado",
                "color" : "success",
            },
            "totalHaber": 0.0,
            "totalDebe" : 0.0,
             mandar     : null,
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
                    value: 'id_detalle_concepto',
                },
                { text: 'Detalle o concepto', value: 'titulo' },
                { text: 'Debe', value: 'debe' },
                { text: 'Haber', value: 'haber' },
                { text: 'Concepto Detallado', value: 'concepto_detallado' },
                { text: 'Acciones', value: 'actions', sortable: false },
            ],
            editedIndex: -1,
            editedItem: {
                "titulo":"",
                "debe":0.0,
                "haber":0.0,
                "concepto_detallado" : ""
            },
            defaultItem: {
                "titulo":"",
                "debe":0.0,
                "haber":0.0,
                "concepto_detallado" : ""
            },
            METHODS  : {
                POST : "post",
                PATCH : "patch",
                DELETE : "delete"
            }
        };
    },
    computed:{
        saldo(){
            return this.totalDebe - this.totalHaber;
        },
        computedDate(){
            return moment( this.asiento.fecha_inicio ).locale("es").format("dddd DD MMMM YYYY");
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
        showCorrectDebeHaber(idConcepto, tipo){
            let concepto = this.catalogo_cuentas.find( ( catalogo ) => catalogo.id == idConcepto );
            return concepto[tipo];
        },
        showAlert() {
      // Use sweetalert2
        this.$swal('Hello Vue world!!!');
        },
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
                Object.assign(this.registros[this.editedIndex], this.editedItem)
                this.registros[ this.editedIndex ].titulo = this.catalogoCuentasParsed.find( cat => cat.id == this.editedItem.id_detalle_concepto ).titulo;
                this.sendRequest( this.METHODS.PATCH, this.editedIndex );
            } else { // SI ESTA ALMACENANDO
                this.editedItem.titulo = this.catalogoCuentasParsed.find( cat => cat.id == this.editedItem.id_detalle_concepto ).titulo;
                    
                this.sendRequest( this.METHODS.POST );
            }
        },
        sendRequest( method = null, index = -1 ){
                       // https://contapain.lndo.site/registros
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
              title: `¿Esta seguro de ${titulo} este registro?`,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Si',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                if( this.METHODS.POST == method && index == -1 ){ // desea almacenar
               this.editedItem._token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
             this.editedItem.json = true; // esto es para que en el endpoint entienda que necesitamos una respuesta json, esto es mannual no lo hace laravel
             this.editedItem.id_rubro = this.editedItem.id_detalle_concepto.toString().substr(0,1);
             this.editedItem.id_asiento = this.idAsiento;
             let index = this.catalogoCuentasParsed.findIndex(cuenta=>cuenta.id == this.editedItem.id_detalle_concepto );
             this.editedItem.id_clasificacion = this.catalogo_cuentas[ index ].id_clasificacion;
             console.log( this.editedItem );
                return fetch('/registros',{
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
                    this.editedItem.json = true; // esto es para que en el endpoint entienda que necesitamos una respuesta json, esto es mannual no lo hace laravel
                    this.editedItem.id_rubro = this.editedItem.id_detalle_concepto.toString().substr(0,1);
                    this.editedItem.id_asiento = this.idAsiento;
                    let index = this.catalogoCuentasParsed.findIndex(cuenta=>cuenta.id == this.editedItem.id_detalle_concepto);
                    console.log( this.editedItem.id_detalle_concepto );
                    this.editedItem.id_clasificacion = this.catalogo_cuentas[ index ].id_clasificacion;
                    console.log(this.editedItem );
                return fetch(`/registros/${this.editedItem.id_registro}`,{
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
                        this.calcularTotales();
                        return response.json()
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                }else if( this.METHODS.DELETE == method && index >= 0 ) { // desea elimnar
                return fetch(`/registros/${this.editedItem.id_registro}`,{
                        method: 'DELETE',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({"json":true})
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
                        this.registros.push(this.editedItem);
                }else if( "patch" == method ){
                    titulo = "editado";
                }else if( "delete" == method ){
                    titulo = "eliminado";
                }else{
                    titulo = "procesar";
                }
                this.$swal.fire({
                title: `El registro fue ${titulo}`,
                icon: 'success',
                timer:1500
                })
            this.cerrarAsientoSaldo();
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
        calcularTotales(){
            this.totalDebe = 0.0;
            this.totalHaber = 0.0;
            this.registros.forEach(registro => {
                this.totalDebe += parseFloat( registro.debe );
                this.totalHaber += parseFloat( registro.haber );
                /** DEBE */
               /* if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"debe") ){ // se suma
                    this.totalDebe += parseFloat( registro.debe );
                }else{ // se resta
                    this.totalDebe -= parseFloat( registro.debe );
                }*/
                /** HABER */
                 /*if( this.showCorrectDebeHaber(registro.id_detalle_concepto,"haber") ){ // se suma
                    this.totalHaber += parseFloat( registro.haber );
                }else{ // se resta
                    this.totalHaber -= parseFloat( registro.haber );
                }*/
            });

            if( this.isFloat( this.totalDebe ) )
            {
                this.totalDebe = parseFloat( this.totalDebe ).toFixed(2);
            }
            if( this.isFloat( this.totalHaber ) )
            {
                this.totalHaber = parseFloat( this.totalHaber ).toFixed(2);
            }
        },
        isFloat(n){
            return Number(n) === n && n % 1 !== 0;
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
        cerrarAsientoSaldo(){
            this.snackLoading = true;
            fetch("/contapain/cerrarasiento",{
                        method: 'POST',
                        headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                    "id_asiento":this.id_asiento,
                    "saldo":parseFloat(this.saldo).toFixed(2),
                    "_token": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                     })
                    }).then(()=>{
                        this.snack = true;
                        setTimeout(() => {
                        this.snackLoading = false;
                        }, 1000);
            }).catch(()=>{
                        this.snackLoading.false;
            });
        }
    },
    watch:{
        registros:function () { // este solo funciona cuando se agrega o se elimina registro para calcular el total
            this.calcularTotales();
        }
    },
    components:{
        Input,
        AppLayout
    },
    mounted(){
        console.log( typeof( this.catalogo_cuentas ) );
    },
    created(){
        this.initialize();
        this.momentSetLocale();
        moment.locale("es");
        this.calcularTotales();
    }
}
</script>

<style scoped>

</style>
