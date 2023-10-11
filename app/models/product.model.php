<?php

class ProductModel{

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_tienda_de_calzado;charset=utf8', 'root', '');
    }

    public function getProducts(){

        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProduct($id){

        $query = $this->db->prepare('SELECT * FROM productos WHERE id = ?');
        $query->execute([$id]);

        $product = $query->fetch(PDO::FETCH_OBJ);

        return $product;
    }

    public function searchProducts($id_marca){
        $busquedaFinal= '%'.$id_marca . '%';
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_marca LIKE ?');
        $query->execute($busquedaFinal);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function insertProduct($nombre, $color, $talle, $tipo, $precio, $marca){
        $query = $this->db->prepare('INSERT INTO productos (nombre_producto, color, talle, tipo, precio, id_marca) VALUES (?,?,?,?,?,?)');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $marca]);

        return $this->db->lastInsertId();
    }

    public function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $marca){
        $query = $this->db->prepare('UPDATE productos SET nombre_producto = ? , color = ? , talle = ? , tipo = ? , precio = ? , id_marca = ? WHERE id = ?');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $marca, $id]);
        
    }

}