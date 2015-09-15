<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/21/15
 * Time: 12:11 PM
 */

namespace User\Service\AbstractFactory;


use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OauthAbstractFactory implements AbstractFactoryInterface{

    protected $suppliers = array(
        'Facebook',
        'Google',
    );
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
        if(in_array($requestedName, $this->suppliers))
            return true;
        return false;
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
        $serviceName = 'ReverseOAuth2\\'.$requestedName;
        return  $serviceLocator->get($serviceName);
    }

}