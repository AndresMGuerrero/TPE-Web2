<?php

class MarcasModel{

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_tienda_de_calzado;charset=utf8', 'root', '');
    }

    public function getMarcas(){

        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();

        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

    public function insertMarca($nombre, $anio, $localizacion){
        $query = $this->db->prepare('INSERT INTO marcas (nombre_marca, fecha_creacion, loc_fabrica) VALUES (?,?,?)');
        $query->execute([$nombre, $anio, $localizacion]);

        return $this->db->lastInsertId(); //No funciona si es un string?
    }

    public function deleteMarca($id){
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marcas = ?');
        $query->execute([$id]);
    }

    public function getMarca($id){

        $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marcas = ?');
        $query->execute([$id]);

        $marca = $query->fetch(PDO::FETCH_OBJ);

        return $marca;
    }

    public function updateMarca($id, $anio, $localizacion){
        $query = $this->db->prepare('UPDATE marcas SET fecha_creacion = ? , loc_fabrica = ? WHERE id_marcas = ?');
        $query->execute([$anio, $localizacion, $id]);
    }
}