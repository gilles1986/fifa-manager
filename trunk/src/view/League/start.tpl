<div>
   <p>League Manager</p>
   <ul>
   {foreach from=$games item=game}
     <li>{$game->getPlayer1()->getName()} vs. {$game->getPlayer2()->getName()}</li> 
   {/foreach}
   </ul>
   
</div>
