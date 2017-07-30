<template>
    <div>
       <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 5">

            <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden" style="z-index: 5">
                    <div class="pswp__top-bar">
                        <!--  Controls -->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Lukk (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Fullskjerm"></button>

                        <v-menu transition="v-scale-transition" offset-y>
                            <v-btn slot="activator" light flat>
                                Tidsintervall
                            </v-btn>
                            <v-list>
                                <v-list-item v-for="interval in intervals" :key="interval.time" @click="changeInterval(interval.time)">
                                    <v-list-tile>
                                        <v-list-tile-title>{{ interval.title }}</v-list-tile-title>
                                    </v-list-tile>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                        
                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                              <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div> 
                    </div>

                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>

                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- v-if="photos.length > 0" -->
        <div class="photoframe-launcher">
            <div @click="open">
                <v-btn primary light class="btn-photoframe">
                    start bilderammemodus
                </v-btn>
            </div>
        </div>
    </div>
</template>

<script>
    import PhotoSwipe from 'photoswipe'
    import PhotoSwipeDefaultUI from 'photoswipe/dist/photoswipe-ui-default'

    export default {
        data() {
            return {
                intervals: [
                    { time: 60000, title: '30 sekunder' },
                    { time: 120000, title: '1 minutt' },
                    { time: 300000, title: '2 minutter' },
                    { time: 600000, title: '5 minutter' },
                    { time: 1800000, title: '10 minutter' },
                    { time: 3600000, title: '30 minutter' },
                    { time: 86400000, title: '1 dag' }
                ],
                interval: 5000,
                loopGallery: 0,
                photos: []
            }
        },

        methods: {
            open() {
                let pswpElement = document.querySelectorAll('.pswp')[0]

                let gallery = new PhotoSwipe(
                    pswpElement,
                    PhotoSwipeDefaultUI,
                    this.photos,
                    {
                        index: 0, // start at first slide
                        closeOnScroll: false,
                        counterEl: false,
                        fullscreenEl: false,
                        arrowEl: false,
                        shareEl: false,
                        clickToCloseNonZoomable: false,
                        closeElClasses: [],
                        spacing: 0.12,
                        bgOpacity: 1
                    }
                )
                
                gallery.init()

                var loopGallery = window.setInterval(function() {
                    gallery.next()
                }, 5000)
                
                gallery.listen('destroy', function() {
                    window.clearInterval(loopGallery)
                })
            },

            changeInterval(time) {
                // this.interval = time

                // window.clearInterval(this.loopGallery)

                // this.loopGallery = window.setInterval(function() {
                //     gallery.next()
                // }, this.interval)
            }
        },

        mounted() {
            /* fetch all photos */
            axios.get('photo/all/get').then(response => {
                this.photos = response.data.data
            })
        }
    }
</script>

<style scoped>
    @import "~photoswipe/dist/photoswipe.css";
    @import "~photoswipe/dist/default-skin/default-skin.css";

    .photoframe-launcher {
        position: fixed;
        /*display: flex;*/
        /*justify-content: center;*/
        bottom: 0px;
        left: 0;
        right: 0;
        margin: 0;
        width: 100%;
        z-index: 1;
        padding: 0;
        background: red;
    }

    .btn-photoframe {
        font-size: 20px;
        background: #3486D7;
        color: #fff;
        border-radius: 0;
        /*padding: 0;*/
        width: 100%;
        margin: 0;
    }
</style>