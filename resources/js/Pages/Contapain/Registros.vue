<template>

    <v-app>
            <h1>REGISTROS XDXD</h1>
        <div>
            {{catalogoCuentas}}
        </div>
    </v-app>

</template>

<script>
export default {
    name: "Registros",
    props: ["id_asiento","registros","catalogo_cuentas"],
    data(){
        return {
            "idAsiento" : this.id_asiento,
            "localregistros" : this.registros,
            "catalogoCuentas" : this.catalogo_cuentas
        };
    }
}
</script>

<style scoped>

</style>
