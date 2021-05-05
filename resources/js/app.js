
require('./bootstrap');

import Vue from 'vue'

import store from './store'


Vue.component('App', require('./appComp.vue').default);
Vue.component('create-post', require('./components/createPost.vue').default);
Vue.component('like-comment', require('./components/Comment/likes.vue').default);
Vue.component('like', require('./components/LikeComp.vue').default);
Vue.component('init', require('./components/InitComp.vue').default);
Vue.component('post-noty', require('./components/PostNoty.vue').default);
Vue.component('notify', require('./components/Notification.vue').default);
Vue.component('unread', require('./components/UnreadNots.vue').default);
Vue.component('follow-post', require('./components/FollowPost.vue').default);


const app = new Vue({
	el: '#app',
	store
});



