<?php

class ProductView{

    public function listProducts($products){
        
        require './templates/listaProductos.phtml';
    }

    public function showDetalles($product){
        require 'templates/detalle.phtml';
    }

    
}