<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 14/03/15
 * Time: 17:10
 */

namespace User\Controller;


use Application\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use User\Form\LoginForm;

class LoginController extends AbstractActionController{

    protected $authService;

    /**
     * @return ViewModel
     */
    public function indexAction(){
        $form = new LoginForm();
        return new ViewModel(array(
            'form'=>$form,
        ));
    }

    /**
     * check if user is correctly login
     *
     * @return \Zend\Http\Response |ViewModel | redirect
     */
    public function processAction(){
        $data = $this->params()->fromPost();
        $form = new LoginForm();
        $form->setData($data);
        $viewModel = new ViewModel(["form"=>$form]);
        $viewModel->setTemplate('user/login/index');

        if($form->isValid()){

            $this->authService = $this->getAuth();
            $adapter = $this->authService->getAdapter();
            $adapter->setIdentityValue($data['email']);
            $adapter->setCredentialValue($data['password']);
            $authResult = $this->authService->authenticate();

            if ($authResult->isValid()) {
                $identity = $authResult->getIdentity();
                $this->authService->getStorage()->write($identity);
                //TODO move bellow  logic to specific service update last login time
                return $this->redirect()->toRoute('board');
            }else{
                $viewModel->setVariable("isLoginError", true);
            }
        }else{
            $viewModel->setVariable("isFormError", true);
        }
        return $viewModel;
    }

    /**
     * logout from application
     *
     */
    public function logoutAction(){
        $this->getAuth()->getStorage()->clear();
        return $this->redirect()->toRoute('home');
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