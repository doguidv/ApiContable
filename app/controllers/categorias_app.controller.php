<?php
require_once './app/models/categorias.model.php';
require_once './app/views/app.view.php';

class CategoriasApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new CategoriasModel();
        $this->view = new AppView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function gets($params = null) {

        $tasks = $this->model->getAll();
        $this->view->response($tasks);
    }

    public function get($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $categorias = $this->model->get($id);

        // si no existe devuelvo 404
        if ($categorias)
            $this->view->response($categorias);
        else 
            $this->view->response("La localidad con el id=$id no existe", 404);
    }

    public function delete($params = null) {
        $id = $params[':ID'];

        $task = $this->model->get($id);
        if ($task) {
            $this->model->delete($id);
            $this->view->response($task);
        } else 
            $this->view->response("La localidad con el id=$id no existe", 404);
    }

    public function insert($params = null) {
        $categorias = $this->getData();

        if (empty($categorias->Tipo_Inversion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($categorias->Tipo_Inversion);
            $categorias = $this->model->get($id);
            $this->view->response($categorias, 201);
        }
    }
    
    public function update($params = null) {
        $Categ_id = $params[':ID'];
        $Categ = $this->model->get($Categ_id);
        if (isset($Categ)) {
            $body = $this->getData();
            $tarea = $this->model->update($body->localidad, $body->id_localidad);
            $this->view->response("Localidad con id=$Categ_id actualizada con éxito", 200);
        }
        else 
            $this->view->response("Localidad con  id=$Categ_id not found", 404);
    }
}
