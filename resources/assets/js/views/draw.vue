<template>
    <v-app id="example-1">
        <v-navigation-drawer persistent v-model="drawer" light enable-resize-watcher>
            <v-list dense>
                <v-list-item>
                    
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar class="indigo" light>
            <v-toolbar-side-icon light @click.native.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Toolbar</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>

        <main>
            <v-navigation-drawer
                temporary
                v-model="left"
            ></v-navigation-drawer>
            
            <v-container fluid>
                <!--v-router-->
            </v-container>
        </main>
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                drawer: true,
                left: null
            }
        }
    }
</script>