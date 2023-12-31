<?php

require_once './app/controllers/product.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/marcas.controller.php';
require_once './app/controllers/about.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//TABLA DE RUTEO

//listarProd -->            productController--> showProducts();
//detalles/:ID->            productController--> showDetalles(id);
//listarMarcas -->          marcasController--> showMarcas();
//busquedaPorMarca/:ID-->   productController--> searchProducts(id);
//listarProdAdmin -->       productController--> showProductsAdmin();
//agregarProd -->           productController--> addProduct();
//eliminarProd/:ID -->      productController--> removeProduct(id);
//showFormModifProd/:ID --> productController-->showFormUpdateProduct(id);
//modificarProd/:ID -->     productController--> updateProduct(id);
//agregarMarca -->          marcasController--> addMarca();
//eliminarMarca/:ID -->     marcasController--> removeMarca(id);
//showFormModifMarca/:ID --> marcasController-->showFormUpdateMarca(id);
//modificarMarca -->        marcasController--> updateMarca(id);
//login -->                 authController--> showLogin();
//auth -->                  authController--> auth();
//logout -->                authController--> logout();
//about -->                 aboutController--> showAbout();

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
        $controller->showDetalles($params[1]);
        break;
    case 'listarMarcas':
        $controller = new MarcasController();
        $controller->showMarcas();
        break;
    case 'busquedaPorMarca':
        $controller = new ProductController();
        $controller->searchProducts($params[1]);
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
    case 'about':
        $controller = new AboutController();
        $controller->showAbout();
        break;
    default: 
        $controller = new ErrorController();
        $controller->showError();
        break;
}
