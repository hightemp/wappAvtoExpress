define(
  [
    'Vue',
    'Vuex',
    'Profile'
  ], 
  function(Vue, Vuex, Profile) 
  {
    Vue.use(Vuex);
    
    return new Vuex.Store({
      modules: {
        //Profile
      },
      strict: false,
      plugins: [],
      ...Profile
    })
  }
);
