<?php

class IniWriter {
  
  public static function writeArray($array, $file) {
    $string = "";
    foreach($array as $field => $value) {
      $string .= $field." = \"".$value."\"\r\n";
    }
    try {
      file_put_contents($file, $string);
    } catch(Exception $e) {
      Logger::warn($e->getMessage, "IniWriter");
    }
  }
}

?>