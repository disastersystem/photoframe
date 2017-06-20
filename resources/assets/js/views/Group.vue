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
                <v-flex xs12 sm6 md4 lg3 xl3 v-for="(image, index) in group.group_images" :key="index">
                    <v-card class="elevation-10 mb-4 photo-frame">
                        <img :src="image.filepath">
                        <!-- <v-card-text>Hello World</v-card-text> -->
                    </v-card>
                </v-flex>
            <v-layout row>

            <!-- <div v-for="(item, i) in items">
                <v-layout row class="year-row">
                    <div class="year-title">
                        {{ item.year }}
                    </div>
                </v-layout>
                

                <v-layout row wrap>
    				<v-flex xs12 sm6 md4 lg3 xl3 v-for="(image, index) in item.images" :key="index">
    					<v-card class="elevation-10 mb-4 photo-frame">
    						<img :src="image.url">
    					</v-card>
    				</v-flex>
                </v-layout>

            </div> -->
		</div>
    </div>
</template>

<script>
	import upload from '../components/dialogs/Upload'
    import people from '../components/dialogs/People'

    export default {
        data () {
            return {
                currentPage: '',
                group: [],
                numImages: 0,
                items: [
                    {
                        year: 2017,
                        images: [
                            {url: 'uploads/groups/149765735420130120_140520.jpg/149765735420130120_140520.jpg'},
                            {url: 'uploads/groups/149765735420130120_140520.jpg/149765735420130120_140520.jpg'},
                            {url: 'uploads/groups/149765735420130120_140520.jpg/149765735420130120_140520.jpg'},
                            {url: 'uploads/groups/149765735420130120_140520.jpg/149765735420130120_140520.jpg'}
                        ]
                    },
                    {
                        year: 2016,
                        images: [
                            {url: 'uploads/groups/1497655766dt141218.gif/1497655766dt141218.gif'},
                            {url: 'uploads/groups/1497655766dt141218.gif/1497655766dt141218.gif'},
                            {url: 'uploads/groups/1497655766dt141218.gif/1497655766dt141218.gif'},
                            {url: 'uploads/groups/1497655766dt141218.gif/1497655766dt141218.gif'}
                        ]
                    },
                    {
                        year: 2015,
                        images: [
                            {url: 'uploads/groups/149765735420130131_104213.jpg/149765735420130131_104213.jpg'},
                            {url: 'uploads/groups/149765735420130131_104213.jpg/149765735420130131_104213.jpg'},
                            {url: 'uploads/groups/149765735420130131_104213.jpg/149765735420130131_104213.jpg'},
                            {url: 'uploads/groups/149765735420130131_104213.jpg/149765735420130131_104213.jpg'}
                        ]
                    } 
                ]
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
                    this.group = response.data[0]
                    this.currentPage = this.group.title
                    this.numImages = this.group.group_images.length
                });
            },

            eventChild(data) {
                this.group.group_images.unshift(data)
                this.numImages = this.group.group_images.length
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
        padding: 2%;
        padding-bottom: 100px;
        /*display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        text-align: center;*/
    }

    .year-row {
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;
        margin-top: 30px;
    }

    .year-title {
        margin: 10px 0;
        padding: 10px;
        font-size: 16px;
        color: #bbb;
        text-align: center;
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