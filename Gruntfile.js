module.exports = function(grunt){
	//项目配置
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		banner: '/*!\n' +
	            ' * Theme Name: <%= pkg.name %>\n' +
	            ' * Theme URI: <%= pkg.themeURI %>\n' +
	            ' * Description: <%= pkg.description %>\n' +
	            ' * Author: <%= pkg.author %>\n' + 
	            ' * Author URI: <%= pkg.authorURI %>\n' + 
	            ' * Version: <%= pkg.version %>\n' +
	            ' * © <%= grunt.template.today("yyyy") %> themes.xiguabaobao.com. All rights reserved.\n' +
	            ' */\n',
	    uglify: {
	    	options: {
	    		banner: '<%= banner %>'
	    	},
	    	build: {
	    		files: {
	    			'js/all.min.js': [
	    				'js/jquery.min.js',
	    				'js/jquery.lazyload.min.js',
	    				'js/jquery.topbar.js',
	    				'js/jquery.subscribe-better.js',
	    				'js/script.js'
	    			]
	    		}
	    	}
	    },
	    csscomb: {
			options: {
				config: 'css/.csscomb.json'
			},
			build: {
				files: {
					'style.css': 'style.css'
				}
			}
		},
	    cssmin: {
	    	options: {
	    		banner: '<%= banner %>',
	    		keepSpecialComments: '0'
	    	},
	    	build: {
	    		files: {
	    			'style.css': [
	    				'css/pure.css',
	    				'css/base.css',
	    				'css/screen.css',
	    				'css/post.css',
	    				'css/bdshare.custom.css',
	    				'css/duoshuo.custom.css',
	    				'css/subscribe-better.css',
	    				'css/typography.css'
	    			]
	    		}
	    	}
	    },
	    watch: {
	    	css: {
	    		files: ['css/*.css'],
	    		tasks: ['cssmin']
	    	},
	    	js: {
	    		files: ['js/*.js'],
	    		tasks: ['uglify']
	    	}
	    }
	});

	//加载插件
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-csscomb');

	//指定任务
	grunt.registerTask('default', ['uglify', 'csscomb', 'cssmin']);
};