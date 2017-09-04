<template>
	<transition name="fade">
		<img :src="path" v-if="show">
	</transition>
</template>

<script>
	export default {
        data() {
            return {
            	show: true,
                url: ''
            }
        },

        props: ['path'],

        mounted() {
        	// let photo = new Image()
        	// let that = this

         //    /* wait until photo is fully loaded before displaying */
        	// photo.onload = function() {
        	// 	that.url = that.dd

        	// 	/* trigger fade in animation */
        	// 	that.show = true
        	// }

         //    photo.src = this.dd
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