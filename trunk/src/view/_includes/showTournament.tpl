{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}

{* Zählen ob alle Spieler auch Mannschaften haben. Falls nicht darf das Turnier nicht gestartet werden *}
{assign var="numberTeams" value="0"}

<table class="tournTable">
  <tr>
    <th>Icon</th>
    <th>Name</th>
    <th>Team</th>
    <th>Wins</th>
    <th>Ties</th>
    <th>Loss</th>
    <th class="lastRight">Points</th>        
  </tr>
  {foreach from=$players item=player name=loop}
  
  {if $player->getTeamObj()->getName() != ""}
    {assign var="numberTeams" value="{$numberTeams+1}"}
  {/if}
  
  {if $smarty.foreach.loop.last == TRUE} 
  <tr class="lastDown">
  {else}
  <tr>
  {/if} 
    <td><img width="32" src="upload/imgs/{$player->getUser()->getAvatar()}" /> </td> 
    <td>{$player->getUser()->getNickname()}</td>
    {if $player->getTeamObj()->getName() != ""}
    <td>{$player->getTeamObj()->getName()}</td>
    {else}
      {if $tournament->getAutorId() == $user->getId()}
         <td><form class="ajaxForm ajaxContent teamTable" action="?" method="GET" >
          <select name="teamname">
            {foreach from=$teams item=team}
            <option value="{$team->getId()}">{$team->getName()}</option>
            {/foreach}
          </select>
          <input type="hidden" name="action" value="chooseTeam" />
          <input type="hidden" name="tournId" value="{$tournament->getId()}" />
          <input type="hidden" name="playerId" value="{$player->getPlayerid()}" />
          <input type="submit" value="OK" />   
        </form>
        </td>
      {else}
      {/if}
    {/if}
    <td>{$player->getWins()}</td>
    <td>{$player->getTies()}</td>
    <td>{$player->getLoss()}</td>
    <td class="points lastRight">{$player->getPoints()}</td>
  </tr>
  {/foreach}
</table>



{if $teamField == true}
<form class="ajaxForm ajaxContent teamTable" action="?" method="GET" >
  <label for="teamname">{#team_choose#}:</label>
  <select id="teamname" name="teamname">
    {foreach from=$teams item=team}
    <option value="{$team->getId()}">{$team->getName()}</option>
    {/foreach}
  </select>
  <input type="hidden" name="action" value="chooseTeam" />
  <input type="hidden" name="tournId" value="{$tournament->getId()}" />
  <input type="hidden" name="playerId" value="{$userid}" />
  <input type="submit" value="OK" />   
</form>
{/if}

{if $message != ""}
<p>{$message}</p>
{/if}
  

<ul style="margin-top: 3em;">
<li><a class="dynLink ajaxContent" href="?action=addGame&id={$tournament->getId()}">{#add_game#}</a></li>
<li><a class="dynLink ajaxContent" href="?action=addPlayer&id={$tournament->getId()}">{#add_player#}</a></li>
{if $tournament->getStatus() == "open"}
  {if $players|@count > 1 && $numberTeams == $players|@count}
  <li><a class="dynLink ajaxContent" href="?action=startTourn&id={$tournament->getId()}">{#start_tourn#}</a></li>
  {/if}
{else}
<li><a class="dynLink ajaxContent" href="?action=stopTourn&id={$tournament->getId()}">{#stop_tourn#}</a></li>
{/if}
</ul>