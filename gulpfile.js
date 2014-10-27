var gulp = require('gulp');
var less = require('gulp-less');
var rename = require('gulp-rename');

function error(e) {
  console.log(e.stack || e.message);
}

gulp.task('less-main', function () {
  gulp.src('styles/index.less')
    .pipe(less().on('error', error))
    .pipe(rename({
      dirname: '',
      basename: 'style'
    }))
    .pipe(gulp.dest('.'));
});

gulp.task('less-widgets', function () {
  gulp.src('widgets/*/style.less')
    .pipe(less().on('error', error))
    .pipe(gulp.dest('widgets'));
});

gulp.task('dev', function() {
  gulp.watch('**/*.less', ['less-widgets', 'less-main']);
});

gulp.task('default', ['less-main', 'less-widgets']);
