<?php

class ProductView{

    public function listProducts($products){
        //Poner en el template
        /*<?php foreach($products as $product): ?>*/
        //El listado
        /* <?php endforeach ?>*/

        require 'templates/ProductList.phtml';
    }

    public function showDetalles($product){
        require 'templates/detalle.phtml';
    }

    
}