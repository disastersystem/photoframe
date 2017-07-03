<template>
	<div>
		<transition name="fade">
			<div class="b-modal b-is-active" v-if="show">
				<div class="b-modal-background"></div>

				<div class="b-modal-card">
					<header class="b-modal-card-head">
					<div>
                            <v-menu transition="v-scale-transition" top>
                                <v-btn slot="activator" light flat>
                                    Tidsintervall
                                </v-btn>
                                <v-list>
                                    <!-- <v-list-item v-for="interval in intervals"> -->
                                    <v-list-item>
                                        <v-list-tile>
                                            <v-list-tile-title>awdad</v-list-tile-title>
                                            <v-list-tile-title>fdggg</v-list-tile-title>
                                        </v-list-tile>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
						<!-- <button class="b-modal-close" @click="close"></button> -->

						 
					</header>

					<section class="b-modal-card-body">
						<img src="uploads/groups/1499041262thegrass.jpg/1499041262thegrass.jpg">
					</section>
				</div>
			</div>
		</transition>

		<!-- <div @click="openModal"> -->
<!-- 	        <v-btn class="indigo">
	            <i class="material-icons icon icon--light icon--center">
	                person_add
	            </i>
	        </v-btn> -->
	        <button class="btn scale btn-photoframe" style="animation-delay: 600ms;" @click="open">
	            start bilderammemodus
	        </button>
	    <!-- </div> -->
    </div>
</template>

<script>
	export default {
        data() {
            return {
                show: false
            }
        },

        methods: {
        	open() {
        		this.show = true
        		document.documentElement.style.overflowY = 'hidden'
                document.documentElement.style.paddingRight = '17px'
        	},

        	close() {
        		this.show = false
        		document.documentElement.style.overflowY = null
                document.documentElement.style.paddingRight = null
        	}
        }
    }
</script>

<style scoped>
	.b-modal-background {
		bottom: 0;
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
		background-color: rgba(10, 10, 10, 0.6);
		z-index: 900;
	}

	.b-modal-content,
	.b-modal-card {
		margin: 0;
		max-height: 100vh;
		overflow: auto;
		position: relative;
		width: 100%;
		z-index: 950;
	}

	/*@media screen and (min-width: 769px), print {*/
		.b-modal-content,
		.b-modal-card {
			margin: 10px auto;
			max-height: 100vh;
			max-width: 100%;
		}
	/*}*/

	.b-modal-close {
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		-moz-appearance: none;
		-webkit-appearance: none;
		background-color: rgba(10, 10, 10, 0.2);
		border: none;
		border-radius: 290486px;
		cursor: pointer;
		display: inline-block;
		-webkit-box-flex: 0;
		-ms-flex-positive: 0;
		flex-grow: 0;
		-ms-flex-negative: 0;
		flex-shrink: 0;
		font-size: 1rem;
		height: 30px;
		max-height: 30px;
		max-width: 30px;
		min-height: 30px;
		min-width: 30px;
		outline: none;
		position: relative;
		vertical-align: top;
		width: 30px;
	}

	.b-modal-close:before, .b-modal-close:after {
		background-color: white;
		content: "";
		display: block;
		left: 50%;
		position: absolute;
		top: 50%;
		transform: translateX(-50%) translateY(-50%) rotate(45deg);
		transform-origin: center center;
	}

	.b-modal-close:before {
		height: 2px;
		width: 50%;
	}

	.b-modal-close:after {
		height: 50%;
		width: 2px;
	}

	.b-modal-close:hover, .b-modal-close:focus {
		background-color: rgba(10, 10, 10, 0.3);
	}

	.b-modal-close:active {
		background-color: rgba(10, 10, 10, 0.4);
	}

	.b-modal-card {
		display: flex;
		flex-direction: column;
		max-height: calc(100vh - 40px);
		overflow: hidden;
	}

	/*.b-modal-card-head,*/
	.b-modal-card-foot {
		align-items: center;
		background-color: whitesmoke;
		display: flex;
		flex-shrink: 0;
		justify-content: flex-start;
		padding: 20px 20px 0 20px;
		position: relative;
	}

	.b-modal-card-head {
		position: absolute;
		top: 0;
		left: 0;
		background: red;
	}

	.b-modal-card-body {
		-webkit-overflow-scrolling: touch;
		background-color: white;
		flex-grow: 1;
		flex-shrink: 1;
		overflow: auto;
		/*padding: 20px;*/
	}

	.b-modal {
		bottom: 0;
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
		align-items: center;
		display: none;
		justify-content: center;
		overflow: hidden;
		position: fixed;
		z-index: 20;
	}

	.b-modal.b-is-active {
		display: flex;
	}

	/**
	 * 
	 */
	.btn {
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
		margin: 0;
		width: 100%;
		font-size: 20px;
		background: #3486D7;
		color: #fff;
		border-radius: 0;
		z-index: 1;
	}
</style>