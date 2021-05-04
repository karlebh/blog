import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		nots: [],
	},

	getters: { 
		allNots(state) {
			let notifications, i = null
			for(i = 0; i <= state.nots.length; i++) {
				notifications = i
			}
			return notifications
		},

		notsCount(state) {
			return state.nots.length === 0 ? null :  state.nots.length
		}
	}, 

	mutations: {
		addNots(state, nots) {
			state.nots.unshift(nots)
		}
	}
});


