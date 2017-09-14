<template>
	<!-- <transition name="fade"> -->
		<img :src="src" ref="thephoto">
        <!-- v-if="show" -->
	<!-- </transition> -->
</template>

<script>
	export default {
        data() {
            return {
            	// show: true,
                url: ''
            }
        },

        props: ['src'],

        mounted() {
            const img = new Image()
            // let that = this

            // this.$nextTick(function () {
                /* wait until photo is fully loaded before displaying */
                img.onload = function() {
                    this.url = this.src
                    // this.$refs.thephoto.src = this.src
                    // this.$el.src = this.src

                    /* trigger fade in animation */
                    // this.show = true
                }.bind(this)

                img.src = this.src
            // })
        }
    }
</script>

<style scoped>
	img {
		width: 100%;
		position: absolute;
		top: 0;
		left: 0;
	}
</style>