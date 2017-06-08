<template>
    <v-layout row justify-center style="z-index: 250;">
        <v-dialog v-model="dialog" fullscreen transition="v-dialog-bottom-transition" :overlay=false>
            <v-btn primary light slot="activator" class="start-frame">Start bilderammemodus</v-btn>
            <v-card>
                <v-card-row>
                    <v-toolbar style="" class="elevation-0">
                        <v-btn icon="icon" @click.native="dialog = false" light>
                            <v-icon>close</v-icon>
                        </v-btn>
                        <!-- <v-toolbar-title>Settings</v-toolbar-title> -->
                        <!-- <v-btn light flat @click.native="dialog = false">Save</v-btn> -->
                    </v-toolbar>

                    <v-carousel icon="stop">
                        <v-carousel-item v-for="(item, i) in items" v-bind:src="item.filepath" :key="i"></v-carousel-item>
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
                    // { filepath: '' }
                ]
            }
        },

        methods: {
            getImages() {
                axios.get('getphotos').then(response => {
                    // this.group = response.data[0]
                    // this.currentPage = this.group.title
                    // this.numImages = this.group.group_images.length
                    this.items = response.data.data;
                    console.log(this.items);
                });
            }
        },

        mounted() {
            this.getImages()
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
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
        z-index: 10;
    }
</style>