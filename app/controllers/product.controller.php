<?php

require_once './app/models/product.model.php';
require_once './app/views/product.view.php';
require_once './app/views/error.view.php';

class ProductController{

    private $model;
    private $view;
    private $erroView;

    public function __construct(){

        $this->model = new ProductModel();
        $this->view = new ProductView();
        $this->errorView = new ErrorView();
    }

    public function showProducts(){

        $products = $this->model->getProducts();
        $this->view->listProducts($products);
    }

    public function showDetalles($id){
        $product = $this->model->getProduct($id);
        $this->view->showDetalles($product);
    }

    public function searchProducts($id_marca){
        $products = $this->model->searchProducts($id_marca);
        $this->view->listProducts();
    }

    public function addProduct(){

        $nombre = $_POST['nombre'];
        $color = $_POST['color'];
        $talle = $_POST['talle'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        $marca = $_POST['marca'];

        if(empty($nombre)||empty($color)||empty($talle)||empty($tipo)||empty($precio)||empty($marca)){
            $this->errorView->showError("Complete todos los campos.");
            return;
        }

        $id = $this->model->insertProduct($nombre, $color, $talle, $tipo, $precio, $marca);

        if($id){
            header('Location: ' . BASE_URL);
        } else {
            $this->errorView->showError("Error al insertar producto");
        }        

    }

    public function removeProduct($id){
        $this->model-> deleteProduct($id);
        header('Location: ' . BASE_URL);
    }

    public function updateProduct($id){
        
        if(!empty($nombre)&&!empty($color)&&!empty($talle)&&!empty($tipo)&&!empty($precio)&&!empty($marca)){

            $nombre = $_POST['nombre'];
            $color = $_POST['color'];
            $talle = $_POST['talle'];
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $marca = $_POST['marca'];
            
    
            $this->model->updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $marca);
            header('Location: ' . BASE_URL);
        }            
    }
}