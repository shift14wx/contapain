<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
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
                </v-container>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
