const gulp = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-dart-sass');
const stylelint = require('gulp-stylelint');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync');
const reload = browserSync.reload;
const concat = require('gulp-concat');

gulp.task('babel', () =>
  gulp.src('js/*.js')
  .pipe(sourcemaps.init())
  .pipe(babel({
      presets: ['@babel/env']
  }))
  .pipe(concat('main.js'))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest('.'))
  .pipe(reload({ stream: true }))
);

gulp.task('browser-sync', function() {
  const files = ['./scss/*.s+(a|c)ss', './*.php', './js/*.js',];
  browserSync.init(files, {
    proxy: 'https://yoursitename.local',
    notify: true
  });
  gulp.watch('./scss/**/*.s+(a|c)ss', gulp.series(css));
  gulp.watch('./js/*.js'), gulp.series('babel');
  gulp.watch('./*.php').on('change', browserSync.reload);
});

const css = function() {
  return gulp
    .src('./scss/**/*.s+(a|c)ss')
    .pipe(stylelint({
      reporters: [
        {formatter: 'string', console: true}
      ],
      failAfterError: true,
      console: true
    }))
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: 'expanded'
      }).on('error', sass.logError)
    )
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(concat('style.css'))
    .pipe(gulp.dest('./'))
    .pipe(reload({ stream: true }));
};

const minify = function() {
  return gulp
    .src('./scss/**/*.s+(a|c)ss')
    .pipe(stylelint({
      reporters: [
        {formatter: 'string', console: true}
      ],
      failAfterError: true,
      console: true
    }))
    .pipe(
      sass({
        outputStyle: 'compressed'
      }).on('error', sass.logError)
    )
    .pipe(autoprefixer())
    .pipe(concat('style.css'))
    .pipe(gulp.dest('./'))
};

const watch = function(cb) {
  gulp.watch('./scss/**/*.scss', gulp.series(css));
  gulp.watch('./js/*.js'), gulp.series('babel');
  gulp.watch('./*.php').on('change', browserSync.reload);
  cb();
};

gulp.task('vendors', function() {
  return gulp.src('node_modules/@fortawesome/fontawesome-free/js/all.js')
    .pipe(concat('all.js'))
    .pipe(gulp.dest('vendors/'))
    .pipe(reload({ stream: true }));
});

exports.css = css;
exports.watch = watch;
exports.build = gulp.series(minify, 'babel', 'vendors');
exports.default = gulp.series(css, 'babel', 'vendors', watch, 'browser-sync');

// gulp.series // one by one
// gulp.parallel // altogether
