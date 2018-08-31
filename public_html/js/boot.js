require
(
  {
    paths: {
      'jQuery': 'jquery',
      'jQueryMaskedInput': 'jquery.maskedinput',
      'Popper': 'popper',
      'Bootstrap': 'bootstrap',
      'Vue': 'vue',
      'Vuex': 'vuex',
      'requirejs-vue': 'requirejs-vue',
      'babel-polyfill': 'polyfill',
      'ComponentBuilder': 'ComponentBuilder',
      'scripts': 'scripts',
      'API': 'API',
      'Store': 'Store',
      'Profile': 'modules/Profile'
    }
  },
  [
    'Vue', 
    'jQuery',
    'Popper',
    'jQueryMaskedInput',
    'Bootstrap',
    'requirejs-vue',
    'scripts'
  ],
  function(Vue)
  {    
    var sController = (fnGetUrlParams(location.href))["c"];
    console.log(sController);
    
    require
    (
      [
        'requirejs-vue!../templates/'+sController
      ], 
      function()
      {
        
      }
    );        
  }
);