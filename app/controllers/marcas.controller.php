<?php

require_once './app/models/marcas.model.php';
require_once './app/views/marcas.view.php';
require_once './app/views/error.view.php';

class MarcasController{

    private $model;
    private $view;
    private $errorView;

    public function __construct(){
        $this->model = new MarcasModel();
        $this->view = new MarcasView();
        $this->errorView = new ErrorView();
    }

    public function showMarcas(){

        $marcas = $this->model->getMarcas();
        $this->view->listMarcas();

    }

    public function addMarca(){

        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $localizacion = $_POST['localizacion'];

        if(empty($nombre)||empty($anio)||empty($localizacion)){
            $this->errorView->showError("Complete todos los campos.");
            return;
        }

        $id = $this->model->insertMarca($nombre, $anio, $localizacion);//Funciona esto? la tabla marcas tiene id, pero cuenta como id?

        if($id){
            header('Location: ' . BASE_URL);
        } else {
            $this->errorView->showError("Error al insertar marca"); //está bien hacer un error.view.php? 
        }        

    }

    public function removeMarca($id){
        $this->model-> deleteProduct($id);
        header('Location: ' . BASE_URL);
    }

    public function updateMarca($id){
        
        if(!empty($anio)&&!empty($localizacion)){

            $anio = $_POST['anio'];
            $localizacion = $_POST['localizacion'];
            
    
            $this->model->updateMarca($id, $anio, $localizacion);
            header('Location: ' . BASE_URL);
        }            
    }
}