<?php

require_once './app/models/product.model.php';
require_once './app/views/product.view.php';
require_once './app/views/error.view.php';
require_once './app/models/marcas.model.php';

class ProductController{

    private $modelProd;
    private $modelMarca;
    private $view;
    private $errorView;

    public function __construct(){

        $this->modelProd = new ProductModel();
        $this->modelMarca = new MarcasModel();
        $this->view = new ProductView();
        $this->errorView = new ErrorView();
    }

    public function showProducts(){

        $products = $this->modelProd->getProducts();
        $marcas = $this->modelMarca->getMarcas();
        $this->view->listProductsMarcasPublic($products, $marcas);
    }

    public function showDetalles($id){
        $product = $this->modelProd->getProduct($id);
        $this->view->showDetalles($product);
    }

    public function searchProducts($id_marca){
        $products = $this->modelProd->searchProducts($id_marca);
        $this->view->listProductsPublic($products);
    }

    public function showProductsAdmin(){

        $products = $this->modelProd->getProducts();
        $marcas = $this->modelMarca->getMarcas();
        $this->view->listProductsAdmin($products, $marcas);
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

        $id = $this->modelProd->insertProduct($nombre, $color, $talle, $tipo, $precio, $marca);

        if($id){
            header('Location: ' . BASE_URL . 'listarProdAdmin');
        } else {
            $this->errorView->showError("Error al insertar producto");
        }        

    }

    public function removeProduct($id){
        $this->modelProd-> deleteProduct($id);
        header('Location: ' . BASE_URL . 'listarProdAdmin');
    }

    public function showFormUpdateProduct($id){
        
        $product = $this->modelProd->getProduct($id);
        require_once './templates/formUpdateProd.phtml';
        
    }
    
    public function updateProduct($id){
        
        if(!empty($_POST['nombre'])&&!empty($_POST['color'])&&!empty($_POST['talle'])&&!empty($_POST['tipo'])&&!empty($_POST['precio'])&&!empty($_POST['marca'])){

            $nombre = $_POST['nombre'];
            $color = $_POST['color'];
            $talle = $_POST['talle'];
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $marca = $_POST['marca'];
            
    
            $this->modelProd->updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $marca);
            header('Location: ' . BASE_URL . 'listarProdAdmin');
        }            
    }
}