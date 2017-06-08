<template>
	<div>
        <div>
            <v-toolbar class="white elevation-0 ">
                <v-toolbar-title class="hidden-sm-and-down toolbar-title" style="font-size: 25px;">{{ currentPage }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <uploaddialog v-on:eventchild="eventChild" style="margin-left: 10px;"></uploaddialog>
                <members></members>
            </v-toolbar>
        </div>

		<div id="images-wrapper">
			<v-layout row wrap>
                <p v-if="numImages == 0" style="padding: 40px; font-size: 18px; color: #aaa;">
                    Trykk på "Legg til bilder"-knappen
                    oppe i høyre hjørne for å legge til bilder
                    i gruppen.
                </p>

				<v-flex xs12 sm6 md4 lg3 xl3 v-for="(image, index) in group.group_images" :key="index">
					<v-card class="elevation-10 mb-4 photo-frame">
						<img :src="image.filepath">
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
                group: [],
                numImages: 0
            }
        },

        watch: {
            '$route' (to, from) {
                // react to route changes...
                this.getGroupData(this.$route.params.id)
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

            getGroupData(id) {
                axios.get('getgroup/' + id).then(response => {
                    this.group = response.data[0]
                    this.currentPage = this.group.title
                    this.numImages = this.group.group_images.length
                });
            },

            eventChild(data) {
                this.group.group_images.unshift(data)
                this.numImages = this.group.group_images.length;
                console.log(this.group.group_images);
            }
        }, 

        mounted() {
            // this.currentPage = this.$route.params.id
            this.getGroupData(this.$route.params.id)
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