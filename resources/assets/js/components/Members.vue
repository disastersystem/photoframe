<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" width="400">
            <v-btn class="indigo" slot="activator">
                <!-- Medlemmer -->
                <i class="material-icons icon icon--light icon--center">
                    person_add
                </i>
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Gruppemedlemmer</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <p>Legg til venner eller familie du vil dele fotosamlingen med.
                        Du kan søke på e-post adresse, eller navn på de som allerede er registrert.</p>

                        <div>
                            <invitation></invitation>
                            <member style="margin-top: 50px;"></member>
                        </div>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions class="dialog-footer">
                    <v-btn class="" @click.native="dialog = false">
                        <i class="material-icons icon icon--left">
                            keyboard_backspace
                        </i>
                        Tilbake
                    </v-btn>
                    <v-btn class="white--text" success @click.native="dialog = false">Lagre</v-btn>
                </v-card-row>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import Member from '../components/Member'
    import Invitation from '../components/Invitation'
    import Search from '../components/Search'

    export default {
        data () {
            return {
                dialog: false
            }
        },

        components: {
            'member': Member,
            'invitation': Invitation
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }

    .dialog-footer {
        border-top: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }
</style>