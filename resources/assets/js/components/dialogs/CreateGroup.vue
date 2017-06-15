<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" scrollable persistent>
            <v-btn success slot="activator" class="green white--text">
                Legg til gruppe
                <i class="material-icons icon icon--light icon--right">
                    add
                </i>
            </v-btn>

            <v-card>
                <v-card-title>Opprett gruppe</v-card-title>
                
                <v-divider></v-divider>
                
                <v-card-row height="300px">
                    <v-card-text>
                        <p class="help-text">Ved å opprette en gruppe vil du få tilgang til å 
                        dele bilder privat med venner og familie.</p>
                        
                        <v-text-field
                            name="groupname"
                            
                            class="input-group--focused"
                            label="Skriv inn et gruppenavn"
                            v-model="form.title">
                        </v-text-field>    
                    </v-card-text>
                </v-card-row>
                
                <v-divider></v-divider>

                <v-card-row actions class="dialog-footer">
                    <v-btn @click.native="dialog = false">
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
    import Form from '../../core/Form';

    export default {
        data () {
            return {
                dialog: false,

                form: new Form({
                    title: ''
                })
            }
        },

        methods: {
            saveGroup() {
                if (this.form.title.length != 0) {
                    this.form.post('addgroup').then(response => {
                        this.$emit('event_child', { id: response.id, title: response.title })
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