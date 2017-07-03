<template>
    <div>
        <div class="b-modal b-is-active" v-if="showModal">
            <div class="b-modal-background"></div>

            <div class="b-modal-card">
                <header class="b-modal-card-head">
                    <h2 class="b-modal-card-title">
                        Legg til bilder
                    </h2>
            
                    <button class="b-modal-close" @click="$emit('close')"></button>
                </header>

                <section class="b-modal-card-body">
                    <div class="modal-content-row">
                        <p>Trykk på boksen under, eller dra bilder til boksen for å laste opp.</p>
                    </div>

                    <div class="modal-content-row">
                        <dropzone id="myVueDropzone"
                            ref="dropzoneInstance"
                            :maxFileSizeInMB="maxSize"
                            :headers="csrfToken"
                            :url="url"
                            :language="{ dictDefaultMessage: '<br>Dra filer hit for å laste opp' }"
                            :showRemoveLink="false"
                            @vdropzone-success="showSuccess">
                        </dropzone>
                    </div>

                    <v-card-row actions>
                        <!-- "blue--text darken-1" -->
                        <!-- <div @click="closeModal()">
                            <v-btn class="close-button elevation-1">
                                Lukk
                            </v-btn>
                        </div> -->
                    </v-card-row>
                </section>
                
                <!-- <footer class="b-modal-card-foot">
                </footer> -->
            </div>
        </div>

        <div @click="openModal()">
            <v-btn success light>
                Legg til bilder
                <i class="material-icons icon icon--dark icon--light icon--right">
                    cloud_upload
                </i>
            </v-btn>
        </div>
    </div>
</template>

<script>
    import $ from "jquery"
    import Dropzone from 'vue2-dropzone'
    import Modal from '../utilities/Modal'

    export default {
        data () {
            return {
                showModal: false,
                show: false,
                csrfToken: {
                    'X-CSRF-Token': window.Laravel.csrfToken
                },
                maxSize: 20,
                url: 'group/' + this.$route.params.id + '/photo/add'
            }
        },

        components: {
            Dropzone,
            Modal
        },

        // react to route changes
        watch: {
            '$route' (to, from) {
                // update the upload url with the new group id
                console.log(this.$refs)
                this.$refs.dropzoneInstance.setOption('url', 'group/' + to.params.id + '/photo' + '/add')
            }
        },

        methods: {
            showSuccess(file, uploaded_file) {
                this.$emit('eventchild', uploaded_file)
            },

            // closeDialog() {
            //     this.dialog = false
            //     // empty uploaded files
            //     this.$refs.dropzoneInstance.removeAllFiles()
            // },

            openModal() {
                this.showModal = true
            },

            closeModal() {
                this.showModal = false
                // empty uploaded files
                this.$refs.dropzoneInstance.removeAllFiles()
            }
        }
    }
</script>

<style scoped>
    .modal-content-row {
        padding: 20px;
    }

    .close-button {
        /*margin-right: 15px;*/
        margin-top: 30px;
    }

    .b-modal-background {
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        background-color: rgba(10, 10, 10, 0.6);
        z-index: 900;
    }

    .b-modal-content,
    .b-modal-card {
        margin: 0;
        max-height: calc(100vh - 160px);
        overflow: auto;
        position: relative;
        width: 100%;
        z-index: 950;
    }

    @media screen and (min-width: 769px), print {
        .b-modal-content,
        .b-modal-card {
            margin: 10px auto;
            max-height: calc(100vh - 40px);
            width: 500px;
        }
    }

    @media screen and (max-width: 768px), print {
        .b-modal-content,
        .b-modal-card {
            width: 94%;
        }
    }

    .b-modal-close {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        background-color: rgba(10, 10, 10, 0.2);
        border: none;
        border-radius: 290486px;
        cursor: pointer;
        display: inline-block;
        -webkit-box-flex: 0;
        -ms-flex-positive: 0;
        flex-grow: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        font-size: 1rem;
        height: 30px;
        max-height: 30px;
        max-width: 30px;
        min-height: 30px;
        min-width: 30px;
        outline: none;
        position: relative;
        vertical-align: top;
        width: 30px;
    }

    .b-modal-close:before, .b-modal-close:after {
        background-color: white;
        content: "";
        display: block;
        left: 50%;
        position: absolute;
        top: 50%;
        transform: translateX(-50%) translateY(-50%) rotate(45deg);
        transform-origin: center center;
    }

    .b-modal-close:before {
        height: 2px;
        width: 50%;
    }

    .b-modal-close:after {
        height: 50%;
        width: 2px;
    }

    .b-modal-close:hover, .b-modal-close:focus {
        background-color: rgba(10, 10, 10, 0.3);
    }

    .b-modal-close:active {
        background-color: rgba(10, 10, 10, 0.4);
    }

    .b-modal-card {
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 40px);
        overflow: hidden;
    }

    .b-modal-card-head,
    .b-modal-card-foot {
        align-items: center;
        background-color: whitesmoke;
        display: flex;
        flex-shrink: 0;
        justify-content: flex-start;
        padding: 20px 20px 0 20px;
        position: relative;
    }

    .b-modal-card-head {
        border-bottom: 1px solid #dbdbdb;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
    }

    .b-modal-card-title {
        color: #363636;
        flex-grow: 1;
        flex-shrink: 0;
        font-size: 1.5rem;
        line-height: 1;
    }

    .b-modal-card-foot {
        border-bottom-left-radius: 2px;
        border-bottom-right-radius: 2px;
        border-top: 1px solid #dbdbdb;
    }

    .b-modal-card-foot .button:not(:last-child) {
        margin-right: 10px;
    }

    .b-modal-card-body {
        -webkit-overflow-scrolling: touch;
        background-color: white;
        flex-grow: 1;
        flex-shrink: 1;
        overflow: auto;
        /*padding: 20px;*/
    }

    .b-modal {
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        align-items: center;
        display: none;
        justify-content: center;
        overflow: hidden;
        position: fixed;
        z-index: 20;
    }

    .b-modal.b-is-active {
        display: flex;
    }
</style>