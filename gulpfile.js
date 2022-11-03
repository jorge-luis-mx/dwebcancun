
const { src, dest, watch, series,parallel }= require('gulp');
const sass=require('gulp-sass')(require('sass'));
//para soporte en distos navegadores styles
const postcss = require('gulp-postcss');
const autoprefixer= require('autoprefixer');


function css(done){
   //compilar sass
   //pasos: 1 -identificar el archivo, 2 -compilarla, 3 -guardar el .css
   src('assets/scss/app.scss')
      .pipe(sass({outputStyle:'compressed'}))
      .pipe(postcss([autoprefixer()]))
      .pipe(dest('assets/build/css'))
      done();
}

function dev(){
   watch('assets/scss/**/*.scss',css)
}




exports.css=css;
exports.dev=dev;
exports.default=series(css,dev);
//exports.default=parallel(css,dev);
//series: se inicia una tarea, hasta que finaliza e inicia la siguiente
//paralel:todos inicia al mismo tiempo

//ejcutar asi: gulp dev
