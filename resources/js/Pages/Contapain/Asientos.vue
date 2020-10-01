<template>
        <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Asientos
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" data-app>

                        <v-app>

                            <v-row>
                                <v-col>

                                    <!-- HEADER CALENDAR -->
                                    <v-sheet height="64">
                                        <v-toolbar
                                            flat
                                        >
                                            <v-btn
                                                outlined
                                                class="mr-4"
                                                color="grey darken-2"
                                                @click="setToday"
                                            >
                                                AHORA
                                            </v-btn>
                                            <v-btn
                                                fab
                                                text
                                                small
                                                color="grey darken-2"
                                                @click="prev"
                                            >
                                                <v-icon small>
                                                    mdi-chevron-left
                                                </v-icon>
                                            </v-btn>
                                            <v-btn
                                                fab
                                                text
                                                small
                                                color="grey darken-2"
                                                @click="next"
                                            >
                                                <v-icon small>
                                                    mdi-chevron-right
                                                </v-icon>
                                            </v-btn>
                                            <v-toolbar-title v-if="$refs.calendar">
                                                {{ $refs.calendar.title }}
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                    </v-sheet>
                                    <!-- END HEADER -->
                                    <v-sheet height="500">
                                        <v-calendar
                                            ref="calendar"
                                            color="primary"
                                            v-model="focus"
                                            @change="updateRange"
                                            @click:date="viewDay"
                                        >
                                            <template v-slot:day="{ present, past, date }">
                                                <v-row
                                                    class="fill-height"
                                                >
                                                    <template v-if="past && tracked[date]">
                                                        <v-sheet
                                                            v-for="(percent, i) in tracked[date]"
                                                            :key="i"
                                                            :title="category[i]"
                                                            :color="colors[i]"
                                                            :width="`100%`"
                                                            height="100%"
                                                            tile
                                                        ></v-sheet>
                                                    </template>
                                                </v-row>
                                            </template>
                                        </v-calendar>
                                    </v-sheet>
                                </v-col>
                            </v-row>

                        </v-app>


                    </div>
                </div>
            </div>
        </app-layout>

</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
export default {
    name:"Asientos",
    components:{
        AppLayout
    },
    data: () => ({
        focus: '',
        tracked: {
            '2020-09-09': [23, 45, 10],
            '2020-09-08': [10],
            '2020-09-07': [0, 78, 5],
            '2020-09-06': [0, 0, 50],
            '2020-09-05': [0, 10, 23],
            '2020-09-04': [2, 90],
            '2020-09-03': [10, 32],
            '2020-09-02': [80, 10, 10],
            '2020-09-01': [20, 25, 10],
        },
        colors: ['#1867c0', '#fb8c00', '#000000'],
        category: ['Development', 'Meetings', 'Slacking'],
    }),
    methods: {
        viewDay ({ date }) {
            this.focus = date
            alert(date);
            //this.type = 'day'
        },
        getEventColor (event) {
            return event.color
        },
        setToday () {
            this.focus = ''
        },
        prev () {
            this.$refs.calendar.prev()
        },
        next () {
            this.$refs.calendar.next()
        },
        updateRange ({ start, end }) {

        },
        rnd (a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a
        },
    },
    mounted() {
        this.focus = moment().format("YYYY-MM-DD");
    }
}
</script>

<style scoped>

</style>
