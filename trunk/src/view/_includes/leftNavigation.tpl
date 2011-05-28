{if $site->exists($lang)}
  {config_load section="navigation" file={eval var=$lang}} 
{else}
  {config_load section="navigation" file="Home/home_en.conf"} 
{/if}
<div id="leftNavigation">
  {if $smarty.session.loggedIn == ""}
    <div id="loginForm">
      <form action="?action=login" method="post">
        <label for="loginName">{#username#}:</label>
        <input type="text" name="loginName" id="loginName" />
        <label for="loginPassword">{#password#}:</label>
        <input type="password" name="loginPassword" id="loginPassword" />
        <input type="submit" value="OK" />
      </form>
      <a href="?action=register" class="dynLink manager">{#register#}</a>
    </div>
    
  {else}
    <div id="userBox">
      <p>{#logged_in#} {$user->getUsername()}</p>
      <a class="dynLink manager" href="?action=userProfile&id={$user->getId()}"><img src="upload/imgs/{$user->getAvatar()}" width="120" /></a>
    </div>  
    <a href="?action=logout">Logout</a> <a class="dynLink manager" href="?action=userProfile&id={$user->getId()}">{#userprofile#}</a>
  {/if}
  <div id="chooseLanguage">
    <a href="?action=chooseLanguage&language=de"><img width="32" src="imgs/germany.png" alt="German" /></a>
    <a href="?action=chooseLanguage&language=en"><img width="32" src="imgs/english.png" alt="English" /></a>
    <a href="?action=chooseLanguage&language=pl"><img width="32" src="imgs/poland.png" alt="Polish" /></a>
  </div>
  
</div>