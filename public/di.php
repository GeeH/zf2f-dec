<?php

use Zend\ServiceManager\ServiceManager;

chdir(__DIR__ . '/../');
require('init_autoloader.php');

class Adapter
{
}

class DbLogger
{
    protected $adapter;

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }
}

class UserService
{
    protected $logger;

    public function __construct(DbLogger $logger)
    {
        $this->logger = $logger;
    }
}

$serviceManager = new ServiceManager();

$serviceManager->setInvokableClass('adapter', 'Adapter');

$serviceManager->setFactory('db-logger', function (ServiceManager $serviceManager){
    $adapter = $serviceManager->get('adapter');
    return new DbLogger($adapter);
});

$serviceManager->setFactory('user-service', function (ServiceManager $serviceManager) {
    $logger = $serviceManager->get('db-logger');
    return new UserService($logger);
});

$serviceManager->setShared('user-service', false);

// somewhere else with access to servicemanager

var_dump($sm1 = $serviceManager->get('user-service'));
var_dump($sm2 = $serviceManager->get('user-service'));
var_dump($sm3 = $serviceManager->get('user-service'));
var_dump($sm4 = $serviceManager->get('user-service'));
var_dump($sm5 = $serviceManager->get('user-service'));