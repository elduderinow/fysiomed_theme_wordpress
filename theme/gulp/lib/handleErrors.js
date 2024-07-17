const
    notify = require('gulp-notify'),
    chalk = require('chalk');

module.exports = ({plugin, message, file, fileName} = {}) => {
    notify.onError({
        title: `${plugin} failed`,
        message: 'error'
    }).apply(this, arguments);

    let report = '';

    report += `\n ${chalk.red(`${message}`)} \n\n`;
    if (fileName || file) report += `${chalk.red(`${fileName || file}`)} \n`;

    console.error(report);

        // Keep gulp from hanging on this task
    if (typeof this.emit === 'function') this.emit('end');
};
