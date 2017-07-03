<template>
    <div>
            <modal v-if="showModal" @close="closeModal()">
                <p class="help-text">
                    Ved å opprette en gruppe vil du få tilgang til å 
                    dele bilder privat med venner og familie.
                </p>
                
                <div>
                    <v-text-field
                        name="groupname"
                        class="input-group--focused"
                        label="Skriv inn et gruppenavn"
                        v-model="form.title">
                    </v-text-field>
                </div>
                


                
                <v-divider></v-divider>

                
                <!-- <v-btn @click.native="dialog = false">
                    <i class="material-icons icon icon--left">
                        keyboard_backspace
                    </i>
                    Avbryt
                </v-btn> -->
                <v-btn class="white--text" success @click.native="saveGroup" :disabled="form.title == ''">
                    Lagre
                </v-btn>

        </modal>

        <div @click="openModal()">
            <v-btn success class="green white--text">
                Legg til gruppe
                <i class="material-icons icon icon--light icon--right">
                    add
                </i>
            </v-btn>
        </div>
    </div>
</template>

<script>
    import Form from '../../core/Form'
    import modal from '../utilities/Modal'

    export default {
        data () {
            return {
                showModal: false,

                form: new Form({
                    title: ''
                })
            }
        },

        components: {
            modal
        },

        methods: {
            saveGroup() {
                if (this.form.title.length != 0) {
                    this.form.post('group/add').then(response => {
                        this.$emit('event_child', { id: response.id, title: response.title })
                        
                        this.form.title = ''

                        this.showModal = false

                        // show body scrollbar
                        document.documentElement.style.overflowY = null
                        document.documentElement.style.paddingRight = null
                    })


                } else {
                    // set form error
                }
            },

            openModal() {
                this.showModal = true

                // hide body scrollbar and apply padding to avoid page "jumping"
                document.documentElement.style.overflowY = 'hidden'
                document.documentElement.style.paddingRight = '17px'
            },

            closeModal() {
                this.showModal = false

                // show body scrollbar
                document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
            },

            close() {
                this.showModal = false

                // show body scrollbar
                document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
            }
        }
    }
</script>

<style scoped>
    .help-text {
        margin-bottom: 50px;
    }

    .card {
        background: #fff;
    }

    .dialog-footer {
        border-top: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }
</style>