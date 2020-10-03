<template>

    <v-app>

    </v-app>

</template>

<script>
export default {
    name: "Registros",
    props: ["id_asiento","registros","catalogo_cuentas"],
    data(){
        return {
            "idAsiento" : this.id_asiento,
            "registros" : this.registros,
            "catalogoCuentas" : this.catalogo_cuentas
        };
    }
}
</script>

<style scoped>

</style>
