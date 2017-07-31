var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');

browserSync.init({
  injectChanges: true,
  proxy: "swoonist/"
});

gulp.task('sass', function () {
  gulp.src('./sass/**.scss')
    .pipe(sass({includePaths: ['./scss'],outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream({match: '**/*.css'}));
});


gulp.task('watch', function () {
  gulp.watch(['./sass/**/*.scss'], ['sass']);
  // gulp.watch(['./**/*.php'], [browserSync.reload])
});

gulp.task('default', ['watch']);