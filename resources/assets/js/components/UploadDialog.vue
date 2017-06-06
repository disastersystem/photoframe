<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog">
            <v-btn success light slot="activator" style="margin-right: 30px;">
                Legg til bilder
                <i class="material-icons icon icon--dark icon--light icon--right">cloud_upload</i>
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Velg bilder å legge til</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <!-- <v-text-field label="Navn på gruppe"></v-text-field> -->
                        <!-- <v-file></v-file> -->
                        <input type="file" name="fileToUpload" id="fileToUpload">
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