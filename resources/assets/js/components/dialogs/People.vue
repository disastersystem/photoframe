<template>
    <div>
        <modal v-if="showModal" @close="closeModal()" title="Gruppemedlemmer">
            <div class="modal-content-row">
                <p class="help-text">Legg til venner eller familie du vil dele fotosamlingen med.
                Du kan søke på e-post adresse, eller navn på de som allerede er registrert.</p>
            </div>

            <div class="modal-content-row">
                <v-menu offset-y style="margin: 20px 0 0 0; padding: 0; width: 98%;">
                    <v-text-field style="width: 90%;"
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
                                
                                <v-list-tile-content @click="selected(item.id)">
                                    <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                    <v-list-tile-sub-title v-html="item.email"></v-list-tile-sub-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </div>

            <v-divider></v-divider>

            <div class="modal-content-row">
            <!-- <v-flex xs12 sm12 md12 lg12 xl12> -->
                <v-card class="elevation-0" style="margin-top: 10px;">
                    <v-list subheader>
                        <v-subheader v-if="members.length > 0">Medlemmer</v-subheader>
                        <v-list-item v-for="item in members" v-bind:key="item.title">
                            <v-list-tile avatar>
                                <!-- <v-list-tile-avatar>
                                    <img v-bind:src="item.avatar">
                                </v-list-tile-avatar> -->
                                <v-list-tile-content>
                                    <v-list-tile-title v-html="item.title"></v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list-item>
                    </v-list>
                </v-card>
            <!-- </v-flex> -->
            </div>

            <!-- display: flex; justify-content: space-between; -->
            <v-card-row actions>
                <!-- <v-btn @click.native="dialog = false" flat>
                    <i class="material-icons icon icon--left">
                        keyboard_backspace
                    </i>
                    Tilbake
                </v-btn> -->
                <div @click="invitations.length > 0 ? closeModal() : ''">
                    <v-btn class="white--text" success :disabled="invitations.length == 0">
                        Lagre
                    </v-btn>
                </div>
            </v-card-row>
        </modal>

        <div @click="openModal()">
            <v-btn class="indigo">
                <i class="material-icons icon icon--light icon--center">
                    person_add
                </i>
            </v-btn>
        </div>
    </div>
</template>

<script>
    import modal from '../utilities/Modal'

    export default {
        data () {
            return {
                showModal: false,

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

        components: {
            modal
        },

        methods: {
            selected(id) {
                if (id == 45) {
                    this.invitations.unshift({ id: 45, title: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' })
                    this.members.unshift({ id: 45, title: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' })
                } else {
                    this.invitations.unshift({ id: 23, title: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' })
                    this.members.unshift({ id: 23, title: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' })
                }
            },

            openModal() {
                this.showModal = true

                // hide body scrollbar and apply padding to avoid page "jumping"
                document.documentElement.style.overflowY = 'hidden'
                document.documentElement.style.paddingRight = '17px'
            },

            closeModal() {
                this.showModal = false
                this.invitations = []

                // show body scrollbar
                document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
            },

            close() {
                this.showModal = false

                // show body scrollbar
                document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
            }
        }
    }
</script>

<style scoped>
    .modal-content-row {
        padding: 20px;    
    }

    .help-text {
        margin-bottom: 0;
        padding: 0 10px;
    }
</style>