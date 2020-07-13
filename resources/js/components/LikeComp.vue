<template>
  
  <div>
    <button
      v-if="isLiked"
      @click.prevent="unlike"
    >
      unlike
      
    </button> 

      <button
      v-else
      @click.prevent="like"
    >
      like
      
    </button>

    {{likeCount}}
  </div>

</template>

<script>
    export default{
      props: ['id', 'count', 'liked'],

      data(){
        return{
            ids : this.id,
            counts : this.count,
            likeds : this.liked,
        }
      },
      mounted(){
            return this.isLiked = this.likeds ? true : false
      },
      computed:{
        isLiked: {
          get(){
            return this.liked
          },
          set(liked){
              return this.liked
          }
        },

        likeCount(){
          if(this.counts < 1){
            return;
          }
          return this.counts
        }
      },
      methods: {
     
        like(){

            axios.post('/like', {id: this.id})
                .then( response => {
                this.liked = true;
                this.counts = this.count + 1//this is responsible for normal like count
            });
        },

        unlike() {

            axios.post('/unlike', {id: this.id})
                .then(response => {
                this.liked = false;
                this.counts -= 1 //this is responsible for normal like count
            });
          }
       },
       watch:{
          
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