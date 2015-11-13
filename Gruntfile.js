module.exports = function (grunt) {

    grunt.initConfig({
        iconizr: {
            options: {
                dims: true,
                common: "svg-icon",
                keep      : false,
                preview   : 'preview',
                padding: 1,
                render    : {
                    css     : false,
                    scss    : '../scss'
                }
            },
            your_target: {
                src      : '/public/images/icons/',
                dest     : '/public/images/icons/old'
            }
        }
    });

    grunt.loadNpmTasks('grunt-iconizr');

    grunt.registerTask('build-icons', ['iconizr']);
};
