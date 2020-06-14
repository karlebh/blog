


<template>
	<div class="container">
		
		
		<div class="jumbotron">
			
				<p>My is  <strong> {{user.name}}</strong></p>
				<p>My friends call me   <strong>{{user.username}}</strong> </p>
			
			<div>
				<button class="btn btn-warning"><router-link :to="{name: 'edit', params: 'user.id'}" >Edit</router-link></button>
				<button class="btn btn-danger" @click.prevent="deleteUser">Delete</button>
			</div>

 	

		</div>
	</div>
</template>

<script type="text/javascript">

	export default{

		data(){
			return{
				user: [],
				id: this.$route.params.id,
			}
		},

		created(){
			this.getUser()
		},

		methods:{
			getUser(){
				axios
					.get('/api/users/show/' + this.id)
					.then(resp => this.user = resp.data.data)
					.catch(err => this.$router.push({
						name : '404'
					}))

			},
			deleteUser(){
				axios
					.post('/api/users/delete/' + this.id)
					.then(resp => this.$router.push({
						name: 'all'
					}))
					
			}
		}



	}
	

</script>