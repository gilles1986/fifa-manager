{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="main" file={eval var=$lang}} 
{else}
  {config_load section="main" file="Home/home_en.conf"} 
{/if}
  {if $smarty.session.loggedIn == true}
    
    {foreach from=$tournament item=tourn}
        <a class="dynLink ajaxContent" href="?action=showtournament&id={$tourn->getId()}">{$tourn->getName()}</a><br/>       
    {/foreach}
  {/if}
