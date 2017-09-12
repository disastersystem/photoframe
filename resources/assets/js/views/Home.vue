<template>
	<div>
		<v-toolbar class="elevation-0">
            <drawertrigger></drawertrigger>
        </v-toolbar>

        <div class="status-message">
			<v-icon class="arrow-icon">arrow_back</v-icon>
			&nbsp;Velg eller opprett en gruppe.
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
	.status-message {
        padding: 30px;
        font-size: 18px;
        color: #ccc;
        font-weight: 500;
        font-size: 18px;
        text-transform: uppercase;

        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        width: 100%;
        text-align: center;
    }

    .arrow-icon {
    	color: #ccc;
    }

	.toolbar {
		display: flex;
		align-items: center;
	}
</style>