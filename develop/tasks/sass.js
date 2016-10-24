/**
 * Module: grunt-contrib-sass
 * Documentation: https://www.npmjs.com/package/grunt-contrib-sass
 */

module.exports = {
	develop : {
		options: {
			loadPath: '<%= scss.paths %>',
			cacheLocation: './develop/sass/cache',
			update: true
		},
		files: {
			'./assets/css/xavier.css': './templates/commons/scss/core.scss',
		},
	},

	build : {
		options: {
			loadPath: '<%= scss.paths %>',
			sourcemap: 'none',
			cacheLocation: './develop/sass/cache',
			style: 'compressed'
		},
		files: {
			'./assets/css/xavier.min.css': './templates/commons/scss/core.scss',
		},
	},
};
