<?php

class ErrorView{
    public function showError($error){
        AuthHelper::init();
        require 'templates/error.phtml';
    }
}