<?php
/**
 * User: khaled
 * Date: 8/3/15 at 11:05 AM
 */

namespace Api\Controller;


use Application\Entity\Position;
use Zend\View\Model\JsonModel;

class NewPositionController extends BaseController
{

    public function create($data)
    {
        $position = new Position();
        $position->setLatitude($data['latitude']);
        $position->setLongitude($data['longitude']);
        $position->setComment($data['comment']);
        $position->setStatus($data['status']);
        $position->setCreatedDate(time());

        $this->getEntityManager()->persist($position);
        $this->em->flush();

        $model = new JsonModel();
        //$model->setVariables(['title'=>'post']);
        $model->setVariables($data);
        return $model;
    }

}