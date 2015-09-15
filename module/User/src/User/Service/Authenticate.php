<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 06/04/15
 * Time: 22:44
 */

namespace User\Service;


use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class Authenticate implements FactoryInterface{


    protected $authService;
    protected $data;


    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

    }

    /**
     * get AuthenticationService (Doctrine module)
     * @return array|object
     */
    public function getAuth(){
        if(!$this->authService)
            $this->authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        return $this->authService;
    }

}