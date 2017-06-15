import VueRouter from 'vue-router';


let routes=[
	{ path: '/', component: require('./components/Customers') },
	{ path: '/c', component: require('./components/Customers') },
	{ path: '/p', component: require('./components/products') },
	{ path: '/o', component: require('./components/Orders') },
	{ path: '/createClient' , component: require('./components/customers/formclt') },
	{ path: '/createProduct' , component: require('./components/products/formprd') }

];


//routes = new VueRouter({routes});



export default new VueRouter({

	routes,

});

