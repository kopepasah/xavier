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
				cwd    : './assets/js',
				src    : [ '**/*.js', '!**/*.min.js', '!libs/**/*.js' ],
				dest   : './assets/js',
				ext    : '.min.js',
			}
		]
	}
};
