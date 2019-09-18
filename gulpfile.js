var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('hello', function() {
    console.log('Hossni Mubarak');
});

gulp.task('hm-button', function(){
    return gulp.src('assets/scss/hm-button.scss')
        .pipe(sass()) // Using gulp-sass
        .pipe(gulp.dest('assets/css'))
});