<?php

namespace Multiple\Admin;

use Phalcon\Loader;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Config;
use Phalcon\Config\ConfigFactory;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(
        DiInterface $container = null
    )
    {
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'Multiple\Admin\Controllers' => '../apps/admin/controllers/',
                'Multiple\Admin\Models'      => '../apps/admin/models/',
            ]
        );

        $loader->register();
    }

    public function registerServices(DiInterface $container)
    {
        // Registering a dispatcher
        $container->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace(
                    'Multiple\Admin\Controllers'
                );

                return $dispatcher;
            }
        );

        $container->set(
            'config',
            function () {
                $fileName = APP_PATH . '/etc/config.php';
                $factory  = new ConfigFactory();
                return $factory->newInstance('php', $fileName);
            },
            true
        );



        // Registering the view component
        $container->set(
            'view',
            function () {
                $view = new View();
                $view->setViewsDir(
                    '../apps/admin/views/'
                );

                return $view;
            }
        );

        $container->set(
            'mongo',
            function () {
                $mongo = new \MongoDB\Client("mongodb://mongo", array("username" => 'root', "password" => "password123"));
        
                return $mongo->store;
            },
            true
        );
        

    }
}