<template>
    <div>
        <div class="row">
            <v-text-field
                title="Ved å opprette en gruppe vil du få tilgang til å dele bilder privat med venner og familie."
                name="groupname"
                class="input-group"
                label="Opprett ny gruppe"
                v-model="form.title"
            ></v-text-field>

            <v-btn class="white--text" success @click.native="saveGroup" :disabled="form.title == ''" v-if="form.title != ''">
                Opprett
            </v-btn>
        </div>
    </div>
</template>

<script>
    import modal from '../utilities/Modal'
    import Form from '../../core/Form'

    export default {
        data () {
            return {
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
                        this.$emit('created', {
                            id: response.id, title: response.title
                        })

                        // empty the input field
                        this.form.title = ''
                    })
                }
            }
        }
    }
</script>

<style scoped>
    .row {
        padding: 50px 30px;
    }

    button, input, .input-group {
        margin: 0;
    }
</style>