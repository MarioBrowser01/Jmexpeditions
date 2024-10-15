const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const cssnano = require('gulp-cssnano');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();

// Definir los paths aquí
const paths = {
  sass: 'src/sass/**/*.scss',
  jsmodal: 'src/js/modal/**/*.js',
  jsform: 'src/js/forms/**/*.js',
  jslanding: 'src/js/landing/**/*.js',  // Agregando esta línea
  // images: 'src/images/**/*' // Comentado porque no se va a usar ahora
};


function compileSass() {
  return src(paths.sass)
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/css'))
    .pipe(browserSync.stream());
}

function formsJs() {
  return src(paths.jsform)
    .pipe(concat('forms.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/forms'))
    .pipe(browserSync.stream());
}

function modalJs() {
  return src(paths.jsmodal)
    .pipe(concat('modal.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/modal'))
    .pipe(browserSync.stream());
}
function landingJs() {
  return src(paths.jslanding)
    .pipe(concat('landing.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/landing'))
    .pipe(browserSync.stream());
}

function serve(done) {
  browserSync.init({
    server: {
      baseDir: './'
    }
  });
  watch(paths.sass, compileSass);
  watch(paths.jsform, formsJs);
  watch(paths.jsmodal, modalJs);
  watch(paths.jslanding, landingJs);
  // watch(paths.images, optimizeImages); // Comentado porque no se va a usar ahora
  watch('./*.php').on('change', browserSync.reload);
  done();
}

exports.default = series(
  parallel(compileSass, formsJs, modalJs, landingJs),
  serve
);
