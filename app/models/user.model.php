<?php

class UserModel{

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_tienda_de_calzado;charset=utf8', 'root', '');
    }

    public function getUserByName($userName){
        $query = $this->db->prepare('SELECT * FROM administradores WHERE nombre_Usuario= ?');
        $query->execute([$userName]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}