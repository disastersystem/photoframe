<template>
    <div>
        <vodal :show="show" animation="slideUp" @hide="closeVodal" :width="vWidth" :height="vHeight">
            <carousel :auto="auto" :watch-items="photos">
                <carousel-item v-for="(photo, index) in photos">
                    <img v-bind:src="photo.filepath" :key="index">
                </carousel-item>
            </carousel>
        </vodal>

        <button class="btn scale" style="animation-delay: 600ms;" @click="show = true; auto = 3000">
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

        computed: {
            vWidth() { return window.innerWidth },
            vHeight() { return window.innerHeight }
        },

        components: {
            Vodal,
            'carousel': Carousel,
            'carousel-item': CarouselItem
        },

        methods: {
            setPhotos() {
                axios.get('getphotos').then(response => {
                    this.photos = response.data.data
                })
            },

            closeVodal() {
                this.show = false
                this.auto = 0
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

    /*.carousel {
        height: 100%;
        margin: 0;
    }*/

    .v-carousel{width:100%;position:relative}
    .v-carousel,.v-carousel-items{overflow:hidden}
    .v-carousel-dots{position:absolute;bottom:10px;left:0;width:100%;text-align:center}
    .v-carousel-dot{cursor:pointer;display:inline-block;width:10px;height:10px;margin:0 5px;border-radius:5px;background:rgba(0,0,0,.5)}
    .v-carousel-dot.active{background:#000;cursor:default}
    .v-carousel-nav{cursor:pointer;position:absolute;line-height:30px;color:#fff;padding:0 5px;background:rgba(0,0,0,.5);top:50%;margin-top:-15px}
    .v-carousel-nav.prev{left:0}
    .v-carousel-nav.next{right:0}
    .v-carousel-item{width:100%;float:left}
</style>