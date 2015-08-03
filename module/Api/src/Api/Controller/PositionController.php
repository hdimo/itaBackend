<?php
/**
 * User: khaled
 * Date: 8/2/15 at 1:54 PM
 */

namespace Api\Controller;

use Zend\View\Model\JsonModel;

class PositionController extends BaseController
{
    public function get($id)
    {
        if(!$id){
           $this->showErrorMessage('id is required', 100);
        }
        return new JsonModel();
    }

    public function getList()
    {
        return new JsonModel([
            'title'=>'list method',
        ]);
    }
}