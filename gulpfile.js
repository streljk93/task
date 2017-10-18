var gulp = require('gulp');
var sass = require('gulp-sass');
var uglifyjs = require('gulp-uglifyjs');
var concat = require('gulp-concat');

gulp.task('sass', function() {
	gulp.src('assets/sass/*.sass')
		.pipe(sass())
		.pipe(gulp.dest('public/css'));
});

gulp.task('jsLibs', function() {
	gulp.src([
			'assets/libs/jquery/dist/jquery.min.js',
			'assets/libs/moment/min/moment.min.js',
			'assets/libs/datatables.net/js/jquery.dataTables.min.js',
			'assets/libs/bootstrap/dist/js/bootstrap.min.js',
			'assets/libs/bootstrap-daterangepicker/daterangepicker.js',
			'assets/libs/nprogress/nprogress.js',
			'assets/libs/angular/angular.min.js',
			'assets/libs/angular-datatables/dist/angular-datatables.min.js',
		])
		.pipe(uglifyjs())
		.pipe(concat('libs.min.js'))
		.pipe(gulp.dest('public/js'));
});

gulp.task('watch', ['sass', 'jsLibs'], function() {
	gulp.watch('assets/sass/**/*.+(scss|sass)', ['sass']);
});

gulp.task('default', ['watch']);