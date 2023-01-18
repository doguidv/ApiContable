<?php
require_once './app/models/info.model.php';
require_once './app/views/app.view.php';

class InfoContableApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new InfoModel();
        $this->view = new AppView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getinfocs($params = null) {

        if (!empty ($_GET['sort']) && !empty($_GET['order'])){
            $sort=$_GET['sort'];
            $order=$_GET['order'];
            //orden asc o desc
            $columns=$this->model->getColumns();
            if((in_array($sort, $columns)) && (($order == "asc") || ($order == "desc"))){
                $infops = $this->model->getAll($sort,$order);
                $this->view->response($infops, 200);                    
            }else if (($order!="asc")||($order!="desc")) {
                $this->view->response("para ordenar ascendente o desc escribir al final del endpoint asc o desc o especifique un nombre de columna valido", 404);         
            }
        }
            else{
            $infops = $this->model->getAll();
            $this->view->response($infops, 200);     
            }
    }

    
    public function getinfoCaract($params = null) {
        if (!empty ($_GET['sort']))  {
      $infops = $this->model->getInfoCarac();
      $this->view->response($infops, 200);                   
     }




    }

    public function getinfoc($params = null) {
        // obtengo el id del arreglo de params                
            $id = $params[':ID'];
          
            if ($id >=0){
                $infoc = $this->model->get($id);
                
                if ($infoc)
                $this->view->response($infoc);
                else 
                $this->view->response("La info con el id=$id no existe", 400);
            }else {
                $this->view->response("Solos ides +", 400);
            }
    } 
   

    public function deleteinfo($params = null) {
        $id = $params[':ID'];

        $infoc = $this->model->get($id);
        if (isset($infoc)) {
            $this->model->deleteinfoById($id);
            $this->view->response($infoc);
        } else {
            $this->view->response("La info con el id=$id no existe", 404);
        }
    }

    public function insertinfo($params = null) {
        $infoc = $this->getData();
       
        if (empty($infoc->Fecha) || empty($infoc->Detalle) ||   empty($infoc->Cantidad )   ||empty($infoc->Comision )   ||  empty($infoc->Importe)  || empty($infoc->id_categorias_fk)  ) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertinfoContable($infoc->Fecha, $infoc->Detalle,$infoc->Cantidad,$infoc->Comision ,$infoc->Importe,  $infoc->id_categorias_fk);
            $infoc = $this->model->get($id);
            $this->view->response($infoc, 201);
        }
    }
    
    public function updateinfo($params = null) {
        $infoc_id = $params[':ID'];
        $infoc = $this->model->get($infoc_id);
        if (isset ($infoc)) {
            $body = $this->getData();
            $infoc = $this->model->info_Contable($body->Fecha, $body->Detalle, $body->Cantidad,$body->Comision, $body->Importe,  $body->id_categorias_fk,$body->id_contable);
            $this->view->response("Localidad con id=$infoc_id actualizada con éxito", 200);
        }
        else 
            $this->view->response("Localidad con  id=$infoc_id not found", 404);
    }

}
