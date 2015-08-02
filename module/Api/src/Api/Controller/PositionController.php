<?php
/**
 * User: khaled
 * Date: 8/2/15 at 1:54 PM
 */

namespace Api\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PositionController extends AbstractRestfulController
{

    public function get($id)
    {
        if(!$id){
            throw new \Exception('Position id must be passed', 11);
        }
        $response = $this->getResponseWithHeader()
            ->setContent(__METHOD__ . ' get current data with id =  ' . $id);
        return $response;
    }

    public function getList()
    {
        /*
        return $this->response->setStatusCode(
            Response::STATUS_CODE_404
        );
        */

        //$this->getResponseWithHeader()->setContent(__METHOD__ . ' get the list of data');
        $this->response->setStatusCode(
            Response::STATUS_CODE_404
        );
        return new JsonModel([
            'list method',
        ]);
    }

    // configure response
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
}