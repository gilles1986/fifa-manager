{assign var="lang" value="Home/home_{$smarty.cookies.lang}.conf"}
{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}
<ul id="tournamentMenu">
  <li><a class="dynLink ajaxContent" href="?action=manager">Home</a></li>
  <li><a class="dynLink ajaxContent" href="?action=createTourn">{#create_tourn#}</a></li>
  <li><a class="dynLink ajaxContent" href="?action=searchTourn">{#search_tourn#}</a></li>
</ul>
  
