 <template>

<div class="container">



    <div> 
            <div class="card " v-for="comment in allComments">
              <div class="card-header">
                <span>{{comment.name}}</span>
                <span class="marg">{{comment.created_at }}</span>
              </div>
              <div class="card-body">
                <p class="card-text">{{comment.body}}</p>
              </div>
            </div>

    </div>

    </p>
</div>

</template>


<script>
export default{
props:{
    post_id: Number,
},

data(){
    return{
        // comments: this.allComments
    }
},
created(){
    this.getComments()
},

computed:
{
     allComments(){
        return this.$store.getters.allComments
    }
},

methods:{
    getComments()
    {
        axios.post('/getComment', {post_id: this.post_id})
        .then((resp) => {
                 resp.data.forEach( (comment) => this.$store.commit('addComment', comment))
            }         
         )
    },


    }




}

</script>

<style type="text/css" scoped>
    .marg{
        float: right;
    }
    .card{
        margin-bottom: 20px;

    }
    .card-header{
         background-color: #bbb;
    }
</style>