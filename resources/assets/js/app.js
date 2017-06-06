import './bootstrap'
import router from './router'

import CreateGroup from './components/CreateGroup'
import PhotoFrame from './components/PhotoFrame'

Vue.component('drawer', {
	template: `
		<div>
			<v-navigation-drawer class="grey lighten-4 pb-0" permanent absolute height="100%" light>
				<!-- <v-toolbar-side-icon light></v-toolbar-side-icon> -->
				<creategroup style="margin: 20px 0;"></creategroup>
				<v-list dense>
					<template v-for="(item, i) in items">
						<v-layout row v-if="item.heading" align-center :key="i">
							<v-flex xs12>
								<v-subheader v-if="item.heading">
									{{ item.heading }}
								</v-subheader>
							</v-flex>
						</v-layout>
						
						<v-divider dark v-else-if="item.divider" class="my-4" :key="i"></v-divider>

						<v-list-item :key="i" v-else>
							<v-list-tile>
								<v-list-tile-content>
					                <router-link :to="'/group/' + item.id" class="nav-item">{{ item.text }}</router-link>
								</v-list-tile-content>
							</v-list-tile>
						</v-list-item>
					</template>
				</v-list>
				

			</v-navigation-drawer>
		</div>
	`,

	data() {
		return {
			items: [
				// { heading: 'Opprett en gruppe' },
				// { icon: 'add', text: 'Lag en ny gruppe', url: 'opprett-gruppe' },
				// { divider: true },
				{ heading: 'Grupper' },
				{ id: 1, icon: '', text: 'Tyristrand', selected: false },
				{ id: 2, icon: '', text: 'Familie', selected: false },
				{ id: 3, icon: '', text: 'Turgjengen', selected: false }
			]
		}
	},

	components: {
		'creategroup': CreateGroup,
		'photoframe': PhotoFrame
	}
})


new Vue({
    el: '#app',
    
    router
})
