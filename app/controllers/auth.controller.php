<?php

require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController{

    private $model;
    private $view;

    public function __construct(){
        $this->model-> new UserModel();
        $this->view-> new AuthView();
    }

    public function showLogin(){
        $this->view->showFormLogin();
    }

    public function auth(){

        $userName = $_POST['userName'];
        $password = $_POST['password'];

        if(empty($userName)||empty($password)){
            $this->view->showFormLogin('Completar los datos faltantes.');
            return;
        }

        $user = $this->model->getUserByName($userName);
        if($user && password_verify($password, $user->password)){

            AuthHelper::login($user);
            //header('Location: ' . BASE_URL);
        } else {
            $this->view->showFormLogin('Usuario inválido');
        }
    }

    public function logout(){

        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}