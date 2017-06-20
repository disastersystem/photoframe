<template>
	<div class="modal is-active">
		<div>
			<header>
				<button v-on:click="$emit('close')"></button>
			</header>

			<section>
				<slot></slot>
			</section>
		</div>
	</div>
</template>

<script>
	export default {
        data() {
            return {
                show: false
            }
        },

        methods: {
        	close() {
        		console.log('closed')
        	}
        }
    }
</script>

<style scoped>
	.modal {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: red;
	}
</style>