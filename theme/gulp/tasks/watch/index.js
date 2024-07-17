const config = require('../../lib/configLoader');
const gulp = require('gulp');
const path = require('path');
const watch = require('gulp-watch');

watchTask = () => {
    const watchableTasks = ['images', 'svgsprite', 'themeTwig', 'themePhp', 'themeAcf', 'css', 'scripts', 'static', 'fonts', 'jsonData'];

    watchableTasks.forEach((taskName) => {
        const task = config.tasks[taskName];
        console.log(task.extensions, Array.isArray(task.extensions));
        if (task) {
            const glob = Array.isArray(task.extensions) ? path.join(config.root.src, task.src, '**/*.{' + task.extensions.join(',') + '}') : path.join(config.root.src, task.src, '**/*.' + task.extensions);
            if (taskName === 'themeTwig' || taskName === 'themePhp') {
                watch(glob, gulp.series(taskName, 'css'));
            } else {
                watch(glob, gulp.series(taskName));
            }
        }
    });
};

gulp.task('watch', watchTask);
module.exports = watchTask;



