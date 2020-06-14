<template>
	<div>
		

	</div>
</template>
<script type="text/javascript">


	export default{
		props: ['id'],
		mounted(){
			this.listen()
		},

		created(){
			this.adding()
		},

		methods:{
			listen()
			{
				Echo.private('App.User.' + this.id)
					.notification((notification) => 
						{
							alert('new notification')
							console.log(notification)
							this.$store.commit('addNots', notification)
						}
					)
			},

			
			adding(){
				Echo.channel('adding')
					.listen('Friend', (friend) => {
						alert('Friend added!')
					})
			}
		}

	}
</script>