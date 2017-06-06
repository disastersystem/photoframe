<template>
	<div>
        <div>
            <v-toolbar class="white elevation-0 ">
                <v-toolbar-title class="hidden-sm-and-down toolbar-title">{{ currentPage }}</v-toolbar-title>
                <!-- <v-spacer></v-spacer> -->
                <!-- <v-btn icon>
                    <v-icon>person_add</v-icon>
                </v-btn> -->
                <uploaddialog></uploaddialog>
                <members></members>
            </v-toolbar>
        </div>

		<div id="images-wrapper">
			<v-layout row wrap>
                <p v-if="images.length == 0" style="padding: 40px; font-size: 18px; color: #aaa;">
                    Ingen bilder i gruppen "{{ currentPage }}". <br>Trykk på "Legg til bilder" knappen
                    oppe i høyre hjørne for å legge til bilder.
                </p>

				<v-flex xs3 v-for="(image, index) in images" :key="index">
					<v-card class="elevation-10 mb-4 photo-frame">
						<img :src="imageLink(image.name)">
						<!-- <v-card-text>Hello World</v-card-text> -->
					</v-card>
				</v-flex>
			</v-layout>
		</div>

        <photoframe></photoframe>
    </div>
</template>

<script>
	import UploadDialog from '../components/UploadDialog'
	import DialogForm from '../components/Dialog'
    import Members from '../components/Members'
    import PhotoFrame from '../components/PhotoFrame'

    export default {
        data () {
            return {
                currentPage: '',
                images: []
            }
        },

        watch: {
            '$route' (to, from) {
                // react to route changes...
                this.getImages(this.$route.params.id)
            }
        },

        components: {
    		'dialogForm': DialogForm,
    		'uploaddialog': UploadDialog,
            'members': Members,
            'photoframe': PhotoFrame
    	},

        methods: {
        	imageLink(image) {
        		return `uploads/${image}`
        	},

            getImages(id) {
                this.images = this.ajax(id)

                if (id == '1') 
                    this.currentPage = 'Tyristrand'

                if (id == '2') 
                    this.currentPage = 'Familie'

                if (id == '3') 
                    this.currentPage = 'Turgjengen'
            },

            ajax(page) {
                switch(page) {
                    case '1':
                        return [
                            { id: 1, name: 'eli.jpg' },
                            { id: 2, name: 'family.jpg' },
                            { id: 3, name: 'fuji-san.jpg' },
                            { id: 4, name: 'chicken.jpg' },
                            { id: 9, name: 'surfer.jpg' },
                            { id: 10, name: 'train.jpg' },
                            { id: 11, name: 'woman.jpg' },
                            { id: 12, name: 'young-man.jpg' }
                        ]
                        break
                    case '2':
                        return [
                           
                        ]
                        break
                    case '3':
                        return [
                            { id: 9, name: 'surfer.jpg' },
                            { id: 10, name: 'train.jpg' },
                            { id: 11, name: 'woman.jpg' },
                            { id: 12, name: 'young-man.jpg' }
                        ]
                        break
                    default:
                        return 'Kunne ikke finne noen bilder.'
                }
            }
        }, 

        mounted() {
            // this.currentPage = this.$route.params.id
            this.getImages(this.$route.params.id)
        }
    }
</script>

<style scoped>
    #images-wrapper {
        padding: 20px;
    }

    .photo-frame {
        padding-top: 10px;
        padding-right: 10px;
        padding-left: 10px;
        padding-bottom: 10px;
    }

    .toolbar-title {
        text-align: center;
    }
</style>