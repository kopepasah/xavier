/**
 * Module: grunt-contrib-copy
 * Documentation: https://www.npmjs.com/package/grunt-contrib-copy
 */

module.exports = {
	libs: {
		files: [
			{
				expand: true,
				cwd: './node_modules/bootstrap/dist/js',
				src: ['bootstrap.js','bootstrap.min.js'],
				dest: './includes/js/libs/bootstrap',
			},
			{
				expand: true,
				cwd: './node_modules/bootstrap/scss/',
				src: ['**'],
				dest: './templates/commons/scss/libs/bootstrap',
			}
		],
	},
};
