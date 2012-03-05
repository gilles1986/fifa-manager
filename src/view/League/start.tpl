{assign var="lang" value="Home/home_{$smarty.cookies.lang}.conf"}
{if $site->exists($lang)}
  {config_load section="main" file={eval var=$lang}} 
{else}
  {config_load section="main" file="Home/home_en.conf"} 
{/if}
{include file="_includes/head.tpl"}
<body>
  <div id="content">
    <h1>{#tournament#}</h1>
    {include file="_includes/leftNavigation.tpl"}
    {include file="_includes/manager.tpl"}
    <div id="leagueManager">
      <p>League Manager</p>
    </div>
  </div>
  
</body>
</html>