<?php

/**
 * Class which is used to check if a language exists for one site
 * @author Gilles
 *
 */
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