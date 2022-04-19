<?php

namespace Multiple\Admin\Controllers;

use Multiple\Admin\Components\MyEscaper;
use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        if($this->request->has('login'))
        {
            $ob = new MyEscaper();
            $r=$this->request->getPost();
            $result = $ob->escaped($r);
           
            $res = $this->mongo->users->findOne(
                ["email" => $result['input1'],
                "passsword" => $result['password']]
            ); 
            $res = (array)$res;
            if(count($res) > 0)
            {
             $this->response->redirect('http://localhost:8080/admin/products/index');
            }
            else {
                $this->mylogs
                ->error('Wrong email or password!Try again');
                $this->view->message = "Wrong email or password!Try again";
                die("wrong id and password");
            }
        }
    }

    
}