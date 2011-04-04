$(document).ready(function() {
 var loadElements = {
     "default" : "#content",
     "manager" : "#manager",
     "ajaxContent" : "#ajaxContent",
     "message" : "#message"
 };
  
  var siteLoaderObject =  new SiteLoader({
    "linkSelector" : ".dynLink",
    "loadElements" : loadElements,
    "debug" : "debug"
  });
  
  loadElements['default'] = "#ajaxContent";
  var ajaxFormObject = new AjaxFormHandler({
    "linkSelector" : ".ajaxForm",
    "contentArea" : $("#ajaxContent"),
    "loadElements" : loadElements,
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