(function(){
  jQuery(document).ready(function(){
    if (!document.location.href.includes("display=uofm_list")) {
      if (document.location.href.includes("display=grid")) {
        newurl = document.location.href.replace("?display=grid","?display=uofm_list");
      }
      else
      {
        newurl = document.location.href + "?display=uofm_list";
      }
      document.location.href = newurl;
      return false;
    }
  });
})();
