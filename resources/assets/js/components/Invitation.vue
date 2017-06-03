<template>
    <v-flex xs6>
        <v-card class="elevation-0">
            <v-list subheader>
                <v-subheader>Invitasjoner</v-subheader>
                <v-list-item v-for="item in invitations" v-bind:key="item.title">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img v-bind:src="item.avatar"/>
                        </v-list-tile-avatar>
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
                invitations: [
                    { title: 'Jason Oner', avatar: '/path/' },
                    { title: 'Ranee Carlson', avatar: '/path/' },
                    { title: 'Cindy Baker Bake Bak', avatar: '/path/' },
                    { title: 'Ali Connors', avatar: '/path/' },
                ]
            }
        }
    }
</script>