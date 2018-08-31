define(
  ['jQuery'], 
  function() 
  {
    window.mergeObjects = function(oTarget) {
      var oResult = {};

      for (var sKey in oTarget) {
        if (oTarget.hasOwnProperty(sKey)) {
          oResult[sKey] = oTarget[sKey];
        }
      }
      
      for (var iIndex = 1; iIndex < arguments.length; iIndex++) {
        var oSource = arguments[iIndex];
        for (var sKey in oSource) {
          if (oSource.hasOwnProperty(sKey)) {
            oResult[sKey] = oSource[sKey];
          }
        }
      }
      return oResult;
    }
    
    window.fnGetUrlParams = function(sURL) 
    {
      var aHashes = sURL.slice(sURL.indexOf('?') + 1).split('&');
      return aHashes
        .reduce(
          function(oParameters, sHash)
          {
            var aHash = sHash.split('=');
            var oNewParameter = {};
            
            oNewParameter[aHash[0]] = decodeURIComponent(aHash[1]);
            
            return mergeObjects(oParameters, oNewParameter);
          }, 
          {}
        );
    }

    window.fnSetUrlParams = function(sURL, oParameters, bUpdate) 
    {
      var sBaseURL = sURL.split('?')[0];

      var oNewParameters = {};

      if (bUpdate) {
        var oBaseParameters = fnGetUrlParams(sURL);
        oNewParameters = Object.assign(oBaseParameters, oParameters);
      } else {
        oNewParameters = oParameters;
      }

      var aParameters = [];

      for (var sKey in oNewParameters) {
        aParameters.push(sKey+'='+oNewParameters[sKey]);
      }

      return sBaseURL+'?'+aParameters.join('&');
    }

    window.onscroll = function()
    {
      var oHeader = document.querySelector(".header");
      var oParent = oHeader.parentNode;
      var iParentWidth = oParent.clientWidth+"px";
      var iHeaderOffsetTop = oHeader.offsetTop;
      
      var oTopMemu = document.querySelector(".top-menu");
      var oButtonPanel = document.querySelector(".button-panel");
      
      var oContent = document.querySelector(".content");

      if (window.pageYOffset > iHeaderOffsetTop) {
        oHeader.classList.add("sticky-header");
        oHeader.style.width = iParentWidth;
        oTopMemu.classList.add("sticky-top-menu");
        oTopMemu.style.width = iParentWidth;
        if (oButtonPanel) {
          oButtonPanel.classList.add("sticky-button-panel");
          oButtonPanel.style.width = iParentWidth;
        }
        oContent.classList.add("top-offseted");
      } else {
        oHeader.classList.remove("sticky-header");
        oHeader.style.width = "100%";
        oTopMemu.classList.remove("sticky-top-menu");
        oTopMemu.style.width = "100%";
        if (oButtonPanel) {
          oButtonPanel.classList.remove("sticky-button-panel");
          oButtonPanel.style.width = "100%";
        }
        oContent.classList.remove("top-offseted");
      }      
    };
  }
);


