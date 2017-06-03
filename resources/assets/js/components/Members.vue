<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" width="600">
            <v-btn success light slot="activator">
                Medlemmer
                <i class="material-icons icon icon--light icon--right">
                    person_add
                </i>
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Kanal Medlemmer</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <v-text-field xs12
                          name="person"
                          label="Søk etter en person"
                          single-line
                        ></v-text-field>

                        <v-layout>
                            <invitation></invitation>
                            <member></member>
                        </v-layout>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions>
                    <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Lukk</v-btn>
                    <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Lagre</v-btn>
                </v-card-row>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import Member from '../components/Member'
    import Invitation from '../components/Invitation'

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
</style>