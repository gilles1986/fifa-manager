{assign var="lang" value="Error/error404_{$smarty.cookies.lang}.conf"}
{if $site->exists($lang)}
  {config_load file={eval var=$lang}} 
{else}
  {config_load  file="Error/error404_en.conf"} 
{/if}
<div id="manager">
  {if $smarty.session.loggedIn == true}
    {include file="_includes/tournMenu.tpl"}
    <div id="ajaxContent">
    {foreach from=$tournament item=tourn}
        <a class="dynLink ajaxContent" href="?action=showtournament&id={$tourn->getId()}">{$tourn->getName()}</a><br/>       
    {/foreach}
    </div>                    
  {else}
    <p>Home</p>
    {if $error}
      <p>{#$error#}</p>
    {/if}        
  {/if}
  {if $smarty.session.loggedIn == true}

  {/if}
</div>