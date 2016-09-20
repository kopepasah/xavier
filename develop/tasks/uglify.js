/**
 * Module: grunt-contrib-uglify
 * Documentation: https://www.npmjs.com/package/grunt-contrib-uglify
 */

module.exports = {
	build: {
		options: {
			sourceMap : true,
		},
		files: [
			{
				expand : true,
				cwd    : '<%= package.template_directory %>/build/scripts',
				src    : [ '**/*.js', '!libs/**/*.js' ],
				dest   : '<%= package.template_directory %>/build/scripts',
				ext    : '.min.js',
			}
		]
	}
};
