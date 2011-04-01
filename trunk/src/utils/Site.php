<?php

class Site {
  public function exists($conf) {
    if(file_exists(SRC."_smartyConfig/".$conf)) {
      return true;
    } else {
      return false;
    }
  }
}

?>