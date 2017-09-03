<template>
	<div>
        <div>
            <v-toolbar class="white elevation-0">
                <drawertrigger></drawertrigger>

                <v-toolbar-title class="hidden-sm-and-down toolbar-title">
                    {{ group.title }}
                </v-toolbar-title>
                
                <v-spacer></v-spacer>

                <v-btn light flat>
                    <i class="material-icons icon icon--dark icon--center">
                        notifications_none
                    </i>
                </v-btn>
                
                <upload @success="successfulUpload"></upload>
                <people></people>
            </v-toolbar>
        </div>

		<div id="images-wrapper">
            
            <p v-if="photos.length == 0" class="status-message">
                Ingen bilder i denne gruppen.<br>
            </p>

            <v-layout row wrap>
                <template v-for="(photo, i) in photos">
    				<v-flex xs12 sm6 md4 lg3 xl3 :key="i">
    					<v-card class="elevation-10 mb-4 photo-frame">
                            <div class="intrinsic-placeholder">
                                <!-- <photo :src="photo.thumbnail_filepath"></photo> -->
                                <img :src="photo.thumbnail_filepath" style="position: absolute; top: 0; left: 0;">
                            </div>
    					</v-card>
    				</v-flex>
                </template>
            </v-layout>


            <v-layout row justify-center v-if="pagination.nextPage !== null" style="margin-top: 50px;">
                <v-btn @click.native.stop="nextPhotos">
                    last in flere
                </v-btn>
            </v-layout>

		</div>
    </div>
</template>

<script>
	import upload from '../components/dialogs/Upload'
    import people from '../components/dialogs/People'
    import drawertrigger from '../components/DrawerTrigger'
    import photo from '../components/Photo'

    export default {
        data () {
            return {
                group: {},
                photos: [],
                pagination: {}
            }
        },

        watch: {
            '$route' (to, from) {
                this.getGroupData(to.params.id)
                this.getGroupPhotos(to.params.id)
            }
        },

        components: {
    		upload, people, drawertrigger, photo
    	},

        methods: {
            getGroupData(id) {
                axios.get('group/' + id + '/get').then(response => {
                    this.group = response.data[0]
                })
            },

            getGroupPhotos(id) {
                axios.get('group/' + id + '/photos/get').then(response => {
                    this.photos = response.data.data

                    this.pagination = {
                        nextPage: response.data.next_page_url
                    }
                })
            },

            nextPhotos() {
                if (this.pagination.nextPage !== null) {
                    axios.get(this.pagination.nextPage).then(response => {
                        this.photos.push.apply( this.photos, response.data.data );
                        
                        this.pagination = {
                            nextPage: response.data.next_page_url
                        }
                    });
                }
            },

            successfulUpload(data) {
                this.photos.unshift(data)
            }
        },

        mounted() {
            this.getGroupData(this.$route.params.id)
            this.getGroupPhotos(this.$route.params.id)
        }
    }
</script>

<style scoped>
    #images-wrapper {
        padding: 2%;
        padding-bottom: 100px;
    }

    .intrinsic-placeholder {
        padding-bottom: 60%;
        position: relative;
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
        color: #000;
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