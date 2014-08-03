var gulp = require('gulp');
var less = require('gulp-less');
var rename = require('gulp-rename');

gulp.task('less', function () {
  gulp.src('styles/index.less')
    .pipe(less())
    .pipe(rename({
      dirname: '',
      basename: 'style'
    }))
    .pipe(gulp.dest('.'));
});

gulp.task('default', ['less']);
