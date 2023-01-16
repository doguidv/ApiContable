<?php

class CategoriasModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=bdcontable;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de tareas completa.
     */
    public function getAll() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();
        // 3. obtengo los resultados
        $localid = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos       
        return $localid;
        }
    /**
     * Devuelve la lista de localidadpor id.
     */
    public function get($id) {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM categorias WHERE id_categorias=?");
        $query->execute([$id]);
        // 3. obtengo los resultados
        $localid = $query->fetch(PDO::FETCH_OBJ); // devuelve un arreglo de objetos       
        return $localid;
        }

    /**
     * Inserta una localidad en la base de datos.
     */
    public function insert($Tipo_Inversion) {
        $query = $this->db->prepare("INSERT INTO categorias (Tipo_Inverison) VALUES (?)");
        $query->execute([$Tipo_Inversion]);
        return $this->db->lastInsertId();
        }
    /**
     * modifica una localidad dado su id.
     */
    function upDatelocalidById($id){
        $query= $this-> db->prepare("SELECT *FROM categorias WHERE id_categorias =?");
        $query->execute([$id]);
        $updatecateg= $query->fetch(PDO:: FETCH_OBJ);
        return $updatecateg;    
        }

    function update($Tipo_Inversion,$id_categorias) {
        $query=$this->db->prepare('UPDATE categorias SET  Tipo_Inversion =? WHERE id_categorias =?;');
        $query->execute([$Tipo_Inversion,$id_categorias]);

        }
    /**
     * Elimina una localidad dado su id.
     */
    function delete($id_categorias) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categorias = ?');
        $query->execute([$id_categorias]);
        }

}

