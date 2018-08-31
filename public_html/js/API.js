define(
  [
    
  ],
  function()
  {
    return {
      fnValidate: function(oData, fnSuccess)
      {
        console.log('API - fnValidate');
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "validate",
              oData: oData
            },
            async: false,
            success: fnSuccess,
            error: function(oXHR, sException)
            {
              console.log(oXHR, sException);
            }
          }
        );
      },
      fnPost: function(oData, sType, fnSuccess)
      {
        console.log('API - fnPost', oData, sType, fnSuccess);
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "post",
              sType: sType,
              oData: oData
            },
            success: fnSuccess,
            error: function(oXHR, sException)
            {
              console.log(oXHR, sException);
            }
          }
        );
      },
      fnGetApplicationFields: function(sType, fnSuccess)
      {
        console.log('API - fnGetApplicationFields');
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "getApplicationFields",
              sType: sType
            },
            success: fnSuccess,
            error: function(oXHR, sException)
            {
              console.log(oXHR, sException);
            }
          }
        );
      },      
      fnGetApplicationData: function(iApplicationID, fnSuccess)
      {
        console.log('API - fnGetApplicationData');
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "getApplicationData",
              iApplicationID: iApplicationID
            },
            success: fnSuccess,
            error: function(oXHR, sException)
            {
              console.log(oXHR, sException);
            }
          }
        );
      }
    };
  }
);

