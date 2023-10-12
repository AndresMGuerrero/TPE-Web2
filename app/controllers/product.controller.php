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
        $products = $this->modelProd->getProducts();
        $marcas = $this->modelMarca->getMarcas();
        $this->viewProd->listProductsMarcasPublic($products, $marcas);
    }

    public function showDetalles($id){
        $product = $this->modelProd->getProduct($id);
        $this->viewProd->showDetalles($product);
    }

    public function searchProducts($id_marca){
        $products = $this->modelProd->searchProducts($id_marca);
        $this->viewProd->listProductsByMarca($products);
    }

    public function showProductsAdmin(){
        AuthHelper::init();
        $products = $this->modelProd->getProducts();
        $marcas = $this->modelMarca->getMarcas();
        $this->viewProd->listProductsAdmin($products, $marcas);
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
        AuthHelper::init();      
        $product = $this->modelProd->getProductsandMarcas($id);        
        $this->viewProd->showProductsandMarcas($product);
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
            
            $marcas = $this->modelMarca->getMarcas();
            $indicador = 0;
            foreach($marcas as $marcaExistente){
                if($marcaExistente->nombre_marca == $marca){
                    $indicador = 1;
                }
            }
            if($indicador==0){
                $this->modelMarca->insertMarca($marca, "null", "null");
            }
            $this->modelProd->updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $marca);
            header('Location: ' . BASE_URL . 'listarProdAdmin');
        }            
    }
}