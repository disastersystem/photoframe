<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" width="600">
            <v-btn class="green white--text" slot="activator">
                Legg til gruppe
                <i class="material-icons icon icon--light icon--right">
                    add
                </i>
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Opprett gruppe</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <v-layout>
                            <v-text-field xs8
                                name="groupname"
                                label="Skriv inn et gruppenavn"
                                v-model="groupname">
                            </v-text-field>
                        </v-layout>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions class="dialog-footer">
                    <v-btn class="" @click.native="dialog = false">
                        <i class="material-icons icon icon--left">
                            keyboard_backspace
                        </i>
                        Avbryt
                    </v-btn>
                    <v-btn class="white--text" success @click.native="saveGroup">Lagre</v-btn>
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
                groupname: ''
            }
        },

        components: {

        },

        methods: {
            saveGroup() {
                // throwAtBackendsFace(this.groupname);
                this.dialog = false
                this.groupname = ''
            }
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