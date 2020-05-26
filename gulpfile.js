const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

const cssFile = [
	'./assets/css/main.css'
];
// 
function styles() {
	return gulp.src(cssFile)
	.pipe(concat('main.min.css'))
	.pipe(cleanCSS({
		level: 2
	}))
    .pipe(gulp.dest('./assets/css/'))
}
gulp.task('styles', styles);

const mainJsFile = [
	'./assets/js/main.js'
];

function mainJS() {
	return gulp.src(mainJsFile)
	.pipe(concat('main.min.js'))
	.pipe(uglify({
		toplevel: true
	}))
	.pipe(gulp.dest('./assets/js/'))
}
gulp.task('mainJS', mainJS);

function watch() {
    gulp.watch('./assets/css/main.css', styles);
    gulp.watch('./assets/js/main.js', mainJS);
}
gulp.task('watch', watch);

gulp.task('bild', gulp.parallel(styles, mainJS));

gulp.task('dev', gulp.series('bild', 'watch'));












