<?php 

class DoLoginController extends Controller {
  
  public function init() {
    include_once SRC."model/User.php";
    include_once SRC."dao/UserDao.php";
  }
  
  public function login() {
    
    // Check if Login was successfull
    try {
      Logger::debug("DoLoginController::login()","User");
      $user = new User();
      $user->setUsername($_REQUEST['loginName']);
      $user->setPassword($_REQUEST['loginPassword']);
      Logger::debug("call login","User");
      if($user->login()) {
        Logger::debug("Login successfull. Serialize Data of User", "User");
        $_SESSION['user'] = serialize($user);
        $_SESSION['loggedIn'] = true;
      }

      
    } catch(Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    } 
    $this->redirect("index.php");
  }
  
  public function logout() {
    session_destroy();
    $this->redirect("index.php");
  }
  
  public function register() {
    $this->show();
  }
  
  public function doRegister() {
    Logger::debug("DoLoginController::doRegister", "DoLoginController");
    
    if($_REQUEST['name'] && $_REQUEST['nickname'] && $_REQUEST['password']) {
      
      try {
        $user = new User();
        $user->setUsername($_REQUEST['name']);
        $user->setNickname($_REQUEST['nickname']);
        if($user->exist()) throw new LogWarning("user_exists");
        
        $user->setPassword($_REQUEST['password']);
        $user->setAvatar($_FILES['file']);
        Logger::debug("Call register function", "DoLoginController");
        $user->register();
        
      } catch(Exception $e) {
        Logger::debug("OHOH! Exception: ".$e->getMessage(), "DoLoginController");
        $_SESSION['error'] = $e->getMessage();
      }
      
      
        
    } else {
      Logger::debug("OHOH! Daten nicht vollständig", "DoLoginController");
      $_SESSION['error'] = "user_regged_formfill";
    }
    
    
    $this->redirect("index.php");
  }
  
  
  
}

?>