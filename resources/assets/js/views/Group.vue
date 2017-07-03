<template>
	<div>
        <div>
            <v-toolbar class="white elevation-0">
                <v-toolbar-title class="hidden-sm-and-down toolbar-title">
                    {{ group.title }}
                </v-toolbar-title>
                
                <v-spacer></v-spacer>
                
                <upload @success="successfulUpload"></upload> <!-- v-if="group.group_photos.length > 0" -->
                <!-- v-if="group.group_photos.length > 0" -->
                <people></people>
            </v-toolbar>
        </div>

		<div id="images-wrapper">
            <p v-if="group.group_photos.length == 0" class="status-message">
                Ingen bilder i denne gruppen.<br>
                <!-- <upload v-on:eventchild="eventChild" 
                    v-if="group.group_photos.length == 0"></upload> -->
            </p>

            <v-layout row wrap>
                <template v-for="(photo, i) in group.group_photos">
                    <v-flex v-if="newMonth(photo.created_at.substring(0, 7))" xs12 class="year-title" :key="i">
                        {{ formatDate(photo.created_at) }}
                    </v-flex>
                    
    				<v-flex xs12 sm6 md4 lg3 xl3>
    					<v-card class="elevation-10 mb-4 photo-frame">
    						<img :src="photo.filepath" style="width: 100%;">
    					</v-card>
    				</v-flex>
                </template>
            </v-layout>

		</div>
    </div>
</template>

<script>
	import upload from '../components/dialogs/Upload'
    import people from '../components/dialogs/People'
    
    var prevDate = '' //

    export default {
        data () {
            return {
                group: {
                    group_photos: []
                }
            }
        },

        watch: {
            '$route' (to, from) {
                this.getGroupData(this.$route.params.id)
            }
        },

        components: {
    		upload, people
    	},

        methods: {
        	imageLink(image) {
        		return `uploads/${image}`
        	},

            getGroupData(id) {
                axios.get('group/' + id + '/get').then(response => {
                    prevDate = '' // reset the prevDate when a new view is loaded

                    this.group = response.data[0]
                })
            },

            newMonth(date) {
                if (prevDate == date) {
                    prevDate = date
                    return false
                } else {
                    prevDate = date
                    return true
                }
            },

            /**
             * Replace with moment.js?
             */
            formatDate(date) {
                let y = date.substring(0, 4)
                let m = date.substring(5, 7)
                m = m.replace('0','') // remove any leading zeroes, for easy index matching in the months array
                let months = [
                    'Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 
                    'September', 'oktober', 'november', 'desember'
                ]

                return y + ' ' + months[parseInt(m) - 1]
            },

            successfulUpload(data) {
                this.group.group_photos.unshift(data)
            }
        },

        mounted() {
            this.getGroupData(this.$route.params.id)
        }
    }
</script>

<style scoped>
    #images-wrapper {
        padding: 2%;
        padding-bottom: 100px;
    }

    .year-title {
        border-bottom: 1px solid #ddd;
        margin-bottom: 25px;
        margin-top: 40px;
        padding: 10px;
        font-size: 16px;
        color: #bbb;
    }

    .toolbar-title {
        text-align: center;
        font-size: 25px;
    }

    .photo-frame {
        padding: 10px;
    }

    .status-message {
        padding: 30px;
        font-size: 18px;
        color: #ccc;
        font-weight: 500;
        font-size: 18px;
        text-transform: uppercase;

        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        width: 100%;
        text-align: center;
    }
</style>