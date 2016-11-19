/**
 * Module: grunt-webpack
 * Documentation: https://www.npmjs.com/package/grunt-webpack
 */

var path = require( 'path' );
var grunt = require( 'grunt' );
var webpack = require( 'webpack' );
var xavier = path.join( __dirname );

var vue = {
	templates : {
		'commons/core' : path.join( xavier, '/templates/commons/vue/core.vue' ),
	}
};

// Loops through the components and configurations.
grunt.file.recurse( path.join( xavier, '/templates/components' ), function( abspath, rootdir, subdir, filename ) {

	/**
	 * Adds component aliases for Vue components.
	 *
	 * NOTE: Requires components to follow a specific structure:
	 *       (e.g. templates/components/component-name/component-name.vue)
	 */
	if ( filename.match( /\.vue$/g ) ) {
		var alias = {}, name = '';

		if ( subdir.match( /\/vue/g ) ) {
			name = path.join( subdir.replace( '/vue', '' ), filename.replace( '.vue', '' ) )
		} else {
			name = path.join( 'components', filename.replace( '.vue', '' ) )
		}

		alias[ name ] = path.join( rootdir, subdir, filename );

		Object.assign( vue.templates, alias );
	}
} );

module.exports = {
	entry: [
		path.join( xavier, '/node_modules/vue/dist/vue.js' ),
		path.join( xavier, '/node_modules/vue-resource/dist/vue-resource.js' ),
		path.join( xavier, '/node_modules/vue-router/dist/vue-router.js' ),
		path.join( xavier, '/templates/commons/js/core.js' ),
	],
	output : {
		path: path.join( xavier, '/includes/js' ),
		filename: 'xavier.js',
	},
	stats: {
		colors: true,
		modules: true,
	},
	watch: true,
	resolveLoader: {
		modules: [ path.join( xavier, 'node_modules' ) ]
	},
	resolve: {
		alias : vue.templates
	},
	module: {
		loaders: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
			},
			{
				test: /\.js$/,
				loader: 'babel-loader',
				exclude: /node_modules/
			},
		]
	},
};
