<?php

class ProductView{

    public function listProductsMarcasPublic($products, $marcas){        
        require './templates/listaProductosMarcasPublico.phtml';
    }

    public function listProductsByMarca($products, $marca){        
        require './templates/listaProdByMarca.phtml';
    }

    public function showDetalles($product){
        require 'templates/detalle.phtml';
    }

    public function listProductsAdmin($products, $marcas){        
        require './templates/listaProductosAdmin.phtml';
    }

    public function showProductsandMarcas($product){        
        require './templates/formUpdateProd.phtml';
    }    
}