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

        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);


        if(empty($userName)||empty($password)){
            $this->view->showFormLogin('Completar los datos faltantes.');
            return;
        }

        $user = $this->model->getUserByName($userName);
        //var_dump ($user);
        //die();
        if($user && password_verify($password, $hash /*$user->password*/)){
            
        //     if (session_status() != PHP_SESSION_ACTIVE) {
        //         session_start();
        //         echo "Sesion iniciada";
                
        //     }
        //     if (session_status() == PHP_SESSION_ACTIVE){
        //         echo "sesion activada";
        //     }
        //     die();

            AuthHelper::login($user); //No funciona
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