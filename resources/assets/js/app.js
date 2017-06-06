import './bootstrap'
import router from './router'

import CreateGroup from './components/CreateGroup'
import PhotoFrame from './components/PhotoFrame'

Vue.component('drawer', {
	template: `
		<div>
			<v-navigation-drawer class="grey lighten-4 pb-0" permanent absolute height="100%" light>
				<!-- <v-toolbar-side-icon light></v-toolbar-side-icon> -->
				<creategroup v-on:event_child="eventChild" style="margin: 20px 0;"></creategroup>
				<v-layout row align-center>
							<v-flex xs12>
								<v-subheader>
									Grupper
								</v-subheader>
							</v-flex>
						</v-layout>
				<v-list dense>
					<template v-for="(group, i) in groups">
						
						
						<!-- <v-divider dark class="my-4" :key="i"></v-divider> -->

						<v-list-item>
							<v-list-tile>
								<v-list-tile-content>
					                <router-link :to="'/group/' + group.id" class="nav-item">{{ group.title }}</router-link>
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
			],
			groups: []
		}
	},

	components: {
		'creategroup': CreateGroup,
		'photoframe': PhotoFrame
	},

	mounted() {
		axios.get('getgroups').then(response => {
        	this.groups = response.data;
        });
	},

	methods: {
		eventChild(data) {
			this.groups.unshift({ id: data.id, title: data.title })
		}
	}
})

new Vue({
    el: '#app',
    
    router
})
