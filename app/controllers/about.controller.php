<?php
//require_once './app/view/about.view.php';
require_once './app/views/about.view.php';

class AboutController {

private $view;

public function __construct(){
    $this->view = new AboutView();
}

public function showAbout(){
    $this->view->DescricionAbout();
}

}

?>