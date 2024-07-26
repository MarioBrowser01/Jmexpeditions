const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Definir la tarea de compilación de Sass
function compileSass() {
  return gulp.src('scss/sass/*.scss') // Ruta a tus archivos SCSS
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('dist')); // Ruta donde se guardarán los archivos CSS compilados
}

// Definir la tarea de observación
function watchFiles() {
  gulp.watch('scss/sass/*.scss', compileSass); // Observa los cambios en archivos SCSS y ejecuta la tarea 'compileSass'
}

// Definir la tarea por defecto
exports.default = gulp.series(compileSass, watchFiles);
