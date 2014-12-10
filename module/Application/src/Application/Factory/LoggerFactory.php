<?php
/**
 * Created by Gary Hockin.
 * Date: 10/12/14
 * @GeeH
 */

namespace Application\Factory;


use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $logger = new Logger();
        $stream = new Stream('logs/' . date('Y') . 'log');
        $logger->addWriter($stream);
        return $logger;
    }
}