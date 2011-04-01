{if $site->exists($lang)}
  {config_load section="tournament" file={eval var=$lang}} 
{else}
  {config_load section="tournament" file="Home/home_en.conf"} 
{/if}
<table>
  <tr>
    <th>Name</th>
    <th>Player1</th>
    <th>Player2</th>
    <th>Goals Player1</th>
    <th>Goals Player2</th>    
  </tr>
  <tr>
    
  </tr>
</table>
<a class="dynLink ajaxContent" href="?action=addGame">{#add_game#}</a>
<a class="dynLink ajaxContent" href="?action=addPlayer">{#add_player#}</a>