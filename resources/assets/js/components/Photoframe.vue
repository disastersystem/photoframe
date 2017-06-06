<template>
    <v-layout row justify-center style="z-index: 250;">
        <v-dialog v-model="dialog" fullscreen transition="v-dialog-bottom-transition" :overlay=false>
            <v-btn primary light slot="activator" 
            style="position: fixed; bottom: -6px; left: -7px; right: 0px; width: 101%; z-index: 10;">Start bilderammemodus</v-btn>
            <v-card>
                <v-card-row>
                    <v-toolbar style="" class="elevation-0">
                        <v-btn icon="icon" @click.native="dialog = false" light>
                            <v-icon>close</v-icon>
                        </v-btn>
                        <!-- <v-toolbar-title>Settings</v-toolbar-title> -->
                        <!-- <v-btn light flat @click.native="dialog = false">Save</v-btn> -->
                    </v-toolbar>

                    <v-carousel icon="stop" interval="6000" class="hello">
                        <v-carousel-item v-for="(item, i) in items" v-bind:src="item.src" :key="i"></v-carousel-item>
                    </v-carousel>
                </v-card-row>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        data () {
            return {
                dialog: false,

                items: [
                    {
                        src: 'uploads/eli.jpg'
                    }, {
                        src: 'uploads/family.jpg'
                    }, {
                        src: 'uploads/fuji-san.jpg'
                    }, {
                        src: 'uploads/woman.jpg'
                    }
                ]
            }
        },

        methods: {
            
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }
</style>