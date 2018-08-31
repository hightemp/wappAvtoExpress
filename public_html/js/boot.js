require
(
  {
    paths: {
      'jQuery': 'https://unpkg.com/jquery@3.3.1/dist/jquery',
      'jQueryMaskedInput': 'jquery.maskedinput',
      'Popper': 'popper',
      'Bootstrap': 'bootstrap',
      'Vue': 'https://unpkg.com/vue@2.5.17/dist/vue',
      'Vuex': 'https://unpkg.com/vuex@3.0.1/dist/vuex',
      'requirejs-vue': 'https://unpkg.com/requirejs-vue@1.1.5/requirejs-vue',
      'ComponentBuilder': 'ComponentBuilder',
      'qtip': 'jquery.qtip.min',
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
    'requirejs-vue',
    'scripts'
  ],
  function(Vue)
  {    
    var sController = (new URLSearchParams(location.search)).get("c");
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