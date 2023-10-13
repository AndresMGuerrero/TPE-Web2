<?php

class ProductModel{

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_tienda_de_calzado;charset=utf8', 'root', '');
    }

    public function getProductsandMarcas($id){
        $query = $this->db->prepare('SELECT *
        FROM productos
        INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk;
        WHERE id=?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
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
        
        $query = $this->db->prepare('SELECT * FROM productos INNER JOIN marcas ON  productos.id_marca_fk = marcas.id_marcas WHERE marcas.id_marcas= ?');
        $query->execute([$id_marca]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $products;
        
    }

    public function insertProduct($nombre, $color, $talle, $tipo, $precio, $marca){
        $query = $this->db->prepare('INSERT INTO productos (nombre_producto, color, talle, tipo, precio, id_marca_fk) VALUES (?,?,?,?,?,?)');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $marca]);

        return $this->db->lastInsertId();
    }

    public function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $marca){
        //para agarrar el id que le corresponde a la marca en la tabla marcas
        $query = $this->db->prepare('SELECT id_marcas FROM marcas WHERE nombre_marca = ?');
        $query->execute([$marca]);

        $id_marca = $query->fetch(PDO::FETCH_OBJ);
            
        //luego cambiamos el apartado id_marca_fk con el id de la tabla marcas que le corresponde a la marca puesta desde el form
        $query = $this->db->prepare('UPDATE productos SET nombre_producto = ? , color = ? , talle = ? , tipo = ? , precio = ? , id_marca_fk = ? WHERE id = ?');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $id_marca->id_marcas, $id]);
        
    }

}