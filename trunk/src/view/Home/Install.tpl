{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="install" file={eval var=$lang}} 
{else}
  {config_load section="install" file="Home/home_en.conf"} 
{/if}
{include file="_includes/head.tpl"}
<body>
  <div id="content">
    <h1>{#headline#}</h1>
    <a href="index.php">{#backlink#}</a>
  </div>
  
</body>
</html>