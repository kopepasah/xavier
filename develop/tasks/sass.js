/**
 * Module: grunt-contrib-sass
 * Documentation: https://www.npmjs.com/package/grunt-contrib-sass
 */

var grunt = require( 'grunt' );

module.exports = {
	banner : {
		options: {
			sourcemap: 'none',
			noCache: true,
			update: true
		},
		files: {
			'<%= package.template_directory %>/style.css': '<%= package.develop_directory %>/sass/banner.txt',
		}
	}
};
