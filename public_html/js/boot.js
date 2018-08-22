require
(
  {
    paths: {
      'jQuery': 'https://unpkg.com/jquery@3.3.1/dist/jquery',
      'Vue': 'https://unpkg.com/vue@2.5.17/dist/vue',
      'Vuex': 'https://unpkg.com/vuex@3.0.1/dist/vuex',
      'requirejs-vue': 'https://unpkg.com/requirejs-vue@1.1.5/requirejs-vue',
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
        `requirejs-vue!../templates/${sController}`,
        'qtip'
      ], 
      function(oApplication)
      {
        oApplication.$mount('#application');
      }
    );        
  }
);