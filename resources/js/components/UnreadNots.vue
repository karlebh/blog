<template>
	<div>
		<span>
		Notifications
			<span class="badge">{{ notsCount }}</span>
		</span>
	</div>
</template>

<script type="text/javascript">
	export default{

		mounted(){
			this.getUnread()
		},
		computed:{
			notsCount(){
				return this.$store.getters.notsCount
			}
		},

		methods:{
			getUnread(){
				axios.get('/unreadNots')
						.then((resp) => {
							resp.data.forEach((nots) => this.$store.commit('addNots', nots))
							
						})
			}
		}
	}
</script>

<style type="text/css" scoped>
	.badge{
		background-color: red;
		color: white;

	}
</style>