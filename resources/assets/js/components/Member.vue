<template>
    <v-flex xs12 sm12 md12 lg12 xl12>
        <v-card class="elevation-0">
            <v-list subheader>
                <v-subheader>Medlemmer</v-subheader>
                <v-list-item v-for="item in members" v-bind:key="item.title">
                    <v-list-tile avatar>
                        <!-- <v-list-tile-avatar>
                            <img v-bind:src="item.avatar"/>
                        </v-list-tile-avatar> -->
                        <v-list-tile-content>
                            <v-list-tile-title v-html="item.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-item>
            </v-list>
        </v-card>
    </v-flex>
</template>

<script> 
    export default {
        data () {
            return {
                members: [
                    { title: 'Magnus Johansen', avatar: '/path/' },
                    { title: 'Anders Johansen', avatar: '/path/' }
                ]
            }
        }
    }
</script>