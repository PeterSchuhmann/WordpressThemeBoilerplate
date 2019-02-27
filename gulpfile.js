// Required ////////////////////////////////////////
// Don't touch this, unless you know what you're doing. 
var	gulp = require('gulp'),	
uglify = require('gulp-uglify'),
concat = require('gulp-concat'),
browserSync = require('browser-sync'),
reload = browserSync.reload,
rename = require('gulp-rename'),
plumber = require('gulp-plumber'),
sass = require('gulp-sass'),
sourcemaps = require('gulp-sourcemaps'),
autoprefixer = require('gulp-autoprefixer'),
ftp = require( 'vinyl-ftp' );
gutil = require('gulp-util');
notify = require('gulp-notify');
jshint = require('gulp-jshint');
order = require('gulp-order');
postcss = require('gulp-postcss');
precss = require('precss');
postcsseasinggradients = require('postcss-easing-gradients');
livereload = require('gulp-livereload');


// Globals ////////////////////////////////////////

// Project
var localProjectURL = 'http://themename-local/'; // Local URL for Browsersync. String.
var remoteProjectURL = 'https://themename-local/'; // Remote URL for Browsersync. String.

// FTP
// WARNING: Files in the remoteFolder are overwritten without warning. 
// Make sure you have given the correct path.
// There is no way back. YOU HAVE BEEN WARNED. 
var ftpHost = 'example.com'; // Server/Host/IP. String.
var ftpPort = 21; // Port, default FTP port is 21. Integer.
var ftpUser = ''; // User. String.
var ftpPw = ''; // Password. String.
var ftpParallelConnections = 3; // Integer.
var ftpMaxConnections = 3; // Max Parallel Connections (Don't worry too much about setting this too high, vinyl-ftp recovers from "Too man connections" nicely.) Maximum number of connections, should be greater or equal to "parallel". Integer.
var remoteFolder = '/html/example'; // Path to child-theme on FTP Server. As noted above: Double check, the given path is correct. String.

// These files will be uploaded on change via FTP 
// For the correct syntax see here: https://github.com/isaacs/minimatch
var localFiles = [
'!gulpfile.js',
'!package*.json',
'./*.css',
'./*.php',
'assets/**',
'framework/**',
'includes/**'
];  


// Functions ////////////////////////////////////////

// Helper function for ftp setup
function getFtpConnection() {  
	return ftp.create({
		host:	ftpHost,
		user: ftpUser,
		port: ftpPort,
		password: ftpPw,
		parallel: ftpParallelConnections,
		maxConnections: ftpMaxConnections,
		log: gutil.log
	});
}

// Tasks ////////////////////////////////////////

// JS
gulp.task('vendor-scripts', function() {
    gulp.src([
    		'assets/javascript/01-vendor/*.js',
        	'assets/javascript/02-extend/*.js',
		])
        .pipe(plumber())
        // .pipe(jshint())
        // .pipe(jshint.reporter('jshint-stylish'))
        .pipe(concat('vendor.min.js'))
        .pipe(sourcemaps.init())
        .pipe(uglify()).on("error", notify.onError(function (error) {
        return "NOTE: " + error.message + "\n" + error.cause + "\n" + error.fileName;
    }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/js'))
        .pipe(livereload())
        .pipe(reload({stream:true}));
});

// JS
function scriptsTask() {
	return gulp.src('assets/javascript/*.js')
	.pipe(plumber())
	.pipe(jshint())
	.pipe(jshint.reporter('jshint-stylish'))
	.pipe(concat('main.min.js'))
	.pipe(sourcemaps.init())
	.pipe(uglify()).on("error", notify.onError(function (error) {
		return "NOTE: " + error.message + "\n" + error.cause + "\n" + error.fileName;
	}))
	.pipe(sourcemaps.write('./'))
	.pipe(gulp.dest('assets/js'))
	.pipe(livereload())
	.pipe(reload({stream:true}));
}


// Sass
function sassTask() {

	return gulp.src('assets/scss/**/*.scss')
	.pipe(plumber())
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(sourcemaps.init())
	.pipe(sass({
		outputStyle: 'compressed'
	}).on("error", notify.onError(function (error) {
		return "NOTE: " + error.message;
	}))
	)
	.pipe( postcss([ require('postcss-easing-gradients') ]) )
	.pipe(autoprefixer('last 4 versions'))
	.pipe(sourcemaps.write('./'))
	
	.pipe(gulp.dest('assets/css/'))
	.pipe(livereload())
	.pipe(reload({stream:true}));
};


// PHP/HTML
gulp.task('php-html', function() {
	gulp.src([
		'./*.php',
		'./*.html',
		'framework/**',
		'includes/**'	
		])
	.pipe(reload({stream:true}));
});


// Local Browsersync
gulp.task('local-browser-sync', function() {
	browserSync.init({
		proxy: localProjectURL,
		injectChanges: true,
		online: true,
		reloadDebounce: 200,
		// logLevel: "debug"
	});
});


// Remote Browsersync
gulp.task('remote-browser-sync', function() {
	browserSync.init({
		proxy: remoteProjectURL,
		injectChanges: true,
		online: true,
		reloadDebounce: 1200
	});
});


// FTP for Remote Development
gulp.task( 'deploy', function () {

	// FTP Host Data
	var conn = getFtpConnection();

	// src, filter only newer, dest
	return gulp.src( localFiles, { base: '.', buffer: false } )
	.pipe( conn.newer( remoteFolder ) )
	.pipe( conn.dest( remoteFolder ) );
});


gulp.task('ftp-deploy-watch', function() {

	var conn = getFtpConnection();

	gulp.watch(localFiles)
	.on('change', function(event) {
		console.log('Changes detected! Uploading file "' + event.path + '", ' + event.type);

		return gulp.src( [event.path], { base: '.', buffer: false } )
        .pipe( conn.newer( remoteFolder ) ) // only upload newer files 
        .pipe( conn.dest( remoteFolder ) )
        ;
     });

});


// Watch
gulp.task('watch', function(){

	console.log('watch task');

    livereload.listen();
    gulp.watch(['assets/javascript/01-vendor/*.js', 'assets/javascript/02-extend/*.js'], gulp.parallel('vendor-scripts'))
	gulp.watch('assets/javascript/*.js', scriptsTask)
	gulp.watch('assets/scss/**/*.scss', sassTask)
	gulp.watch([
		'./*.php',
		'./*.html',
		'framework/**',
		'includes/**'	
		], gulp.series('php-html')
		)
});


// Watch remote
gulp.task('watch-remote', gulp.series('ftp-deploy-watch', function(){
    livereload.listen();
    gulp.watch(['assets/javascript/01-vendor/*.js', 'assets/javascript/02-extend/*.js'], ['vendor-scripts'])
    gulp.watch('assets/javascript/*.js', scriptsTask)
	gulp.watch('assets/scss/**/*.scss', sassTask)
	gulp.watch([
		'./*.php',
		'./*.html',
		'framework/**',
		'includes/**'	
		], ['php-html']
		)
}));


// Default, local browsersync
gulp.task('default', gulp.parallel('local-browser-sync', 'watch'));


// Default, remote browsersync and ftp deploy of changed files
gulp.task('remote', gulp.parallel('remote-browser-sync', 'watch-remote'));
