<?php
/**
 * User: khaled
 * Date: 9/8/15 at 4:06 PM
 */

namespace User\Controller;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use User\Form\RegisterForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ArrayObject;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractActionController
{

    public function indexAction(){
        $user = $this->identity();
        $em = $this->getServiceLocator()->get('Doctrine\ORm\EntityManager');
        $hydrator = new DoctrineObject( $em, get_class($user));
        $data = $hydrator->extract($user);
        $form = new RegisterForm();
        $form->bind(new ArrayObject($data));
        return new ViewModel([
            'form'=>$form
        ]);
    }

    public function processAction(){
    }

}