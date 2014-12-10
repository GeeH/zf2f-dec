<?php
use Zend\EventManager\ListenerAggregateInterface;

chdir(__DIR__ . '/../');
require('init_autoloader.php');

class StereoEventAggregate implements ListenerAggregateInterface
{

    protected $listeners = array();

    public function attach(\Zend\EventManager\EventManagerInterface $eventManager)
    {
        $events = array('play', 'record', 'stop', 'pause');
        foreach ($events as $event) {
            $this->listeners[$event] = $eventManager->attach(
                $event, array($this, 'handleEvent'));
        }
    }

    public function detach(\Zend\EventManager\EventManagerInterface $eventManager)
    {
        foreach ($this->listeners as $event => $listener) {
            $eventManager->detach($listener);
        }
    }

    public function detachFromEvent($eventManager, $event)
    {
        $eventManager->detach($this->listeners[$event]);
    }

    public function handleEvent(\Zend\EventManager\Event $event)
    {
        var_dump($event->getName());
    }

}

$eventManager = new \Zend\EventManager\EventManager();
$aggregate = new StereoEventAggregate();
$eventManager->attachAggregate($aggregate);
$aggregate->detachFromEvent($eventManager, 'stop');
$eventManager->trigger('play');
$eventManager->trigger('stop');
$eventManager->trigger('pause');
