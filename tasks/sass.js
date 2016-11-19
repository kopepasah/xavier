/**
 * Module: grunt-contrib-sass
 * Documentation: https://www.npmjs.com/package/grunt-contrib-sass
 */

module.exports = {
	develop : {
		options: {
			loadPath: '<%= scss.paths %>',
			cacheLocation: './templates/commons/scss/cache',
			update: true
		},
		files: {
			'./includes/css/xavier.css': './templates/commons/scss/core.scss',
		},
	},

	build : {
		options: {
			loadPath: '<%= scss.paths %>',
			sourcemap: 'none',
			cacheLocation: './templates/commons/scss/cache',
			style: 'compressed'
		},
		files: {
			'./includes/css/xavier.min.css': './templates/commons/scss/core.scss',
		},
	},
};
