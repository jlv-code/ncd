/**
	@author: jlv
	@version: 1.0
 */

var gulp	= require('gulp');
var order	= require('gulp-order');
var sass	= require('gulp-ruby-sass');
var concat	= require('gulp-concat');
var csso	= require('gulp-csso');
var strip	= require('gulp-csso');
var prefixer	= require('gulp-autoprefixer');
var sourcemaps	= require('gulp-sourcemaps');

gulp.task('compileSass',function(){

	return sass('resources/sass/**/*.scss',{sourcemap: true, noCache:true})
		.on('error', sass.logError)
		.pipe(sourcemaps.write('maps', {
			includeContent: false,
			sourceRoot: 'source'
		}))
		.pipe(gulp.dest('static/css/'));

});

gulp.task('concatsStyles',function(){

	return gulp.src('static/css/**/*.css')
		.pipe(order([
			"config.css",
			"reset.css",
			"header.css",
			"global.css",
			"footer.css",
			"*.css",
			]))
		.pipe(strip(true))
		.pipe(sourcemaps.init())
		.pipe(concat('style.css'))
		.pipe(prefixer({
			browsers: ['last 10 versions'],
			cascade: false
		}))
		.pipe(csso())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));

});

gulp.task('default',function(){

	gulp.watch('resources/sass/**/*.scss',['compileSass']);
	gulp.watch('static/css/**/*.css',['concatsStyles']);

});