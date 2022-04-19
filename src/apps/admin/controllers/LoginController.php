<?php

namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        if($this->request->has('login'))
        {
            $r=$this->request->getPost();
            print_r($r);
            $res = $this->mongo->users->findOne(
                ["email" => $r['input1']],
                ["passsword" => $r['password']]
            ); 
            echo "<pre>";
            print_r((array)$res);
            die;
        }
    }

    
}