<?php
namespace Application\Service;

use Zend\Log\Logger;

class UserService
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
}