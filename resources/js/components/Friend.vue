<template>

<div>
	<!-- <span v-if="loading"><loading></loading></span> -->
	
	<!-- <div v-else> -->
		<div>

		<button v-if='status === 0' class="btn btn-success" @click.prevent="addFriend">
		Add Friend</button>

		<p  v-if="status === 'pending'">
		<button class="btn btn-primary" @click.prevent="acceptFriend">Accept Friend</button>

		
		<button class="btn delete" @click.prevent="declineFriend">Delete</button>

		</p>

		<p class="text-center" v-if="status === 'waiting'">Waiting</p>

		<!-- <h5 class="text-center mt-n4" style="color: #41B883" v-if="status === 'friends'">
		You are friends!
		</h5> -->

		<p class="text-center" v-if="status === 'friends'">You Are Friends</p>

	</div>
</div>
</template>

<script type="text/javascript">
	export default{
		props: {
				userid: Number,
		},

		data(){
			return{
				status: null,
				id: this.userid,
			}
		},
		created(){
			this.checkFriendshipStatus()
		},
		// computed:{
		// 		Status(){
		// 			return this.status
		// 		}
		// 	},

		methods: {
			addFriend()
			{
				// this.loading = true
				axios.get('/addFriend/' + this.id)
						.then(response => {
										this.status = 'waiting'
								})
			},

			checkFriendshipStatus()
			{
				axios.get('/check/' + this.id)
						.then(response => {
							this.status = response.data.status
						})
			},

			acceptFriend()
			{
				axios.get('/acceptFriend/' + this.id)
						.then(response => this.status = 'friends')
			},

			declineFriend()
			{
				axios.get('/declineFriend/' + this.id)
						.then(response => this.status = 0)
			}
		}
	}
</script>

<style type="text/css" scoped>
	.delete{
		background-color: #bbb;
	}
</style>