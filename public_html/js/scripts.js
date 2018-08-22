define(
  ['jQuery'], 
  function() 
  {
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


