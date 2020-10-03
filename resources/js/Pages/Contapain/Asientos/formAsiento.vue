<template>
    <v-app>
        <v-container fill-height fluid>
            <v-row align="center"
                   justify="center">
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        action="/contapain/asientos/agregar"
        method="POST"
    >

        <input
        type="hidden"
        name="_token"
        :value="csrf_token"
        >
        </input>

        <input
            type="hidden"
            name="fecha_inicio"
            :value="selected_fecha_inicio"
        >
        </input>

        <v-text-field
            v-model="concepto"
            :counter="255"
            name="concepto_general"
            :rules="conceptoRules"
            label="Concepto general"
            required
        ></v-text-field>


        <v-btn
            :disabled="!valid"
            class="mr-4"
            color="success"
            @click="validate"
            type="submit"
        >
            Agregar
        </v-btn>

        <v-btn
            color="error"
            class="mr-4"
            @click="reset"
        >
            Volver a empezar
        </v-btn>
    </v-form>
            </v-row>
        </v-container>
    </v-app>
</template>
<script>
import axios from "axios";
import Input from "../../../Jetstream/Input";
export default {
    props: ["selected_fecha_inicio"],
    components: {Input},
    data: () => ({
        valid: true,
        concepto: '',
        conceptoRules: [
            v => !!v || 'Concepto es necesario'
        ],
        x_csrf_token : axios.defaults.headers.common['X-XSRF-TOKEN'],
        csrf_token : document.querySelector("meta[name='csrf-token']").getAttribute("content")
    }),

    methods: {
        validate () {
            this.$refs.form.validate()
        },
        reset () {
            this.$refs.form.reset()
        },
    },
    mounted() {
        console.log(this.selected_fecha_inicio);
    }
}
</script>

<style scoped>

</style>
