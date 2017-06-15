<template>
    <v-layout row justify-center style="z-index: 800;">
        <v-dialog v-model="dialog" fullscreen transition="v-dialog-bottom-transition" :overlay=false>
            <v-btn primary light slot="activator" class="start-frame">
                start bilderammemodus
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-toolbar style="z-index: 900;" class="elevation-0">
                        <v-btn icon="icon" @click.native="dialog = false" light style="padding-left: 30px;">
                            <v-icon>close</v-icon>
                        </v-btn>
                        <!-- <v-toolbar-title>Settings</v-toolbar-title> -->
                        <!-- <v-btn light flat @click.native="dialog = false">Save</v-btn> -->
                    </v-toolbar>

                    <v-carousel icon="stop">
                        <v-carousel-item v-for="(photo, i) in photos" v-bind:src="photo.filepath" :key="i"></v-carousel-item>
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

                photos: []
            }
        },

        methods: {
            setPhotos() {
                axios.get('getphotos').then(response => {
                    this.photos = response.data.data;
                });
            }
        },

        mounted() {
            this.setPhotos()
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }

    .dialog {
        z-index: 100;
    }

    .carousel {
        /*height: 935px;*/
        /*display: flex;*/
        height: 98vh;
    }

    .start-frame {
        position: fixed;
        bottom: -6px;
        left: -7px;
        right: 0px;
        width: 101%;
        z-index: 100;
        font-size: 20px;
    }
</style>