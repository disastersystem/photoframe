<template>
    <v-layout row justify-center style="z-index: 8999;">
        <v-dialog v-model="dialog" width="600px" persistent style="z-index: 8999;">
            <v-btn success light slot="activator" style="margin-right: 30px;">
                Legg til bilder
                <i class="material-icons icon icon--dark icon--light icon--right">cloud_upload</i>
            </v-btn>
            <v-card>
                <v-card-row>
                    <v-card-title>Velg bilder å legge til</v-card-title>
                </v-card-row>
                <v-card-row>
                    <p style="padding-left: 20px;">Trykk på boksen under, eller dra bilder til boksen for å laste opp.</p>
                </v-card-row>
                <v-card-row>
                    <v-card-text>
                        <dropzone id="myVueDropzone" 
                            :maxFileSizeInMB="maxSize"
                            v-bind:headers="csrfToken"
                            v-bind:url="groupUrl"
                            v-on:vdropzone-success="showSuccess">
                        </dropzone>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions style="border-top: 1px solid #ddd; margin-top: 20px;">
                    <!-- <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Lukk</v-btn> -->
                    <v-btn class="elevation-1" @click.native="dialog = false" style="margin-right: 12px;">Lukk</v-btn>
                </v-card-row>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import $ from "jquery"
    import Dropzone from 'vue2-dropzone'

    export default {
        data () {
            return {
                dialog: false,
                csrfToken: { 
                    'X-CSRF-Token': window.Laravel.csrfToken
                },
                maxSize: 20,
                groupId: this.$route.params.id
            }
        },

        computed: {
            groupUrl() {
                return 'group/' + this.groupId + '/photo'
            }
        },

        components: {
            Dropzone
        },

        // react to route changes...
        watch: {
            '$route' (to, from) {
                this.groupId = this.$route.params.id
            }
        },

        methods: {
            showSuccess(file, uploaded_file) {
                // empty upload field
                // set no size limit
                this.$emit('eventchild', uploaded_file)
            }
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }

    .dialog {
        width: 100vw;
        height: 100vh;
    }
</style>