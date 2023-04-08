const wpUrl = 'http://192.168.1.216/_dengun_work_space/'
const dest = './dist'

function getCopyConfig (source) {
  return {
    from: source,
    to: './',
    ignore: [
      '*.js',
      '*.scss',
      '*.php',
      '*.twig',
      'screenshot.png',
      'README.md'
    ]
  }
}

module.exports = {
  webpack: {
    entry: {
      'assets/main': './assets/main.js',
      'assets/admin': './assets/admin.js',
      'assets/editor': './assets/editor.js'
    },
    copy: [
      getCopyConfig('./Components/**/*'),
      getCopyConfig('./assets/**/*')
    ]
  },
  browserSync: {
    ghostMode: false,
    open: 'local',
    proxy: wpUrl,
    host: 'localhost',
    port: 3001,
    watchOptions: {
      ignoreInitial: true
    },
    injectChanges: true,
    reloadDebounce: 1000,
    ui: false,
    files: [
      '*.php',
      'templates/**/*',
      'lib/**/*',
      'inc/**/*',
      './Components/**/*.{php,twig,scss,js}'
    ],
    watch: true,
    https: false
  },
  webpackDevMiddleware: {
    stats: false,
    writeToDisk: true
  },
  gulp: {
    dest: dest,
    rev: {
      src: dest + '/**/*.*',
      srcRevved: [dest + '/**/*.{js,css}', '!' + dest + '/style.css'],
      srcStatic: dest + '/**/*.{html,php,twig}',
      assetSrc: [
        dest + '/**/*',
        '!' + dest + '/**/*+(css|js|json|html|php|twig|pot|md|htc|swf|xap)',
        '!' + dest + '/style.css',
        '!' + dest + '/screenshot.png',
        '!' + dest + '/favicon.ico',
        '!' + dest + '/favicon.png',
        '!' + dest + '/apple-touch-icon-180x180.png',
        '!' + dest + '/apple-touch-icon.png',
        '!' + dest + '/**/screenshot.png'
      ],
      revvedFileExtensions: ['.js', '.css'],
      staticFileExtensions: ['.html', '.php', '.twig']
    },
    replaceVersion: {
      wordpress: {
        files: './style.css',
        from: /Version: (.*)/gi,
        to: 'Version: '
      },
      php: {
        files: '!(node_modules|dist)/**/*.php',
        from: '%%NEXT_VERSION%%'
      }
    }
  }
}
