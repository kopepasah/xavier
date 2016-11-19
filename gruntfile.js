module.exports = function( grunt ) {
	require( 'time-grunt' )( grunt );

	var path = require( 'path' );

	/**
	 * Keep Grunt tasks in their own directory (tasks) and include them all at
	 * once, including registering the tasks.
	 * See: https://www.npmjs.com/package/load-grunt-config
	 */
	require( 'load-grunt-config' )( grunt, {
		configPath : path.join( process.cwd(), 'tasks' ),

		data : {
			scss : {
				paths : [],
			},
		},

		preMerge : function( config, data ) {
			// Set the paths for the scss files.
			data.scss.paths.push( path.join( __dirname, '/templates/commons/scss' ) );

			// Add libs path.
			data.scss.paths.push( path.join( __dirname, '/templates/commons/scss/libs/' ) );
		}
	} );

	grunt.registerTask(
		'null', []
	);

	// Register grunt tasks.
	grunt.registerTask(
		'build', [
			'sass:build',
			'copy:libs',
			'webpack:build',
			'uglify:build',
		]
	);
}
