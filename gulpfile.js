var gulp = require('gulp');
var sass = require('gulp-sass'); // sass to css
var cleanCSS = require('gulp-clean-css'); // minify the css
var rename = require("gulp-rename"); // rename css with suffix like .min
var concat = require("gulp-concat"); // combine two css into one

var files = {
    sass: ["assets/scss/*.scss", "assets/scss/**/*.scss"],
    css: [
        "assets/css/*.css",
        "!assets/css/*.min.css",
        "assets/css/**/*.css",
        "!assets/css/**/*.min.css",
        "assets/css/**/**/*.css",
        "!assets/css/**/**/*.min.css"
    ],
    minCSS: [
        "assets/css/*.min.css",
        "assets/css/**/*.min.css",
        "assets/css/**/**/*.min.css"
    ],
};

gulp.task('sass', function(){
    return gulp.src(files.css)
        .pipe(sass()) // Using gulp-sass
        .pipe(gulp.dest('assets/css'))
});

gulp.task('minify-css', function(){
    return gulp.src(files.css)
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(rename({ suffix: ".min" }))
        .pipe(gulp.dest('assets/css'))
});

gulp.task('combine-css', function(){
    return gulp.src(files.css)
        .pipe(concat("main.css"))
        .pipe(gulp.dest('assets/css'))
});

gulp.task('combine-min-css', function(){
    return gulp.src(files.minCSS)
        .pipe(concat("main.min.css"))
        .pipe(gulp.dest('assets/css'))
});