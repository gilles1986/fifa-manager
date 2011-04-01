$(document).ready(function() {
 var siteLoaderObject =  new SiteLoader({
    "linkSelector" : ".dynLink",
    "loadElements" : {
      "default" : "#content",
      "manager" : "#manager",
      "ajaxContent" : "#ajaxContent"
    },
    "debug" : "debug"
  });
  
  var ajaxFormObject = new AjaxFormHandler({
    "linkSelector" : ".ajaxForm",
    "contentArea" : $("#ajaxContent"),
    "siteLoaderObject" : siteLoaderObject,
    "debug" : "debug"
 });
 siteLoaderObject.onSiteLoad(function() {
   ajaxFormObject.setEventHandlers();
   new PicLoader({
     "uploadSelector" : ".fileUpload",
     "showPicElementSelector" : "#avatarPics",
     "picWidth" : "120",
     "imageTooBig" : imageTooBig,
     "wrongFormat" : wrongFormat,
     "maxFileSize" : maxFileSize,
     "debug" : "warn"
   });
 });

 
  
  
});