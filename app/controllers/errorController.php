<?php

class ErrorController{

    private $view;


    public function __construct(){
        $this->view = new ErrorView();
    }

    public function showError(){
        $this->view->showError("404 Page Not Found");
    }
}