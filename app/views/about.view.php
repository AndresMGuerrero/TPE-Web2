<?php

require_once './app/helpers/auth.helper.php';

class AboutView{
    public function DescripcionAbout(){
        AuthHelper::init();
        require 'templates/about.phtml';
    }
}

?>