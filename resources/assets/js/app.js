import './bootstrap'
import router from './router'

import creategroup from './components/dialogs/CreateGroup'
import photoframe from './components/Photoframe'


Vue.component('main-layout', {
	template: `
		<div>
	        <v-navigation-drawer persistent v-model="drawer" light enable-resize-watcher>
	        	
	        	<creategroup v-on:event_child="eventChild" style="margin: 150px 0 40px 0;"></creategroup>
				
				<v-layout row align-center style="margin-bottom: -10px;">
					<v-flex xs12>
						<v-subheader>
							Grupper
						</v-subheader>
					</v-flex>
				</v-layout>

	            <v-list>
	                <template v-for="(group, i) in groups">
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

	        <main>
	            <v-navigation-drawer temporary v-model="left"></v-navigation-drawer>
	            
	            <v-toolbar class="elevation-0 menu-bar" flat>
		            <v-toolbar-side-icon dark @click.native.stop="drawer = !drawer"></v-toolbar-side-icon>
		        </v-toolbar>

	            <div>
	                <transition mode="out-in" appear name="custom-classes-transition" enter-active-class="animated fadeIn">
	                    <router-view></router-view>
	                </transition>
	            </div>
	        </main>

	        <photoframe></photoframe>
	    </div>
	`,

	data() {
		return {
			groups: [],
			drawer: true,
			left: null
		}
	},

	components: {
		creategroup, photoframe
	},

	mounted() {
		axios.get('getgroups').then(response => {
        	this.groups = response.data;
        })
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
