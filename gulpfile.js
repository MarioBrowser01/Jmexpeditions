import { src, dest, watch, series, parallel } from 'gulp';
import sass from 'gulp-sass';
import * as dartSass from 'sass'; // Importar sass de la manera recomendada
import autoprefixer from 'autoprefixer';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import cssnano from 'cssnano';
import concat from 'gulp-concat';
import terser from 'gulp-terser-js';
import rename from 'gulp-rename';
import imagemin from 'gulp-imagemin';
import notify from 'gulp-notify';
import cache from 'gulp-cache';
import clean from 'gulp-clean';
import webp from 'gulp-webp';
import browserSync from 'browser-sync';

const browserSyncServer = browserSync.create();

// Definir los paths aquí
const paths = {
  sass_web: 'src/sass/web/**/*.scss',
  sass_admin: 'src/sass/dashboard/**/*.scss',
  jsmodal: 'src/js/dashboard/modal/**/*.js',
  jsform: 'src/js/dashboard/forms/**/*.js',
  jslanding: 'src/js/landing/**/*.js',
};

// Configurar gulp-sass para usar dart-sass
const sassCompiler = sass(dartSass);

function css_web() {
  return src(paths.sass_web)
    .pipe(sourcemaps.init())
    .pipe(sassCompiler().on('error', sassCompiler.logError)) // Usar el compilador
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/css/landing'));
}

function css_admin() {
  return src(paths.sass_admin)
    .pipe(sourcemaps.init())
    .pipe(sassCompiler().on('error', sassCompiler.logError)) // Usar el compilador
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/css/dashboard'));
}

function formsJs() {
  return src(paths.jsform)
    .pipe(concat('forms.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/forms'))
    .pipe(browserSyncServer.stream());
}

function modalJs() {
  return src(paths.jsmodal)
    .pipe(concat('modal.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/modal'))
    .pipe(browserSyncServer.stream());
}

function landingJs() {
  return src(paths.jslanding)
    .pipe(concat('landing.js'))
    .pipe(terser())
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('public/js/landing'))
    .pipe(browserSyncServer.stream());
}

function serve(done) {
  browserSyncServer.init({
    server: {
      baseDir: './'
    }
  });

  watch(paths.sass_web, css_web);
  watch(paths.sass_admin, css_admin);
  watch(paths.jsform, formsJs);
  watch(paths.jsmodal, modalJs);
  watch(paths.jslanding, landingJs);
  watch('./*.php').on('change', browserSyncServer.reload);
  done();
}

export default series(
  parallel(css_admin, css_web, formsJs, modalJs, landingJs),
  serve
);
