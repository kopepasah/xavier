/**
 * Module: grunt-webpack
 * Documentation: https://www.npmjs.com/package/grunt-webpack
 */

var options = {
	entry  : '<%= template_directory %>/templates/commons/js/core.js',
	output : {
		path: '<%= template_directory %>/build/scripts',
		filename: 'xavier.js',
	},
}

module.exports = {
	watch : {
		entry: options.entry,
		output: options.output,
		stats: {
			colors: true,
			modules: true,
		},
		storeStatsTo: "xavier",
		progress: true,
		failOnError: true,
		watch: false,
	},

	build : {
		entry: options.entry,
		output: options.output,
		stats: false,
		progress: false,
		failOnError: true,
		watch: false,
	},
};
