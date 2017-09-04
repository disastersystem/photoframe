<template>
    <div>
        <modal :show="dialog" @close="dialog = false" title="Opprett Gruppe">
            <!-- <h3>Opprett gruppe</h3> -->
            
            <div class="row">
                <p class="help-text">
                    Ved å opprette en gruppe vil du få tilgang til å 
                    dele bilder privat med venner og familie.
                </p>
            </div>

            <div class="row">
                <v-text-field
                    name="groupname"
                    class="input-group--focused"
                    label="Skriv inn et gruppenavn"
                    v-model="form.title"
                ></v-text-field>
            </div>
            
            <v-divider></v-divider>

            <v-card-row actions>
                <v-btn class="white--text" success @click.native="saveGroup" :disabled="form.title == ''">
                    Lagre
                </v-btn>
            </v-card-row>
        </modal>

        <v-btn class="green white--text" success @click.native="dialog = true">
            Legg til gruppe
            <i class="material-icons icon icon--light icon--right">
                add
            </i>
        </v-btn>
    </div>
</template>

<script>
    import modal from '../utilities/Modal'
    import Form from '../../core/Form'

    export default {
        data () {
            return {
                dialog: false,

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
                        this.$emit('created', { id: response.id, title: response.title })
                        this.dialog = false
                        this.form.title = ''
                    })
                } else {
                    // set form error
                }
            }
        }
    }
</script>

<style scoped>
    .row {
        padding: 15px;
    }
</style>