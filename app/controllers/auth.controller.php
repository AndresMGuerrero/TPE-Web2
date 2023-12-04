<?php

require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin(){
        $this->view->showFormLogin();
    }

    public function auth(){        
                  
        if(empty($_POST['userName'])||empty($_POST['password'])){
            $this->view->showFormLogin('Completar los datos faltantes.');                
            return;
        }
        
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        

        $user = $this->model->getUserByName($userName);
                
        if($user && password_verify($password, $user->password)){
            
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . 'listarProdAdmin');
        } else {
            $this->view->showFormLogin('Usuario inválido');
        }           
          
    }

    public function logout(){

        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}