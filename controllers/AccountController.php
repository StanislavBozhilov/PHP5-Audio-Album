<?php

class AccountController extends BaseController{
    private $db;

    public function onInit(){
        $this->db= new AccountsModel();
    }

    public function register(){

        if($this->isPost){
            $username = $_POST['username'];
            if($username == null || strlen($username)<3){
                $this->addErrorMessage("Username is invalid !");
                $this->redirect("account","register");
            }
            $password = $_POST['password'];
            $isRegistered = $this->db->register($username,$password);
            if($isRegistered){
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successful registration !");
               $this->redirectToUrl("/home");
            }
            else{
                $this->addErrorMessage("Register failed!");
            }
        }
        $this->renderView(__FUNCTION__);

    }
    public function login(){

        if($this->isPost){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $isLoggedIn = $this->db->login($username,$password);
            //var_dump($isLoggedIn);

            if($isLoggedIn){
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successful login !");
                $this->redirectToUrl("/songs");
            }
            else{
                $this->addErrorMessage("Login error");
                $this->redirect("account","login");
            }
        }
        $this->renderView(__FUNCTION__);

    }
    public function logout(){

        unset($_SESSION['username']);
        $this->addInfoMessage("Bye bye ");
        $this->redirectToUrl("/");

    }
}