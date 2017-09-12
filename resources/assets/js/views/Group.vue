<template>
	<div>
        <v-toolbar class="group-toolbar elevation-0">
            <drawertrigger></drawertrigger>

            <v-toolbar-title>{{ group.title }}</v-toolbar-title>
            
            <v-spacer></v-spacer>
            
            <upload-dialog @success="successfulUpload"></upload-dialog>

            <people-dialog></people-dialog>

            <v-btn flat>
                <v-icon>settings</v-icon>
            </v-btn>
        </v-toolbar>

		<div id="images-wrapper">
            <p v-if="photos.length == 0" class="status-message">
                Ingen bilder i denne gruppen
            </p>

            <v-layout row wrap>
                <template v-for="(photo, i) in photos">
    				<v-flex xs12 sm6 md4 lg3 xl3 :key="i">
    					<v-card class="elevation-10 mb-4 ml-2 mr-2 photo-frame">
                            <div class="intrinsic-placeholder">
                                <photo :path="photo.thumbnail_filepath"></photo>
                            </div>
    					</v-card>
    				</v-flex>
                </template>
            </v-layout>

            <v-layout row justify-center v-if="pagination.nextPage !== null" class="load-more-row">
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
                /* 
                * initalizing the photos array with an empty object 
                * keeps the "no images" message from showing while 
                * photos gets fetched 
                */
                photos: [{}],
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
    		'upload-dialog': upload,
            'people-dialog': people,
            'drawertrigger': drawertrigger,
            'photo': photo
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
                        this.photos.push.apply( this.photos, response.data.data )
                        
                        this.pagination = {
                            nextPage: response.data.next_page_url
                        }
                    })
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

    .group-toolbar {
        display: flex;
        padding: 10px 0;
    }

    .toolbar__title {
        display: flex;
        align-items: center;
        text-align: center;
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

    .load-more-row {
        margin-top: 50px;
    }

    .settings-trigger {
        padding: 0 15px;
    }
</style>