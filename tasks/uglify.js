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
				cwd    : './includes/js',
				src    : [ '**/*.js', '!**/*.min.js', '!libs/**/*.js' ],
				dest   : './includes/js',
				ext    : '.min.js',
			}
		]
	}
};
