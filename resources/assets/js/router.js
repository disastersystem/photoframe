import VueRouter from 'vue-router'

let routes = [{
		path: '/',
		component: require('./views/Home')
	}, {
		path: '/group/:id',
		component: require('./views/Group')
	}
]

export default new VueRouter({
	// mode: 'history',
	routes,
	linkActiveClass: 'is-active'
})