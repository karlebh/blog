<template>
	
</template>

<script type="text/javascript">
	
	export default{
		data()
		{
			return{
				id : "",
			}
		},
		mounted()
		{
			this.getUser()
		},

		methods:{
			getUser(){
				axios.get('/auth_user')
					 .then(
					 	(resp) => this.$store.commit('addUser', resp.data)     
         )
			}
		}


	}
</script>