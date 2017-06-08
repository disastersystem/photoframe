<template>
    <div style="margin-top: 50px;">
        <v-menu offset-y>
            <!-- <v-btn primary light slot="activator">Dropdown</v-btn> -->
            <v-text-field
                name="person"
                label="Søk etter en person"
                slot="activator">
            </v-text-field>

            <!-- <v-list>
                <v-list-item v-for="item in items" :key="item">
                    <v-list-tile>
                        <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile>
                        <v-list-tile-title>{{ item.email }}</v-list-tile-title>
                    </v-list-tile>
                </v-list-item>
            </v-list> -->
            <v-list>
                <v-list-item v-for="item in items" :key="item">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img v-bind:src="item.avatar" />
                        </v-list-tile-avatar>
                        <v-list-tile-content style="margin: 10px 0;" @click="selected(item.id)">
                            <v-list-tile-title v-html="item.name"></v-list-tile-title>
                            <v-list-tile-sub-title v-html="item.email"></v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>


<script>
    export default {
        data () {
            return {
                items: [
                    { id: 45, name: 'Inga Johansen', email: 'inga.johanna.johansen@gmail.com', avatar: '' },
                    { id: 23, name: 'Inga Johansen', email: 'inga.johansen@gmail.com', avatar: '' }
                ]
            }
        },

        methods: {
            selected(id) {
                this.$emit('newMemberID', id)
            }
        }
    }
</script>
