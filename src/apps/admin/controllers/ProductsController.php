<?php

namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;
use MongoDB\BSON\ObjectID;

class ProductsController extends Controller
{

    public function indexAction()
    {
        $res = $this->mongo->products->find()->toArray();
        $this->view->data = $res;
    }

    public function deleteAction()
    {
        $id = $this->request->get('id');

        $res = $this->mongo->products->deleteOne(["_id" => new ObjectID($id)]);
        $this->response->redirect('http://localhost:8080/admin/products/index');
    }

    public function updateAction()
    {
        $id = $this->request->get('id');

        $res = $this->mongo->products->findOne(["_id" => new ObjectID($id)]);
        $res = (array)$res;
        $this->view->data = $res;

        if ($this->request->has('update')) {
            $data = $this->request->getPost();
            $res = $this->mongo->products->updateOne(
                ["_id" => new ObjectID($id)],
                ['$set' =>
                [
                    "name" => $data["name"],
                    "description" => $data["description"],
                    "category" => $data['category'],
                    "price" => $data["price"],
                    "stock" => $data["stock"],
                ]]
            );
            $this->response->redirect('http://localhost:8080/admin/products/index');
        }
    }

    public function addAction()
    {
        if ($this->request->has('addProd')) {
            $data = $this->request->getPost();
            $res = $this->mongo->products->insertOne(
                [
                    "name" => $data["name"],
                    "description" => $data["description"],
                    "category" => $data['category'],
                    "price" => $data["price"],
                    "stock" => $data["stock"],
                ]
            );
            $this->response->redirect('http://localhost:8080/admin/products/index');
        }
    }
}
