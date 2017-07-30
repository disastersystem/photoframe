<template>
	<div>
		<div>
			<v-toolbar class="white elevation-0">
	            <drawertrigger></drawertrigger>
	        </v-toolbar>
		</div>
			
	    <div class="view-container">
			<p>
				<v-icon>arrow_back</v-icon>
				Velg eller opprett en gruppe.
			</p>
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
	.view-container {
		padding: 40px 30px;
	}
</style>