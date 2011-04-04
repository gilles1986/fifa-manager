{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}
<table class="tournTable">
  <tr>
    <th>Name</th>
    <th>Team</th>
    <th>Wins</th>
    <th>Ties</th>
    <th>Loss</th>
    <th class="lastRight">Points</th>        
  </tr>
  {foreach from=$players item=player name=loop}
  {if $smarty.foreach.loop.last == TRUE} 
  <tr class="lastDown">
  {else}
  <tr>
  {/if}  
    <td>{$player->getUser()->getNickname()}</td>
    <td>{$player->getTeam()}</td>
    <td>{$player->getWins()}</td>
    <td>{$player->getTies()}</td>
    <td>{$player->getLoss()}</td>
    <td class="points lastRight">{$player->getPoints()}</td>
  </tr>
  {/foreach}
</table>

{if $teamField == true}
<form action="?chooseTeam" method="GET" class="ajaxForm teamTable">
  <label for="teamname">{#team_choose#}:</label>
  <select id="teamname" name="teamname">
    {foreach from=$teams item=team}
    <option value="{$team->getId()}">{$team->getName()}</option>
    {/foreach}
  </select>    
</form>
{/if}
  

<ul style="margin-top: 3em;">
<li><a class="dynLink ajaxContent" href="?action=addGame&id={$smarty.request.id}">{#add_game#}</a></li>
<li><a class="dynLink ajaxContent" href="?action=addPlayer&id={$smarty.request.id}">{#add_player#}</a></li>
<li><a class="dynLink ajaxContent" href="?action=startTourn&id={$smarty.request.id}">{#start_tourn#}</a></li>
</ul>