<template>

<mayorizacion :parsedRegistros="parsedRegistros" :month="month" :anually="true" >

</mayorizacion>

</template>

<script>

import AppLayout from "../../../Layouts/AppLayout";
import Input from "../../../Jetstream/Input";
import mayorizacion from "../Mayorizacion";
export default{
    props:["parsedRegistros","month"],
    data(){
        return{
            "registros": this.parsedRegistros,
            "month" : this.month,
        }
    },
    components:{
        AppLayout,
        Input,
        mayorizacion
    }

}

</script>