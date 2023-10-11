<?php

class ProductView{

    public function listProductsMarcasPublic($products, $marcas){
        
        require './templates/listaProductosMarcasPublico.phtml';
    }

    public function showDetalles($product){
        require 'templates/detalle.phtml';
    }

    public function listProductsAdmin($products, $marcas){
        
        require './templates/listaProductosAdmin.phtml';
    }

    
}