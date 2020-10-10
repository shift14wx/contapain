<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
<!--                    <welcome />-->

                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <h1 class="display-1 text-center">BIENVENIDO</h1>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <h2 class="text-rigth">Asientos Contables de este mes</h2>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <tablas-asientos :asientos="asientos" :catalogo_cuentas="catalogoDeCuentas"  />
                        </v-col>
                    </v-row>
                </v-container>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'
    import tablasAsientos from "./Contapain/Asientos/tablasAsiento"
    import lineChart from "../Components/charts/LineChart";
    export default {
        props:["Asientos", "catalogo_cuentas", "meses" ],
        data(){
            return{
                asientos:this.Asientos,
                catalogoDeCuentas : this.catalogo_cuentas,
                months : null,
                optionsChart:{
                    width : "100px",
                    height : "100px"
                }
            }
        },
        components: {
            AppLayout,
            Welcome,
            tablasAsientos,
            lineChart
        },
        mounted(){
            this.months={
        labels: this.meses.map(m=>m.mes),
        datasets: [
            {
            label: '2020',
            backgroundColor: '#f87979',
            data: this.meses.map(m=>m.data)
          }
        ]
      }
            console.log(this.months);
        }
    }
</script>
