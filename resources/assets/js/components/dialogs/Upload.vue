<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" width="600px" persistent>
            <v-btn success light slot="activator" style="margin-right: 30px;">
                Legg til bilder
                <i class="material-icons icon icon--dark icon--light icon--right">
                    cloud_upload
                </i>
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
                            ref="dropzoneInstance"
                            :maxFileSizeInMB="maxSize"
                            :dropzone-options="options"
                            :use-custom-dropzone-options="true"
                            :url="url"
                            :language="{ dictDefaultMessage: '<br>Dra filer hit for å laste opp' }"
                            :showRemoveLink="false"
                            @vdropzone-success="showSuccess">
                        </dropzone>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions class="dialog-footer">
                    <!-- <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Lukk</v-btn> -->
                    <v-btn class="elevation-1" @click.native="closeDialog" style="margin-right: 12px;">Lukk</v-btn>
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
                options: {  
                    headers: {
                        'X-CSRF-Token': window.Laravel.csrfToken
                    }
                },
                maxSize: 20,
                url: 'group/' + this.$route.params.id + '/photo/add'
            }
        },

        components: {
            Dropzone
        },

        // react to route changes
        watch: {
            '$route' (to, from) {
                // update the upload url with the new group id
                this.$refs.dropzoneInstance.setOption('url', 'group/' + to.params.id + '/photo' + '/add')
            }
        },

        methods: {
            showSuccess(file, uploaded_file) {
                this.$emit('success', uploaded_file)
            },

            closeDialog() {
                this.dialog = false
                // empty uploaded files
                // this.$refs.dropzoneInstance.removeAllFiles() // currently bugged in this dropzone version
                // this.$refs.dropzoneInstance.$el.innerHTML=''
                let elements = this.$refs.dropzoneInstance.$el.getElementsByClassName('dz-preview')
                while(elements.length > 0) {
                    elements[0].parentNode.removeChild(elements[0])
                }
            }
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }

    .dialog-footer {
        border-top: 1px solid #ddd;
        margin-top: 20px;
    }
</style>