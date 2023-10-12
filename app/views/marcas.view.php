<?php

class MarcasView{

    public function listaMarcas($marcas){

        require 'templates/listaMarcas.phtml';
    }
    
    public function showFormAddMarca(){
        require 'templates/formAddMarca.phtml';
    }
}