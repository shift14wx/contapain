<template>
    <v-app>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar
                    dark
                >
                    <v-btn
                        icon
                        dark
                        @click="dialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>

                        <slot name="title"></slot>

                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn
                            text
                            @click="dialog = false"
                        >
                            CERRAR
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-card-text>
                    <slot name="content"></slot>
                </v-card-text>
            </v-card>
        </v-dialog>
        </v-app>
</template>

<script>
export default {
    props:["value"],
name: "dialog-fullscreen",
    data () {
        return {
            notifications: false,
            sound: true,
            widgets: false,
        }
    },
    computed:{
        dialog:{
            get: function (){
                console.log(this.value);
                return this.value;
            },
            set: function ( val ){
                this.$emit("input",val);
            }
        }
    }
}
</script>

<style scoped>

</style>
