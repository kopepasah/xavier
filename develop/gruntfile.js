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
			template_directory : '..',
			develop_directory  : '.',
			scss : {
				paths : [],
			},
		},

		preMerge : function( config, data ) {

			// Set the paths for the scss files.
			data.scss.paths.push( data.template_directory + '/templates/commons/scss' );

			// Add libs path.
			data.scss.paths.push( data.template_directory + '/templates/commons/scss/libs' );

			// Loops through the components and adds paths for each component.
			grunt.file.recurse( data.template_directory + '/templates/components/', function( abspath, rootdir, subdir, filename ) {
				if ( subdir.match( /\/scss$/g ) ) {
					data.scss.paths.push( rootdir + subdir );
				}
			} );
		}
	} );

	// Don't stop because of an error.
	grunt.option( 'force', true );

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
