<template>
    <v-flex xs12 sm12 md12 lg12 xl12>
        <search v-on:newMemberID="newMemberID"></search>

        <v-card class="elevation-0">
            <v-list subheader>
                <v-subheader>Invitasjoner</v-subheader>
                <v-list-item v-for="item in invitations" v-bind:key="item.title">
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
    import Search from '../components/Search'

    export default {
        data () {
            return {
                invitations: [
                ]
            }
        },

        components: {
            'search': Search
        },

        methods: {
            newMemberID(id) {
                if (id == 45) {
                    this.invitations.unshift(
                        { id: 45, title: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' }
                    ) 
                } else {
                    this.invitations.unshift(
                        { id: 23, title: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' }
                    )
                }
                // axios.get('getuser/' + id).then(response => {
                //     // this.group = response.data[0]
                //     // this.invitations.unshift(data)
                //     console.log(response.data);
                // })
            }
        }
    }
</script>