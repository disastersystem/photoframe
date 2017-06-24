<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" scrollable persistent width="350px">
            <v-btn class="indigo" slot="activator">
                <!-- Medlemmer -->
                <i class="material-icons icon icon--light icon--center">
                    person_add
                </i>
            </v-btn>

            <v-card>
                <v-card-title>Gruppemedlemmer</v-card-title>

                <v-divider></v-divider>

                <v-card-row>
                    <p class="help-text">Legg til venner eller familie du vil dele fotosamlingen med.
                    Du kan søke på e-post adresse, eller navn på de som allerede er registrert.</p>
                </v-card-row>

                <v-card-row>
                    <v-card-text style="padding-bottom: 0;">
                        <v-menu offset-y style="">
                            <v-text-field
                                name="person"
                                label="Søk etter en person"
                                prepend-icon="search"
                                class="input-group--focused"
                                slot="activator">
                            </v-text-field>

                            <v-list>
                                <v-list-item v-for="item in items" :key="item">
                                    <v-list-tile avatar>
                                        <!-- <v-list-tile-avatar>
                                            <img v-bind:src="item.avatar">
                                        </v-list-tile-avatar> -->
                                        
                                        <v-list-tile-content style="margin: 10px 0;" @click="selected(item.id)">
                                            <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                            <v-list-tile-sub-title v-html="item.email"></v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-card-text>
                </v-card-row>

                <v-divider></v-divider>

                <v-card-row height="200px">
                    <v-card-text>
                        <v-flex xs12 sm12 md12 lg12 xl12>
                            <v-card class="elevation-0">
                                <v-list subheader>
                                    <v-subheader v-if="members.length > 0">Medlemmer</v-subheader>
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
                    </v-card-text>
                </v-card-row>

                <v-divider></v-divider>

                <v-card-row actions class="dialog-footer">
                    <v-btn @click.native="dialog = false">
                        <i class="material-icons icon icon--left">
                            keyboard_backspace
                        </i>
                        Tilbake
                    </v-btn>
                    <v-btn class="white--text" success @click.native="dialog = false" :disabled="invitations.length == 0">
                        Lagre
                    </v-btn>
                </v-card-row>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        data () {
            return {
                dialog: false,

                items: [
                    { id: 45, name: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' },
                    { id: 23, name: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' }
                ],

                invitations: [],

                members: [
                    { title: 'Magnus Johansen', avatar: '/path/' },
                    { title: 'Anders Johansen', avatar: '/path/' }
                ]
            }
        },

        methods: {
            selected(id) {
                if (id == 45) {
                    this.invitations.unshift(
                        { id: 45, title: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' }
                    )
                    this.members.unshift(
                        { id: 45, title: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' }
                    )
                } else {
                    this.invitations.unshift(
                        { id: 23, title: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' }
                    )
                    this.members.unshift(
                        { id: 23, title: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' }
                    )
                }
            }
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
        /*height: 100vh;*/
    }

    .dialog-footer {
        display: flex;
        justify-content: space-between;
    }

    .help-text {
        padding: 10px;
        margin-bottom: 0;
        /*padding-bottom: 0;*/
    }
</style>