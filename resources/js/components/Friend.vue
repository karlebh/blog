<template>
	<div>
		<button v-if="status == 'notFriends'" class="btn btn-success" @click="addFriend">
			Add Friend
		</button>

		<div  v-if="status == 'pending'">
		<button class="btn btn-primary" @click="acceptFriend">Accept Friend</button>

		
		<button class="btn delete" @click="declineFriend">Delete</button>

		</div>

		<p class="text-center" v-if="status == 'waiting'">Waiting</p>

		<p class="text-center text-success" v-if="status == 'friends'">You Are Friends</p>
	</div>
</template>

<script>
	export default{
		props: {
			userid: Number,
		},

		data(){
			return {
				status: '',
				id: this.userid,
			}
		},
		created() {
			this.checkFriendshipStatus()
		},

		methods: {
			addFriend() {
				axios.get('/addFriend/' + this.id)
				this.status = 'waiting'
			},

			checkFriendshipStatus() {
				axios.get('/check/' + this.id)
				.then(response => {
					console.log(response.data)
					this.status = response.data
				})
			},

			acceptFriend() {
				axios.get('/acceptFriend/' + this.id)
				this.status = 'friends'
			},

			declineFriend() {
				axios.get('/declineFriend/' + this.id)
				this.status = 'notFriends'
			}
		}
	}
</script>

<style type="text/css" scoped>
	.delete{
		background-color: #bbb;
	}
</style>