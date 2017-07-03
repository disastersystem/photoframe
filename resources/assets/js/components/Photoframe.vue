<template>
    <div>
        <vodal :mask="false" :show="show" animation="slideUp" @hide="closeVodal" :width="100" :height="100" measure="%">
            <div style="background: red; position: fixed; top: 0; left: 0; height: 40px;"></div>

            <carousel :auto="auto" :watch-items="photos">
                <carousel-item v-for="(photo, index) in photos">
                    <img v-bind:src="photo.filepath" :key="index">
                </carousel-item>
            </carousel>
        </vodal>

        <button class="btn scale" style="animation-delay: 600ms;" @click="openModal">
            <!-- v-if="photos.length > 0" -->
            start bilderammemodus
        </button>
    </div>
</template>

<script>
    import Vodal from 'vodal'
    import { Carousel, CarouselItem } from 'vue-l-carousel'

    export default {
        data() {
            return {
                show: false,
                auto: 3000,

                photos: []
            }
        },

        components: {
            Carousel,
            CarouselItem,
            Vodal
        },

        methods: {
            setPhotos() {
                axios.get('photo/all/get').then(response => {
                    this.photos = response.data.data
                })
            },

            openModal() {
                this.show = true
                this.auto = 3000

                // hide body scrollbar and apply padding to avoid page "jumping"
                document.documentElement.style.overflowY = 'hidden'
                document.documentElement.style.paddingRight = '17px'
            },

            closeVodal() {
                this.show = false
                this.auto = 0 // stop the carousel from running

                // show body scrollbar
                document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
            }
        },

        mounted() {
            this.setPhotos()
        }
    }
</script>

<style scoped>
    @import "~vodal/common.css";
    @import "~vodal/slide-up.css";

    .vodal {
        position: fixed;
        padding: 0;
        margin: 0;
    }

    .vodal-dialog {
        z-index: 101;
        padding: 0;
        background: #000;
        border-radius: 0;
        box-shadow: none;
    }

    .vodal-close {
        position: absolute;
        cursor: pointer;
        top: 16px;
        right: 26px;
        width: 16px;
        height: 16px;
        width: 30px;
        height: 30px;
        z-index: 999;
    }

    .btn {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        width: 100%;
        font-size: 20px;
        background: #3486D7;
        color: #fff;
        border-radius: 0;
        z-index: 1;
    }

    .v-carousel {
        max-width:100%;
        max-height:100%;
        position:relative;
    }
    .v-carousel, .v-carousel-items {
        max-width:100%;
        max-height:100%;
        overflow:hidden;
    }
    .v-carousel-item {
        max-width:100%;
        max-height:100%;
        float:left;
        background: #000;
    }
</style>