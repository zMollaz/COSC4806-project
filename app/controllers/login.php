<?php

class login extends Controller {

  public function index() {
    $this->view('login/index');
  }

  public function verify() {
    $username = $REQUEST['username'];
    $password = $REQUEST['password'];

    $user = this->model('User');
    $user->authenticate($username, $password);
  }
  
}
?>