<template>
  <div v-for="oRecord in aRecords">
    
  </div>
</template>

<script>
define(
  [
    'Vue',
    'Store'
  ],
  function(Vue, oStore, fnCreateTextField)
  {
    var oApplication = new Vue({
      template: template,

      data: {
        aRecords: []
      },
      
      store: oStore,

      beforeCreate: function()
      {
        console.log('beforeCreate');
             
      },
      
      created: function()
      {
        console.log('Application created');
      },

      mounted: function()
      {
        console.log('Application mounted');        
      },
      
      methods: {                
      }      
    });

    return oApplication;
  }
);
</script>