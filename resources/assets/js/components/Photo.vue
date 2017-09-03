<template>
	<transition name="fade">
		<img :src="url" v-if="show">
	</transition>
</template>

<script>
	export default {
        data() {
            return {
            	show: false,
                url: ''
            }
        },

        props: ['src'],

        mounted() {
        	let photo = new Image()
        	let that = this

        	photo.src = this.src

            /* wait until photo is fully loaded before displaying */
        	photo.onload = function() {
        		that.url = that.src

        		/* trigger fade in animation */
        		that.show = true
        	}
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