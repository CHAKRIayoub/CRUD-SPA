import VueRouter from 'vue-router';


let routes=[
	{ path: '/', component: require('./components/Customers') },
	{ path: '/c', component: require('./components/Customers') },
	{ path: '/p', component: require('./components/Products') },
	{ path: '/o', component: require('./components/Orders') },
	{ path: '/createClient' , component: require('./components/customers/formclt') }


];


//routes = new VueRouter({routes});



export default new VueRouter({

	routes,

});

