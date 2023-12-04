<?php

require_once './app/models/product.model.php';
require_once './app/views/product.view.php';
require_once './app/views/error.view.php';
require_once './app/models/marcas.model.php';
require_once './app/helpers/auth.helper.php';


class ProductController{

    private $modelProd;
    private $modelMarca;
    private $viewProd;
    private $errorView;
    private $authHelper;

    public function __construct(){
        $this->authHelper= new AuthHelper();
        $this->modelProd = new ProductModel();
        $this->modelMarca = new MarcasModel();
        $this->viewProd = new ProductView();
        $this->errorView = new ErrorView();
       
    }

    public function showProducts(){
        AuthHelper::init();       
        $products = $this->modelProd->getProductsCompleto(); //porque necesitamos la marca de cada productos para mostrarlo en las tarjetas
        $marcas = $this->modelMarca->getMarcas(); //Para listar marcas
        $this->viewProd->listProductsMarcasPublic($products, $marcas);
    }

    public function showDetalles($id){
        $product = $this->modelProd->getProduct($id);
        $this->viewProd->showDetalles($product);
    }

    public function searchProducts($id_marca){
        $products = $this->modelProd->searchProducts($id_marca);
        $marca = $this->modelMarca->getMarca($id_marca);
        if($products != null){
            $this->viewProd->listProductsByMarca($products, $marca);
        } else {
            $this->errorView->showError("No poseemos productos de esta marca.");
        }        
    }

    public function showProductsAdmin(){
        AuthHelper::init();
        $products = $this->modelProd->getProductsCompleto();
        $marcas = $this->modelMarca->getMarcas();
        $this->viewProd->listProductsAdmin($products, $marcas);
    }
    

    public function addProduct(){
        if(!empty($_POST['nombre'])&&!empty($_POST['color'])&&!empty($_POST['talle'])&&!empty($_POST['tipo'])&&!empty($_POST['precio'])&&!empty($_POST['marca'])){

            $nombre = $_POST['nombre'];
            $color = $_POST['color'];
            $talle = $_POST['talle'];
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $urlImgProd = $_POST['imagen'];
            $marca = $_POST['marca'];

            $id = $this->modelProd->insertProduct($nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca);

            if($id){
                header('Location: ' . BASE_URL . 'listarProdAdmin');
            } else {
                $this->errorView->showError("Error al insertar producto");
            } 
        } else {
            $this->errorView->showError("Complete todos los campos.");
            return;
        } 

    }

    public function removeProduct($id){
        $this->modelProd-> deleteProduct($id);
        header('Location: ' . BASE_URL . 'listarProdAdmin');
    }

    public function showFormUpdateProduct($id){  
        AuthHelper::init();      
        $product = $this->modelProd->getProductsandMarcas($id);
        $marcas = $this->modelMarca->getMarcas();        
        $this->viewProd->showProductsandMarcas($product, $marcas);
        require_once './templates/formUpdateProd.phtml';
        
    }
    
    public function updateProduct($id){
        
        if(!empty($_POST['nombre'])&&!empty($_POST['color'])&&!empty($_POST['talle'])&&!empty($_POST['tipo'])&&!empty($_POST['precio'])&&!empty($_POST['imagen'])&&!empty($_POST['marca'])){

            $nombre = $_POST['nombre'];
            $color = $_POST['color'];
            $talle = $_POST['talle'];
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $urlImgProd = $_POST['imagen'];
            $marca = $_POST['marca'];
            
            
            $this->modelProd->updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca);
            header('Location: ' . BASE_URL . 'listarProdAdmin');
            
        } else {
            $this->errorView->showError("Complete todos los campos.");
            return;
        }            
    }
}