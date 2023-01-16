<?php

class InfoModel {

    private $db;

    public function __construct() {

        $this->db = new PDO('mysql:host=localhost;'.'dbname=bdcontable;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de tareas completa.
     */
    public function getAll($Column=null,$order=null,$starAt=null,$endAt=null,$equalTo=null) {
//ordenar
        if  (($Column)&&($order)){
        $query = $this->db->prepare("SELECT * FROM info_contable ORDER BY $Column $order");
        $query->execute();
        }else {
            $query = $this->db->prepare("SELECT info_contable.*,categorias.Tipo_Inversion  as Tipo_Inversion FROM info_contable JOIN categorias ON info_contable.id_categorias_fk = categorias.id_categorias");           
            $query->execute();
             $info=$query->fetchAll(PDO::FETCH_OBJ);
        return $info;      
        }// Paginado
       if($starAt){
        $query = $this->db->prepare("SELECT * FROM info_contable  LIMIT $starAt,$endAt");
        $query->execute();
        }  //Filtro   
        if($equalTo!=null){
        $query = $this->db->prepare("SELECT * FROM info_contable  WHERE Fecha = ? ;");
        $query->execute([$equalTo]);
        }
        $pesca = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $pesca; 
    }  
    /**
     * Devuelve la lista de info pesca segun id.
     */
    public function get($id) {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM info_contable WHERE id_contable=?");
        $query->execute([$id]);

        // 3. obtengo los resultados
        $pesca = $query->fetch(PDO::FETCH_OBJ); // devuelve un arreglo
        
        return $pesca;
    }  
    
  /**
     * Inserta info pesca en la base de datos.
     */
    public function insertinfoContable($Fecha, $Detalle,$Cantidad,$Comision ,$Importe  ,$id_categorias_fk) {
        $query = $this->db->prepare("INSERT INTO info_contable (Fecha, Detalle,Cantidad,Comision, Importe,  id_categorias_fk) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$Fecha, $Detalle,$Cantidad,$Comision, $Importe,  $id_categorias_fk]);
        return $this->db->lastInsertId();
        }
/**
     * modifica info pesca dado su id.
     */
    function updateinfoById($id){
        $sentencia= $this-> db->prepare("SELECT *FROM info_contable WHERE id_contable =?;");
        $sentencia->execute([$id]);
        $infop= $sentencia->fetch(PDO:: FETCH_OBJ);
        return $infop;
        }
    function info_Contable($Fecha, $Detalle,$Cantidad,$Comision, $Importe,  $id_categorias_fk,$id_contable) {
        $query=$this->db->prepare('UPDATE info_contable SET  Fecha=?,Detalle=?,Cantidad=?,Comision=?,Importe=?,id_categorias_fk=?, WHERE id_contable= ?;');
        $query->execute ([$Fecha,$Detalle,$Cantidad,$Comision,$Importe,$id_categorias_fk,$id_contable]);      
        }
    /**
     * Elimina info pesca dado su id.
     */
    function deleteinfoById($id) {
        $query = $this->db->prepare('DELETE FROM info_contable WHERE id_contable = ?');
        $query->execute([$id]);
        }
        public function getColumns() {
              /**  $query = $this->db->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'tpoweb2' and TABLE_NAME = 'info_pesca' order by ORDINAL_POSITION");//selecciono toda la lista de la tabla clothes
               $query->execute();                  //envio la consulta        
               $columns = $query->fetchAll(PDO::FETCH_ASSOC); // devuelve un arreglo de objetos */
              $columns= array ( "*", "id_contable", "Fecha", "Detalle","Cantidad","Comision","Importe","id_categorias");
               return $columns;  //reenvia el arreglo al controlador
            
            
            }

}


