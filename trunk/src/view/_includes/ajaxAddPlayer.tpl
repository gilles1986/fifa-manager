<form action="?action=doAddPlayer">
 <select name="player">
  {foreach from=$users item=user}
    <option value="{$user->getId()}">{$user->getNickname()}</option>
  {/foreach}
 </select>
</form>