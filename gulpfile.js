var gulp = require( 'gulp' );
var gulpIgnore = require( 'gulp-ignore' );
var zip = require( 'gulp-zip' );

gulp.task( 'build', function () {
	return gulp.src( [
		'./*',
		'./inc/*',
		'!./node_modules',
		'!./vendor',
		'!./build',
		'!./composer.lock',
		'!./composer.phar',
		'!./package.json',
		'!./gulpfile.js'
	], {base:'./'} )
		.pipe( zip( 'ghcp-release.zip' ) )
		.pipe( gulp.dest( 'build' ) );
} );