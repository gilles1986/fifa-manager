{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}
<h2>{#create_tourn#}</h2>
<form action="index.php" class="ajaxForm" method="GET">
  <label for="tournName">{#tourn_name#}</label>
  <input type="text" name="tournName" id="tournName" />
  <input type="hidden" name="action" value="doCreateTourn" />
  <input type="submit" value="OK" />
  
</form>