<script type="text/javascript" src="includes/js/Siteloader.js"></script>
<script type="text/javascript" src="includes/js/AjaxFormHandler.js"></script>
<script type="text/javascript" src="includes/js/PicLoader.js"></script>
{if $site->exists($lang)}
  {config_load section="script" file={eval var=$lang}} 
{else}
  {config_load section="script" file="Home/home_en.conf"} 
{/if}

<script type="text/javascript">
var imageTooBig = "{#image_too_big#}";
var wrongFormat = "{#wrong_format#}";
var maxFileSize = "{#max_file_size#}";
</script>

<script type="text/javascript" src="includes/js/System_homescript.js"></script>