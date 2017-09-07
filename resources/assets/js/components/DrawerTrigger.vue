<template>
	<v-toolbar-side-icon dark @click.native.stop="toggleDrawer"></v-toolbar-side-icon>
</template>

<script>
    export default {
        data () {
            return {
                drawer: true,
                isOpen: true
            }
        },

        methods: {
        	toggleDrawer() {
                // emit a global event when the drawer button is toggled
                // this makes it easier to broadcast across views
                Bus.$emit('toggleDrawer', this.drawer = !this.drawer)
                // close or open the drawer
                this.isOpen = this.isOpen = !this.isOpen
            }
        }
    }
</script>

<style scoped>
	.toolbar > :first-child {
	    margin-left: 10px;
	}
</style>