var gulp = require('gulp');
var browserSync = require('browser-sync');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var imagemin = require('gulp-imagemin');
var changed = require('gulp-changed');
var htmlReplace = require('gulp-html-replace');
var htmlMin = require('gulp-htmlmin');
//var php = require('gulp-connect-php');

var config = {
    dist: 'dist/',
    src: '/public',
    cssin: 'public/css/**/*.css',
    cssout: 'dist/css/',
    jsin: 'public/js/**/*.js',
    jsout: 'dist/js/',
    cssoutname: 'style.css'
}


gulp.task('reload', function(){
    browserSync.reload();
});

gulp.task('serve', ['sass'], function(){
    
    browserSync({
        server: 'public'
    });
    
    gulp.watch('public/*.html', ['reload']);
    gulp.watch('public/css/**/*.scss', ['sass']);
});

gulp.task('sass', function(){
    return gulp.src('public/css/**/*.scss')
            .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(autoprefixer({
                browsers: ['last 3 versions']
            }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest('public/css'))
            .pipe(browserSync.stream());
});

gulp.task('minifyCss', function() {
    return gulp.src(config.cssin)
            .pipe(cleanCSS())
            .pipe(gulp.dest(config.cssout));
});

gulp.task('minifyJs', function() {
    return gulp.src('public/js/**/*.js')
            .pipe(concat('script.js'))
            .pipe(uglify())
            .pipe(gulp.dest('dist/js'));
});

gulp.task('img', function(){
    return gulp.src('src/img/**/*.{jpg,jpeg,png,gif}')
    //podajemy folder docelowy w którym będą przechowywane przetworzone obrazy
    //dzięki temu obrazy już przetworzone nie będą ponownie przetwarzane
    //przetworzone zostaną jedynie nowe obrazy
            .pipe(changed('dist/img'))
            .pipe(imagemin())
            .pipe(gulp.dest('dist/img'));
});

gulp.task('html', function(){
   return gulp.src('resources/views/**/*.php')
           .pipe(htmlReplace({
                'css': 'css/style.css',
                'js': 'js/script.js'
           }))
           .pipe(htmlMin({
                //atrybuty związane z tagami html zostają posortowane alfabetycznie
                sortAttributes: true,
                //sortowanie klas alfabetycznie
                sortClassName: true,
                collapseWhitespace: true
           }))
           .pipe(gulp.dest('dist/'));
});

/*gulp.task('serverStart', function() {

    // start the php server
    // make sure we use the public directory since this is Laravel
    php.server({
        base: './public'
    });

});
*/

gulp.task('default', ['serve']);