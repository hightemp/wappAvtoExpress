define(
  [
    
  ],
  function()
  {
    return {
      fnValidate: function(oData, fnSuccess)
      {
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "validate",
              oData
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
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "post",
              sType: sType,
              oData
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
        $.ajax(
          '',
          {
            method: "POST",
            data: {
              sAction: "getApplicationData",
              iApplicationID: iApplicationID,
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

