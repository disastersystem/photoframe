<template>
	<div>
        <v-navigation-drawer persistent v-model="drawer" enable-resize-watcher>
			
			<creategroup @created="addGroup"></creategroup>

			<v-layout row align-center class="sub-header-row">
				<v-flex xs12>
					<v-subheader v-if="groups.length > 0">
						Dine Grupper
					</v-subheader>

					<p class="no-groups-message" v-else>
						Du er ikke medlem av noen grupper enda.
					</p>
				</v-flex>
			</v-layout>

            <v-list style="background: #eee;">
                <template v-for="(group, i) in groups">
					<v-list-tile>
						<v-list-tile-content>
			                <router-link :to="'/group/' + group.id" class="nav-item">
			                	{{ group.title }}
			                </router-link>
						</v-list-tile-content>
					</v-list-tile>
				</template>
            </v-list>
        </v-navigation-drawer>

        <main>
            <transition mode="out-in" appear name="custom-classes-transition" enter-active-class="animated fadeIn">
                <router-view></router-view>
            </transition>
        </main>

        <photoframe></photoframe>
    </div>
</template>

<script>
	import creategroup from './dialogs/CreateGroup'
	import photoframe from './Frame'

	export default {
		data() {
			return {
				groups: [{}],
				drawer: true
			}
		},

		components: {
			creategroup,
			photoframe
		},

		mounted() {
			axios.get('group/all/get').then(response => {
	        	this.groups = response.data
	        })
		},

		methods: {
			addGroup(data) {
				this.groups.unshift({ id: data.id, title: data.title })
			}
		},

		created() {
			let self = this
			
			/* listen for a toggleDrawer broadcast */
			Bus.$on('toggleDrawer', function(state) {
				self.drawer = state
			})
		}
	}
</script>

<style scoped>
	.sub-header-row {
		margin-bottom: -10px;
	}

	.no-groups-message {
		padding: 20px;
	}

	.navigation-drawer {
	    z-index: 1; /* keep the drawer underneath the dialogs/modals */
	    background: #eee;
	}

	.navigation-drawer .list__item,
	.navigation-drawer .list__tile {
	    padding: 0;
	    margin: 0;
	}

	.navigation-drawer .nav-item {
	    display: flex;
	    width: 100%;
	    height: 100%;
	    align-items: center;
	    text-decoration: none;
	    padding: 30px;
	}

	/* Active main drawer item. */
	.is-active {
	    background: #ccc;
	}
</style>