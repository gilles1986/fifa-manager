{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}

<form class="ajaxForm ajaxContent" action="?" method="GET">
 <select size="{$freeUsers|@count}" name="user">
  {foreach from=$freeUsers item=user}
    <option value="{$user->getId()}">{$user->getNickname()}</option>
  {/foreach}
 </select>
  <input type="hidden" name="tourn" value="{$tournId}" />
  <input type="hidden" name="action" value="doAddPlayer" />
 <input type="submit" value="{#add_player#}" />
 
</form>

<form class="ajaxForm ajaxContent" action="?" method="GET">
 <select size="{$takenUsers|@count}" name="user">
   {foreach from=$takenUsers item=user}
   	<option value="{$user->getId()}">{$user->getNickname()}</option>
   {/foreach}
 </select>
 <input type="hidden" name="tourn" value="{$tournId}" />
 <input type="hidden" name="action" value="doDeletePlayer" />
 <input type="submit" value="{#delete_player#}" />
 
</form>
{if $message != ""}
<p id="message">{#$message#}</p>
{/if}
<a class="dynLink ajaxContent" href="?action=showtournament&id={$tournId}">{#backlink#}</a>