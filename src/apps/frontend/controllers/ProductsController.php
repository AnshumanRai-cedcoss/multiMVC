<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use MongoDB\BSON\ObjectID;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $res = $this->mongo->products->find();
        $this->view->data = $res->toArray();
    }
    public function quickViewAction()
    {
        $id = $this->request->get('id');
        $res = $this->mongo->products->findOne(["_id" => new ObjectID($id)]);
        $this->view->data = (array)$res;
    }
    
}