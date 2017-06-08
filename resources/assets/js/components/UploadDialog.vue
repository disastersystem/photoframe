<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" width="600">
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
                        <dropzone id="myVueDropzone" 
                            :maxFileSizeInMB="maxsize"
                            v-bind:headers="csrfToken"
                            v-bind:url="groupurl"
                            v-on:vdropzone-success="showSuccess">
                            <!-- Optional parameters if any! -->
                            <!-- <input type="hidden" name="token" v-bind:value="tok"> -->
                        </dropzone>
                    </v-card-text>
                </v-card-row>
                <v-card-row actions>
                    <!-- <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Lukk</v-btn> -->
                    <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Avbryt</v-btn>
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
                maxsize: 20,
                groupId: this.$route.params.id
            }
        },

        components: {
            Dropzone
        },

        watch: {
            '$route' (to, from) {
                // react to route changes...
                this.groupId = this.$route.params.id
            }
        },

        computed: {
            groupurl() {
                return 'group/' + this.groupId + '/photo'
            }
        },

        methods: {
            showSuccess(file, uploaded_file) {
                // empty upload field
                // set no size limit
                // console.log('A file was successfully uploaded')
                // self.group.group_images.unshift(response);
                // console.log(uploaded_file);
                this.$emit('eventchild', uploaded_file)
            }
        }
    }
</script>

<style scoped>
    .card {
        background: #fff;
    }
</style>