<?php
/**
 * User: khaled
 * Date: 8/3/15 at 10:40 AM
 */

namespace Api\Controller;


use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractRestfulController;

class BaseController extends AbstractRestfulController
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;


    /**
     * configure response
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
            //make can accessed by *
            ->addHeaderLine('Access-Control-Allow-Origin', '*')
            //set allow methods
            ->addHeaderLine('Access-Control-Allow-Methods', 'POST PUT DELETE GET');

        return $response;
    }

    /**
     * show error message
     *
     * @param $message
     * @param int $code
     * @throws \Exception
     */
    public function showErrorMessage($message, $code = 100){
        throw new \Exception($message, $code);
    }


    /**
     * get entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager(){
        if(!$this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $this->em;
    }



}