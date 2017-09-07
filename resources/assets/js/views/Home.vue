<template>
	<div>
		<div>
			<v-toolbar class="white elevation-0">
	            <drawertrigger></drawertrigger>

	            <div class="message">
					<v-icon>arrow_back</v-icon>
					Velg eller opprett en gruppe.
				</div>
	        </v-toolbar>
		</div>
	</div>
</template>

<script>
	import drawertrigger from '../components/DrawerTrigger'

	export default {
        components: {
        	drawertrigger
        }
    }
</script>

<style scoped>
	.message {
		margin-left: 20px;
	}
</style>