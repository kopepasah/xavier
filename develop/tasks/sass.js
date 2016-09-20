/**
 * Module: grunt-contrib-sass
 * Documentation: https://www.npmjs.com/package/grunt-contrib-sass
 */

module.exports = {
	banner : {
		options: {
			sourcemap: 'none',
			noCache: true,
			update: true
		},
		files: {
			'<%= template_directory %>/style.css': '<%= develop_directory %>/sass/banner.txt',
		},
	},

	develop : {
		options: {
			loadPath: '<%= scss.paths %>',
			cacheLocation: '<%= develop_directory %>/sass/cache',
			update: true
		},
		files: {
			'<%= template_directory %>/build/styles/xavier.css': '<%= template_directory %>/templates/commons/scss/core.scss',
		},
	},

	build : {
		options: {
			loadPath: '<%= scss.paths %>',
			sourcemap: 'none',
			cacheLocation: '<%= develop_directory %>/sass/cache',
			style: 'compressed'
		},
		files: {
			'<%= template_directory %>/build/styles/xavier.min.css': '<%= template_directory %>/templates/commons/scss/core.scss',
		},
	},
};
