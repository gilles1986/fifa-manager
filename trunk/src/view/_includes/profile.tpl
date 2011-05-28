{assign var="langue" value="Home/home_{$lang}.conf"}
{if $site->exists($langue)}
  {config_load section="profile" file={eval var=$langue}} 
{else}
  {config_load section="profile" file="Home/home_en.conf"} 
{/if}
<style>.hideMe { display: none;}</style>
<h2>{#userprofile#}</h2>
{if $error == ""}




  
  <p id="_displayName">Name: {$profile->getUsername()}</p>
  <p><img src="upload/imgs/{$profile->getAvatar()}" width="120"/></p>

 {if $user->getId() == $profile->getId()}
  <p>Password: <input type="password" /></p>
 {/if}
{else}
  {assign var="langue" value="Error/error404_{$lang}.conf"}
  {if $site->exists($langue)}
    
    {config_load file={eval var=$langue}} 
  {else}
    {config_load  file="Error/error404_en.conf"} 
  {/if}
  <p>{#user_not_exist#}</p>
{/if}




