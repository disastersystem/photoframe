<template>
    <div>
        <modal :show="dialog" @close="onDialogClose" title="Bildeopplasting" :width="550">
            <div class="row">
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
            </div>
        </modal>

        <v-btn success light @click.native="dialog = true">
            Legg til bilder
            <i class="material-icons icon icon--dark icon--light icon--right">
                cloud_upload
            </i>
        </v-btn>
    </div>
</template>

<script>
    import $ from "jquery"
    import dropzone from 'vue2-dropzone'
    import modal from '../utilities/Modal'

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
            dropzone,
            modal
        },

        watch: {
            /* react to route changes */
            '$route' (to, from) {
                // update the upload url with the new group id
                this.$refs.dropzoneInstance.setOption('url', 'group/' + to.params.id + '/photo/add')
            }
        },

        methods: {
            showSuccess(file, uploaded_file) {
                this.$emit('success', uploaded_file)
            },

            onDialogClose() {
                this.dialog = false

                /* empty uploaded files */
                this.$refs.dropzoneInstance.removeAllFiles()
            }
        }
    }
</script>

<style scoped>
    .row {
        padding: 15px;
    }
</style>