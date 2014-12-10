<?php
chdir(__DIR__ . '/../');
require('init_autoloader.php');

define('STEREO_PLAY', 'play');

$sharedEventManager = new \Zend\EventManager\SharedEventManager();

$listener1 = function (\Zend\EventManager\Event $event) {
    echo 'Listener One </br>';
};

$listener2 = function (\Zend\EventManager\Event $event) {
    echo 'Listener Two </br>';
};

$listener3 = function (\Zend\EventManager\Event $event) {
    echo 'Listener Three </br>';
};

$sharedEventManager->attach('stereo', STEREO_PLAY, $listener1, 1000);
$sharedEventManager->attach('stereo', STEREO_PLAY, $listener2, 100);
$sharedEventManager->attach('stereo', STEREO_PLAY, $listener3, 10);

// lots of cool happens somewhere else in our application

$eventManager = new \Zend\EventManager\EventManager('stereo');
$eventManager->setSharedManager($sharedEventManager);
$eventManager->attach(STEREO_PLAY, function($e) {
    echo 'First from native EM</br>';
}, 10000);
$eventManager->trigger(STEREO_PLAY);