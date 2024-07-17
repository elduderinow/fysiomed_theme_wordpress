const config = require('../../lib/configLoader');

if (!config.tasks.themeLayout) return;

const
    gulp = require('gulp'),
    changed = require('gulp-changed'),
    plugins = require('gulp-load-plugins')({ camelize: true }),
    browserSync = require('browser-sync'),
    path = require('path'),
    handleErrors = require('../../lib/handleErrors'),
    customNotifier = require('../../lib/customNotifier'),
    paths = {
        srcTwig: path.join(config.root.src, config.tasks.themeLayout.src, '/**/*.' + config.tasks.themeLayout.extensions),
        destTwig: path.join(config.root.dest, config.tasks.themeLayout.dest)
    },
    twigTask = () => {
    console.log(paths.srcTwig, paths.destTwig);
        return gulp
            .src(paths.srcTwig)
            .pipe(changed(paths.destTwig))
            .pipe(customNotifier({ title: `destTwig ${paths.destTwig}` }))
            .on('error', handleErrors)
            .pipe(gulp.dest(paths.destTwig))
            .on('end', browserSync.reload)
            .pipe(customNotifier({ title: 'Template compiled' }));
    };

gulp.task('themeLayout', twigTask);
module.exports = twigTask;
