<?php
/**
 * Created by Gary Hockin.
 * Date: 12/12/14
 * @GeeH
 */

namespace Application\Factory;


use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\AbstractFactoryInterface;

class TableAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return fnmatch('*Table', $requestedName);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $tableName = strtolower(str_replace('Table', '', $requestedName));
        return new TableGateway($tableName, $serviceLocator->get('Zend\Db\Adapter\Adapter'));
    }
}