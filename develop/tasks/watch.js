/**
 * Module: grunt-contrib-watch
 * Documentation: https://www.npmjs.com/package/grunt-contrib-watch
 */

module.exports = {
	scripts: {
		files: ['<%= template_directory %>/templates/**/*.js'],
		tasks: ['webpack:watch'],
		options: {
			spawn: false,
		},
	},

	styles: {
		files: ['<%= template_directory %>/templates/**/*.scss'],
		tasks: ['sass:develop'],
		options: {
			spawn: false,
		},
	},
};
