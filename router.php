<?php

require_once './app/controllers/product.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/marcas.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//TABLA DE RUTEO

//listarProdPublico -->     productController--> showProducts();
//detalle/:ID->             productController--> showDetalles(id);
//listarMarcas -->          marcaController--> showMarcas();
//buscarPorMarca/:ID-->     productController--> searchProducts(id);
//listarProdAdmin -->       productController--> showProductsAdmin();
//agregarProd -->           productController--> addProduct();
//eliminarProd/:ID -->      productController--> removeProduct(id);
//updateProduct/:ID -->     productController--> updateProduct(id);
//agregarMarca -->          marcaController--> addMarca();
//eliminarMarca/:ID -->     marcaController--> removeMarca(id);
//modificarMarca -->        marcaController--> updateMarca(id);
//login -->                 authController--> showLogin();
//auth -->                  authController--> auth();
//logout -->                authController--> logout();


$action = 'listarProd';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'listarProd':
        $controller = new ProductController();
        $controller->showProducts();
        break;
    case 'detalles':
        $controller = new ProductController();
        $controller->showDetalles();
        break;
    case 'listarMarcas':
        $controller = new MarcasController();
        $controller->showMarcas();
        break;
    case 'listarProdAdmin':
        $controller = new ProductController();
        $controller->showProductsAdmin();
        break;
    case 'agregarProd':
        $controller = new ProductController();
        $controller->addProduct();
        break;
    case 'eliminarProd':
        $controller = new ProductController();
        $controller->removeProduct($params[1]);
        break;
    case 'showFormModifProd':
        $controller = new ProductController();
        $controller->showFormUpdateProduct($params[1]);
        break;
    case 'modificarProd':
        $controller = new ProductController();
        $controller->updateProduct($params[1]);
        break;
    case 'agregarMarca':
        $controller = new MarcasController();
        $controller->addMarca();
        break;
    case 'eliminarMarca':
        $controller = new MarcasController();
        $controller->removeMarca($params[1]);
        break;
    case 'showFormModifMarca':
        $controller = new MarcasController();
        $controller->showFormUpdateMarca($params[1]);
        break;
    case 'modificarMarca':
        $controller = new MarcasController();
        $controller->updateMarca($params[1]);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}
