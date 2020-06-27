<template>
	<div>
		<div>
			<button @click="toggle"  v-text="buttonText" >
				
			</button>
				
			<span v-if="count > 0" class="block">
				{{count}}
			</span>

		</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		props: ['id'],

		data(){
			return{
				status: '',
				count: '',
			}
		},

		created(){
			this.check()
		},

		computed: {
			buttonText(){
				return (this.status) ? 'unlike' : 'like';
			},

			likeCount(){
				return this.count.length
			}

		
		},

		methods:{
			like()
			{	
				axios.post('/likeComment', {id: this.id})
						.then(response => 
									{
									this.status = ! this.status
									this.count = this.count + 1
								})
			},
			unlike()
			{ 
				axios.post('/unlikeComment', {id: this.id})
						.then(response => {
									this.status = ! this.status
									this.count = this.count - 1
							})
			},
			check()
			{
				axios.post('/checkComment', {id: this.id})
						.then(response => 
								{
									this.status = response.data[0]
									this.count = response.data[1]
								})
			},
			toggle(){
				(this.status) ? this.unlike() : this.like();
			}
		}
	}
</script>

<style scoped>
	button{
		background: none !important;
		border: none;
		padding: 0 !important;
		cursor: pointer;
		outline: transparent;
		color: #3490dc;
	}

	button:hover{
		text-decoration: underline;
	}



</style>