module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
        options: {
            sourceMap: false,
            //outputStyle: 'compressed'
        },
        dist: {
            files: {
                'style.css': 'assets/css/style.scss'
            }
        }
    },
    browserify: {
      bundle: {
        files: {
          'assets/js/bundle.js': 'assets/js/prebundle.js'
        }
      }
    },
    postcss: {
      options: {
        map: true, // inline sourcemaps
        processors: [
           require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
           require('cssnano')() // minify the result
        ]
      },
      dist: {
        src: 'style.css'
      }
    },
    uglify: {
      js: {
        files: {
          'assets/js/bundle.js': 'assets/js/bundle.js'
        }
      }
    },
    exec: {
      builddev: {
        cmd: function(){
          var o = '';
          var targetDir = 'dev';
          var cmdTitle = 'Build de desarrollo';
          var cmds = [
            {cmd: 'grunt compilesass > /dev/null', title: 'Compilando SASS'},
            {cmd: 'grunt compileprejs > /dev/null', title: 'Compilando JS'},
          ];
            o += 'echo `tput setaf 2`"Luna Punto © 2017 @ '+cmdTitle+'" && ';
          for(var i = 0; i < cmds.length; i++){
            var t = cmds[i];
            var pct = ((i+1) * 100) / cmds.length;
                pct = Math.round(pct) + '%';
            o += 'echo `tput setaf 6`"☾ '+t.title+'... "';
            o += (t.cmd.length ? ' && '+t.cmd+' ' : ' ');
            o += ' && echo `tput setaf 3`"✔ Terminado ('+pct+')" ';
            o += (cmds.length !== i+1 ? ' && ' : '');
          }
            o += ' && echo  `tput sgr0`"Esuchando JS y CSS. Ctrl + C para terminar." && grunt watchme';
          return o;
        }
      },
      buildpublic: {
        cmd: function(){
          var o = '';
          var targetDir = 'public';
          var cmdTitle = 'Build de producción';
          var cmds = [
            {cmd: 'grunt compilesass > /dev/null', title: 'Compilando SASS'},
            {cmd: 'grunt compilepostcss > /dev/null', title: 'Añadiendo compatibilidad'},
            {cmd: 'grunt compilejs > /dev/null', title: 'Compilando JS'}
          ];
            o += 'echo `tput setaf 2`"Luna Punto © 2017 @ '+cmdTitle+'" && ';
          for(var i = 0; i < cmds.length; i++){
            var t = cmds[i];
            var pct = ((i+1) * 100) / cmds.length;
                pct = Math.round(pct) + '%';
            o += 'echo `tput setaf 6`"☾ '+t.title+'... "';
            o += (t.cmd.length ? ' && '+t.cmd+' ' : ' ');
            o += ' && echo `tput setaf 3`"✔ Terminado ('+pct+')" ';
            o += (cmds.length !== i+1 ? ' && ' : '');
          }
          return o;
        }
      },
    },
    watch: {
      scripts: {
        files: ['assets/js/*.js', 'assets/js/**/*.js', '!assets/js/bundle.js'],
        tasks: ['compileprejs'],
        options: {
          spawn: false,
        },
      },
      styles: {
        files: ['assets/css/*.scss', 'assets/css/**/*.scss'],
        tasks: ['compilesass'],
        options: {
          spawn: false,
        },
      },
    },
  });

  grunt.loadNpmTasks('grunt-exec');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-file-creator');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-browserify');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');

  grunt.registerTask('compilesass', ['sass']);
  grunt.registerTask('compilepostcss', ['postcss']);
  grunt.registerTask('compileprejs', ['browserify']);
  grunt.registerTask('compilejs', ['browserify', 'uglify']);
  grunt.registerTask('setsite', ['file-creator']);
  grunt.registerTask('dev', ['exec:builddev']);
  grunt.registerTask('public', ['exec:buildpublic']);
  grunt.registerTask('logwatch', ['exec:buildpublic']);
  grunt.registerTask('watchme', ['watch']);
};
