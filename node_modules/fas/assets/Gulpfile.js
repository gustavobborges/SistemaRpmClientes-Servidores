var gulp = require('gulp'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify'),
    clean = require('gulp-clean'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    useref = require('gulp-useref'),
    connectSSI = require('fed-ssi'),
    gutil = require('gulp-util'),
    cssUrlVersion = require('fas-css-urlversion'),
    inlineImage = require('gulp-inline-imgurl'),
    autoprefixer = require('gulp-autoprefixer'),
    imagemin = require('gulp-imagemin'),
    mock = require('fed-mock'),
    plumber = require('gulp-plumber'),
    connect = require('gulp-connect');

var path = require('path')
var env = gutil.env.type
var build = env == 'component' ? './build' : './build/assets'
var _dir = path.resolve(__dirname, '../')

gulp.task('connect', function() {
    connect.server({
        root: _dir,
        port: 2000,
        livereload: true,
        middleware: function(connect, opt) {
            var middlewares = [];
            middlewares.push(connectSSI({
                ext: '.html',
                baseDir: _dir,
                payload: {
                    ENV_TYPE: 'dev',
                    https: false,
                    channel: '',
                    page: 'package.json'
                }
            }))
            return middlewares;
        }
    });
});

gulp.task('mock', function() {
    connect.server({
        root: '/gitlab',
        port: 3001,
        livereload: true,
        middleware: function(connect, opt) {
            var middlewares = [];
            middlewares.push(mock(
                '', ''
            ))
            return middlewares
        }
    })
})

gulp.task('livereload', function() {
    gulp.src(build)
        .pipe(connect.reload());
});

gulp.task('clean', function(cb) {
    gulp.src('./build', {
            read: false
        })
        .pipe(plumber())
        .pipe(clean())
});

gulp.task('copy', ['image', 'css', 'script'], function() {
    gulp.src(['./src/**/*.html'])
        .pipe(plumber())
        .pipe(inlineImage({
            list: ['src', 'data-src']
        }))
        .pipe(useref())
        .pipe(gulp.dest('build'))
    gulp.src(['./src/temp/**'])
        .pipe(gulp.dest('./build/temp'))

})

var imageminOption = {
    progressive: true,
    svgoPlugins: [{
        removeViewBox: false
    }]
}

gulp.task('image', function() {
    gulp.src('./src/images/**')
        .pipe(plumber())
        .pipe(imagemin(imageminOption))
        .pipe(gulp.dest(build + '/images'))
    gulp.src('./src/css/images/**')
        .pipe(plumber())
        .pipe(imagemin(imageminOption))
        .pipe(gulp.dest(build + '/css/images'))
})

gulp.task('script', function() {
    gulp.src('./src/js/**.js')
        .pipe(plumber())
        // .pipe(jshint({
        //     strict: false
        // }))
        // .pipe(jshint.reporter(stylish))
        .pipe(gulp.dest(build + '/js'))
})

gulp.task('css', function() {
    gulp.src('./src/css/**.scss')
        .pipe(plumber())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(autoprefixer({
            browsers: ['last 5 versions'],
            cascade: false
        }))
        .pipe(cssUrlVersion())
        .pipe(gulp.dest(build + '/css'))
});

gulp.task('watch', function() {
    gulp.watch(['./src/**'], ['copy'])
    gulp.watch([build + '/**'], ['livereload']);
});

gulp.task('default', ['copy']);

gulp.task('serve', ['copy', 'connect', 'watch']);
