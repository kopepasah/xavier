/**
 * Bootstrap Xavier Core
 */

var xavier = window.xavier || {};

import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import Core from 'commons/core'

Vue.use( VueResource );
Vue.use( VueRouter );

new Vue({
	el : 'xavier',

	http : {
		root : xavier.utils.root,
	},

	render : h => h(Core),

	template : '<Core/>',

	components : {
		Core
	},
});
