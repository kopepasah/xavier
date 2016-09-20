/**
 * Module: grunt-contrib-copy
 * Documentation: https://www.npmjs.com/package/grunt-contrib-copy
 */

module.exports = {
	libs: {
		files: [
			{
				expand: true,
				cwd: '<%= develop_directory %>/node_modules/vue/dist',
				src: ['vue.js','vue.min.js','vue.min.js.map'],
				dest: '<%= template_directory %>/build/scripts/libs/vue',
			}
		],
	},
};
