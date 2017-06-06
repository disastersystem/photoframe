import VueRouter from 'vue-router'

let routes = [{
		path: '/',
		component: require('./views/Home')
	}, {
		path: '/group/:id',
		component: require('./views/Group')
	}, {
		path: '/test',
		component: require('./views/draw')
	}
]

export default new VueRouter({
	// mode: 'history',
	routes,
	linkActiveClass: 'is-active'
})