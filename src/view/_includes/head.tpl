<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta name="Content-Type"
  content="text/html; charset=utf-8" />
    <title>{$title}</title>
    {foreach from=$scripts item=script}
      {include file="_includes/script_$script.tpl"}
    {/foreach}
    <link rel="stylesheet" href="includes/css/home.css" />
    
  </head>  
