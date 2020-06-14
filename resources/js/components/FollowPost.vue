
<template>
	<div>
		<button @click="toggle" v-text="buttonText">
		</button>
	</div>
</template>




<script scoped>
	export default{
		props:['postid', 'follows'],
		data()
		{
			return{
				id: this.postid,
				status: this.follows,
			}
		},
		computed: {
			buttonText(){
				return (this.status) ? "Unfollow" : "Follow";
			}
		}, 
		methods:{
			toggle(){
			axios.post('/followPost/' + this.id)
					.then(response => {
						this.status =! this.status
					}).catch(error => {
						window.location = '/login'
					})
			}
		}
	}
	
</script>


<style scoped>
	button{
		position: relative;
		top: -7px;
		background-color: #41B883;
		color: white;
		border: none;
		outline: none;
		padding: 7px 8px;
		border-radius: 5px;
	}
</style>