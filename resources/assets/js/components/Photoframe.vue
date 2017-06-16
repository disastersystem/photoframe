<template>
    <div>
        <vodal :show="show" animation="slideUp" @hide="show = false"
        :width="vWidth" :height="vHeight" :closeButton="true" style="border-radius: 0;">
            <!-- <div>A vue modal with animations.</div> -->
            <v-carousel icon="stop">
                <v-carousel-item v-for="(photo, i) in photos" v-bind:src="photo.filepath" :key="i"></v-carousel-item>
            </v-carousel>
        </vodal>

        <button class="btn scale" style="animation-delay: 600ms;" @click="show = true">
            start bilderammemodus
        </button>
    </div>
</template>

<script>
    import Vodal from 'vodal';

    export default {
        data() {
            return {
                show: false,

                photos: []
            }
        },

        computed: {
            vWidth() { return window.innerWidth },
            vHeight() { return window.innerHeight }
        },

        components: {
            Vodal
        },

        methods: {
            setPhotos() {
                axios.get('getphotos').then(response => {
                    this.photos = response.data.data;
                })
            }
        },

        mounted() {
            this.setPhotos()
        }
    }
</script>

<style scoped>
    .btn {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        width: 100%;
        z-index: 90;
        font-size: 20px;
        background: #3486D7;
        color: #fff;
    }

    .carousel {
        height: 100%;
        margin: 0;
    }

    .carousel .carousel__controls {
        visibility: hidden;
        display: none;
    }

    .carousel .carousel__left {
        visibility: hidden;
        display: none;
    }
</style>