<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog">
            <v-btn primary light slot="activator" style="margin-top: 40px;">
                <v-icon style="color: #fff; margin-left: 0; margin-right: 10px;">add</v-icon> Lag en ny gruppe
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Skriv inn gruppenavn</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <v-text-field label="Navn på gruppe"></v-text-field>
                        <!-- <small>*indicates required field</small> -->
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
    export default {
        data () {
            return {
                dialog: false
            }
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }
</style>