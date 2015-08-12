<?php
/**
 * User: khaled
 * Date: 8/2/15 at 1:54 PM
 */

namespace Api\Controller;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
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
        $hydrator = new DoctrineObject(
            $this->getEntityManager(),
            'Application\Entity\Position'
        );
        $positionEntities = $this->getEntityManager()->getRepository('Application\Entity\Position')->findAll();
        $position=[];
        foreach($positionEntities as $entity){
            $img = $this->getImageDir().''.$entity->getImage();
            $entity->setImage($img);
            $position[] = $hydrator->extract($entity);
        }
        return new JsonModel($position);
    }


    protected function getImageDir(){
        $uri = $this->getRequest()->getUri();
        $base = sprintf('%s://%s/img/position/', $uri->getScheme(), $uri->getHost());
        return $base;
    }
}