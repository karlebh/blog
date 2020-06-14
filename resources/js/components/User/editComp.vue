
<template>
<div class="container">
	
	<form class="form" >
		<div class="form-group">
			<label class="form-label">Name</label>
			<input class="form-control" type="text" v-model="user.name" >
		</div>

		<div class="form-group">
			<label class="form-label">Username</label>
			<input class="form-control" type="text" v-model="user.username" >
		</div>

		<div class="form-group">
			<label class="form-label">Email</label>
			<input class="form-control" type="email" v-model="user.email" >
		</div>

		<div class="form-group">
			<input class="btn btn-primary" type="submit" @click.prevent="updateUser" value="Update User">
		
			<button class="btn btn-warning" @click.prevent="back" >    Cancel    </button>
		</div>

	</form>

</div>
</template>


<script type="text/javascript">
		export default{

			data(){
				return{
					user: {
					},
					id: this.$route.params.id,
				}
			},

			created(){
				this.getUser()
			},
			methods: {
				back(){
					this.$router.push({
						name: 'show',
						params: this.id
					})
				},
				getUser(){
				axios
				.get('/api/users/show/' + this.id)
				.then(resp => this.user = resp.data.data)
				.catch(err => this.$router.push({
						name : '404'
					}))
			},

			updateUser(){
				axios
					.post('/api/users/update/' + this.user.id, this.user)
					// .then(resp=>console.log(resp.data))
					.then(resp => {this.$router.push({
						name: 'show',
						params: this.id,
					})})
					
			}
				}
			

		}	

</script>

<style type="text/css" scoped>
	.btn-warning{
		float: right;
	}
</style>