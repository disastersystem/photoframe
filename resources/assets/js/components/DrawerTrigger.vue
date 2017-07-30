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
                Bus.$emit('toggleDrawer', this.drawer = !this.drawer)
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