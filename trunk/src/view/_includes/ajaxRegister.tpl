{assign var="lang" value="Home/home_{$lang}.conf"}
{if $site->exists($lang)}
  {config_load section="register" file={eval var=$lang}} 
{else}
  {config_load section="register" file="Home/home_en.conf"} 
{/if}
<h2>{#register#}</h2>
<form id="registerForm" method="post" action="?action=doRegister" enctype="multipart/form-data">
 <label for="name">{#username#}:</label>
 <input type="text" name="name" id="name"/>
 <label for="nickname">{#nickname#}:</label>
 <span>({#nickname_descr#})</span>
 <input type="text" name="nickname" id="nickname"/>
 <label for="password">{#password#}:</label>
 <input type="password" name="password" id="password"/>
 <div id="avatarLoader">
  <label for="avatar">{#avatar#}<br/> ({#avatar_descr#}):</label>
  <input type="file" name="file" id="file" class="fileUpload"/>
 </div>
 <div id="avatarPics"></div>
 <input type="submit" value="OK" />
</form>