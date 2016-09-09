module.exports = function( grunt ) {
	require( 'time-grunt' )( grunt );

	var path = require( 'path' );

	/**
	 * Keep Grunt tasks in their own directory (tasks) and include them all at
	 * once, including registering the tasks.
	 * See: https://www.npmjs.com/package/load-grunt-config
	 */
	require( 'load-grunt-config' )( grunt, {
		configPath: path.join( process.cwd(), 'tasks' ),
	} );

	// Don't stop because of an error.
	grunt.option( 'force', true );

	// Register grunt tasks.
	grunt.registerTask(
		'default', []
	);
}
