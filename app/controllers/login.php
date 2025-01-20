<?php

class Login extends Controller {

  public function index() {
    $this->view('login/index');
  }

  public function verify() {
    session_start(); // Ensure session is started

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $user = $this->model('User');
    $authenticated = $user->authenticate($username, $password);

    if ($authenticated) {
      // Clear login error and redirect to a secure page
      unset($_SESSION['loginError']);
      header("Location: /home"); // Replace '/home' with your post-login page
      exit();
    } else {
      // Set the login error message
      $_SESSION['loginError'] = "Invalid username or password.";
      header("Location: /login");
      exit();
    }
  }

}
?>
