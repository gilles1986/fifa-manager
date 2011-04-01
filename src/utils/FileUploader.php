<?php

class FileUploader {
  
  private $file;
  private $usernick;
  
  public function __construct($file, $nick) {
    $this->file = $file;
    $this->usernick = $nick;
  }
  
  public function upload() {
    $file = "";
    if($this->file['tmp_name'] != "") {
      Logger::debug("Ist der Avatar größer als ".(MAXFILESIZE * 1000), "User");
        if($this->file['size'] < (MAXFILESIZE * 1000)) {
          Logger::debug("Dateiendung herausfinden von ".$this->file['name'], "User");
          $strLen = strlen($this->file['name']);
          $backPos = strpos(strrev($this->file['name']),".");
          $fileend = substr($this->file['name'],($strLen-$backPos), $strLen);
          Logger::debug("User::register: Neuer Filename von ".$this->file['name']." ist ".$this->usernick.".".$fileend, "User");
          move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD.$this->usernick.".".$fileend);
          $file = $this->usernick.".".$fileend;
        } else {
          $_SESSION['error'] = "file_too_big";
          throw new Exception("Datei zu groß: ".$this->file['size']);
        }
        return $file;
        
    } else {
      throw new Exception("Datei wurde nicht hochgeladen: ".$this->file['tmp_name']);
    }
    
    
  }
  
}

?>