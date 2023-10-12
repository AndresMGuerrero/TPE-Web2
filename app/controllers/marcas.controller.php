<?php

require_once './app/models/marcas.model.php';
require_once './app/views/marcas.view.php';
require_once './app/views/error.view.php';
require_once './app/helpers/auth.helper.php';

class MarcasController{

    private $modelMarca;
    private $modelProd;
    private $view;
    private $errorView;

    public function __construct(){
        $this->modelMarca = new MarcasModel();
        $this->modelProd = new ProductModel();
        $this->view = new MarcasView();
        $this->errorView = new ErrorView();
    }

    public function showMarcas(){
        AuthHelper::init();
        $marcas = $this->modelMarca->getMarcas();
        $this->view->listaMarcas($marcas);

    }

    public function addMarca(){

        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $localizacion = $_POST['localizacion'];

        if(empty($nombre)||empty($anio)||empty($localizacion)){
            $this->errorView->showError("Complete todos los campos.");
            return;
        }

        $id = $this->modelMarca->insertMarca($nombre, $anio, $localizacion);//Funciona esto? la tabla marcas tiene id, pero cuenta como id?

        if($id){
            header('Location: ' . BASE_URL . 'listarMarcas');
        } else {
            $this->errorView->showError("Error al insertar marca"); //está bien hacer un error.view.php? 
        }        

    }

    public function removeMarca($id){
        $products = $this->modelProd->getProducts();
        $indicador = 0;

        foreach($products as $ProdExistente){
            if($ProdExistente->id_marca_fk == $id){
                $indicador = 1;
            }
        }

        if($indicador==1){
            $this->errorView->showError("No puede eliminar una marca que exista en la tabla productos.");
        } else {
            $this->modelMarca-> deleteMarca($id);
            header('Location: ' . BASE_URL . 'listarMarcas');
        }
        
    }

    public function showFormUpdateMarca($id){

        AuthHelper::init();
        
        
        $marca = $this->modelMarca->getMarca($id);
        require_once './templates/formUpdateMarca.phtml';
        
    }
    
    public function updateMarca($id){

        
        if(!empty($_POST['anio'])&&!empty($_POST['localizacion'])){

            $anio = $_POST['anio'];
            $localizacion = $_POST['localizacion'];
            
    
            $this->modelMarca->updateMarca($id, $anio, $localizacion);
            header('Location: ' . BASE_URL . 'listarMarcas');
        }            
    }
}