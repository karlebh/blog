

require('./bootstrap');

window.Vue = require('vue')

Vue.component('create-post', require('./components/createPost.vue').default);


Vue.component('like-comment', require('./components/Comment/likes.vue').default);
Vue.component('like', require('./components/LikeComp.vue').default);
Vue.component('init', require('./components/InitComp.vue').default);
Vue.component('App', require('./appComp.vue').default);
Vue.component('post-noty', require('./components/PostNoty.vue').default);
Vue.component('friending', require('./components/Friend.vue').default);
Vue.component('notify', require('./components/Notification.vue').default);
Vue.component('unread', require('./components/UnreadNots.vue').default);
Vue.component('follow-post', require('./components/FollowPost.vue').default);



import VueRouter from 'vue-router'
import store from './store'
import {routes} from './routes'

Vue.use(VueRouter)


const router = new VueRouter({
	mode: 'history',
	base: 'sites/public/users',
	routes
});

const app = new Vue({
	el: '#app',
	router,
	store

});



