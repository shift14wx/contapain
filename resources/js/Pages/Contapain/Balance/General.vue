<template>

<mayorizacion :parsedRegistros="parsedRegistros" :month="monthIn" :anually="true" @dataSet="catchDataSet" >

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
            "dataset" : null
        }
    },
    components:{
        AppLayout,
        Input,
        mayorizacion
    },
    methods:{
        // una vez el componente mayorizacion termine de realizar todas las tareas necesarias para armar el balance de comprobacion, entonces enviara los datos a este componente parsedRegistros
        // asin se podra hacer el balance general en este componente
        catchDataSet(val){
            this.dataset = val;
            console.log("info:",val);      
        }
    },
    mounted(){
        console.log("done");
    }

}

</script>