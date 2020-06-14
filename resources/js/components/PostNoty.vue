<template>


</template>


<script type="text/javascript">
	export default{
		props: ['id'],


		mounted()
		{
			Echo.private('App.Post.' + this.id)
				.notification((notification) => {
					alert("notification")
					console.log(notification)
				})
		}

	}
</script>
