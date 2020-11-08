<template>

<mayorizacion :parsedRegistros="parsedRegistros" :month="monthIn" :anually="true" >

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
            "monthIn" : this.month,
        }
    },
    components:{
        AppLayout,
        Input,
        mayorizacion
    }

}

</script>