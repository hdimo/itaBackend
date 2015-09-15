<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 13/04/15
 * Time: 19:29
 */

namespace User\Controller;

use Application\Entity\User;
use User\Form\RegisterForm;
use Zend\Mvc\Controller\AbstractActionController;

use Zend\Session\Container;
use Zend\Stdlib\ArrayObject;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\View\Model\ViewModel;

class OauthController extends AbstractActionController{

    const DEFAULT_SUPLIER = 'Facebook';

    protected $reverseOauth;
    protected $view;

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function indexAction(){

        $suplier =$this->params()->fromRoute('type');
        if($suplier){
            $suplier = ucfirst($suplier);
        }else{
            $suplier = self::DEFAULT_SUPLIER;
        }

        $me = $this->getReverseOauth($suplier);
        if (strlen($this->params()->fromQuery('code')) > 10) {
           return $this->auth($me);
        } else {
            $url = $me->getUrl();
            return $this->redirect()->toUrl($url);
        }
    }

    /**
     * @param $reverseOauth
     */
    public function auth($reverseOauth){
        if($reverseOauth->getToken($this->request)) {
            $token = $reverseOauth->getSessionToken(); // token in session
        } else {
            $token = $reverseOauth->getError(); // last returned error (array)
        }
        $info = $reverseOauth->getInfo();

        if($info){
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $user = $em->getRepository('Application\Entity\User')->findOneByEmail($info->email);
            if($user){

                $user->setLastLogin(time());
                $em->persist($user);
                $em->flush();

                $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $authService->getStorage()->write($user);


                //if it come from other uri then redirect it

                $traject = new Container('traject');
                if($traject->trajectData){
                    return $this->redirect()->toRoute('traject/default', array('controller'=>'manage', 'action'=>'success'));
                }
                return $this->redirect()->toRoute('board');

            }else{

                $info->firstname = $info->first_name; //to make same name as form elements
                $info->lastname = $info->last_name;

                $hydrator = new ObjectProperty();
                $data = $hydrator->extract($info);

                $form = new RegisterForm();
                $form->setData($data);

                $view = new ViewModel(array(
                    'registerForm'=>$form
                ));
                $view->setTemplate('user/register/index');
                return $view;
            }
        }

    }


    /**
     * @param $supplier
     * @return ReverseOauth2 | bool
     */
    protected function getReverseOauth($supplier){
        switch($supplier){
            case 'Facebook':
                return $this->getServiceLocator()->get('ReverseOAuth2\Facebook');
                break;
            case 'Google':
                return $this->getServiceLocator()->get('ReverseOAuth2\Google');
            break;

            default:
                return false;
                break;
        }
    }


}