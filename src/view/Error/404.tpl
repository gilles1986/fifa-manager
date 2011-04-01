{assign var="lang" value="Error/error404_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load  file={eval var=$lang}} 
{else}
  {config_load  file="Error/error404_en.conf"} 
{/if}
{include file="_includes/head.tpl"}
<body>
  <div id="content">
    <h1>{#action_not_exist#}</h1>
    
  </div>
  
</body>
</html>