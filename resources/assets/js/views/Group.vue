<template>
	<div>
        <div>
            <v-toolbar class="white elevation-0 ">
                <v-toolbar-title class="hidden-sm-and-down toolbar-title">{{ currentPage }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <upload v-on:eventchild="eventChild"></upload>
                <!-- v-if="numImages > 0" -->
                <people></people>
            </v-toolbar>
        </div>

		<div id="images-wrapper">
            <p v-if="numImages == 0" class="status-message">
                Ingen bilder i denne gruppen.
                <!-- Trykk på "Legg til bilder"-knappen oppe i høyre hjørne<br>
                for å legge til bilder i gruppen. -->
                <!-- <upload v-on:eventchild="eventChild" v-if="numImages == 0"></upload> -->
            </p>

            <v-layout row wrap>
                <template v-for="(photo, i) in group.group_images">
                    <v-flex v-if="newYear(photo.created_at.substring(0, 4))" xs12 class="year-title" :key="i">
                        {{ photo.created_at.substring(0, 4) }}
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
    
    var prevDate = ''

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
                axios.get('getgroup/' + id).then(response => {
                    prevDate = ''
                    response.data[0].group_images.reverse()
                    this.group = response.data[0]
                    this.currentPage = this.group.title
                    this.numImages = this.group.group_images.length
                })
            },

            /**
             * 
             */
            newYear(date) {
                if (prevDate == date) {
                    prevDate = date
                    return false
                } else {
                    prevDate = date
                    return true
                }
            },

            eventChild(data) {
                this.group.group_images.unshift(data)
                this.numImages = this.group.group_images.length
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