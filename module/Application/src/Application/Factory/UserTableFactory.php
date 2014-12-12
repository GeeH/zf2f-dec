<?php

namespace Application\Factory;


use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = new TableGateway('user', $serviceLocator->get('Zend\Db\Adapter\Adapter'));
        return $tableGateway;
    }
}

class NewsTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = new TableGateway('news', $serviceLocator->get('Zend\Db\Adapter\Adapter'));
        return $tableGateway;
    }
}