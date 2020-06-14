 <template>
	<div class="container">
		  <div class="pagination">
            <button :disabled="! prevPage" @click.prevent="goToPrev()">Previous</button>
            {{ paginationCounts }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>

        
		<p v-for="user in users" :key="user.id"></p>
			<div v-for="user in users">
			<div class="container"> 
			 <router-link
			  class="router-link" 
			  :to="{name: 'show', params: {id: user.id}}"
			  >
					{{user.name }}

			</router-link>

			</div>

		</div>


		  <div class="pagination">
            <button :disabled="! prevPage" @click.prevent="goToPrev()">Previous</button>
            {{ paginationCounts }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>
	</div>
</template>

<script type="text/javascript">
	const getUsers = (page, callback) => {
		const params = {page};

		axios
			.get('/public/api/users', {params})
			.then(resp => callback(null, resp.data))
			.catch(err => callback(err, err.resp.data));
	};


	export default{

		data(){
			return{
				users: [],
				meta: {
					current_page: null,
					from: null,
					last_page: null,
					path: null,
					per_page: null,
					to: null,
					total: null,
				},
				links: {
					first: null,
					last: null,
					prev: null,
					next: null,
				},
				err: null,
			}
		},

		computed: {

			nextPage()
			{
				if(!this.meta || this.meta.current_page === this.meta.last_page){
					return;
				}
				return this.meta.current_page + 1;
			},
			prevPage()
			{
				if(!this.meta || this.meta.current_page === 1){
					return;
				}

				return this.meta.current_page - 1;
			},
			paginationLinks()
			{
				return;
			},
			paginationCounts()
			{
				if(!this.meta){
					return;
				}

				const {current_page, last_page} = this.meta;

				return current_page + " of " + last_page;
			},
		},


		beforeRouteEnter(to, from, next){
			getUsers(to.query.page, (err, data) => {
				next(vm => vm.setData(err, data))
			})
		},

		beforeRouteUpdate(to, from, next){
			getUsers(to.query.page, (err, data) => {
				this.setData(err, data);
				next();
			})
		},

		methods: {

		},

		created(){
			// this.getUsers()
		},
		methods:{
			// getUsers(){
			// 	axios
			// 	.get('http://localhost/sites/public/api/users')
			// 	.then(resp => this.users = resp.data.data)
			// }

			goToNext(){
				this.$router.push({
					query: {
						page: this.nextPage
					}
				})
			},

			goToPrev(){
				this.$router.push({
					query: {
						page: this.prevPage
					}
				})
			},


			setData(err, {data: users, links, meta}){

					if(err){
						this.error = err.toString()
					}
					else
					{
						this.users = users;
						this.links = links;
						this.meta = meta;
					}
			}
		}




	}
</script>