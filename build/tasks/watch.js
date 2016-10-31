/**
 * Module: grunt-contrib-watch
 * Documentation: https://www.npmjs.com/package/grunt-contrib-watch
 */

module.exports = {
	styles: {
		files: ['./templates/**/*.scss'],
		tasks: ['sass:develop','sass:build'],
		options: {
			spawn: false,
		},
	},
};
