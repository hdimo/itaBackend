<?php

/**
 * Generated by ZF2ModuleCreator
 */

namespace Common;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                )
            )
        );
    }

    public function onBootstrap(MvcEvent $e){
        $app = $e->getApplication();
        $serviceManager  = $app->getServiceManager();
        $eventManager = $app->getEventManager();
        $eventManager->attach($serviceManager->get('Common\Listeners\ApiProblemListener'));
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH,
            [$serviceManager->get('Common\Listeners\Authorization'), 'authorize'],
            1000
        );
    }
}