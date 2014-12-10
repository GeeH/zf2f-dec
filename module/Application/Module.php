<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Service\UserService;
use Zend\Log\Logger;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()
            ->getEventManager()
            ->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));

        // default routing is attached EVENT_ROUTE with priority on 1
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Service\UserService' => function (ServiceManager $sm) {
                    $logger = $sm->get('Zend\Log\Logger');
                    return new UserService($logger);
                },
                'Zend\Log\Logger' => 'Application\Factory\LoggerFactory',
            ),
            'invokables' => array(
            ),
            'aliases' => array(
                'user-service' => 'Application\Service\UserService',
            ),


        );
    }

    public function onDispatch(MvcEvent $e)
    {
    }
}