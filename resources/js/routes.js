
import App from './appComp.vue'
import Index from './components/User/indexComp.vue'
import Show from './components/User/showComp.vue'
import Edit from './components/User/editComp.vue'
import NotFound from './components/User/notFoundComp.vue'


export const routes = [
			{
				name: 'home',
				path: '/home',
				component: App
			},
			{
				name: 'all',
				path: '/all',
				component: Index
			},
			{
				name: 'show',
				path: '/show/:id',
				component: Show
			},
			{
				name: 'edit',
				path: '/edit/:id',
				component: Edit
			},
			{
				name: '404',
				path: '/404',
				component: NotFound,
			},
			// {
			// 	path: '*',
			// 	redirect: '/404',
			// }
			
];