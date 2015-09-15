<?php
namespace User\Controller;

use Application\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\RegisterForm;

class RegisterController extends AbstractActionController
{

    /**
     * get the registration form
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new RegisterForm();
        return new ViewModel(array("registerForm" => $form));
    }


    /**
     * validate data and register user in DB
     *
     * @return ViewModel
     */
    public function processAction()
    {

        if ($this->request->isPost()) {
            $form = new RegisterForm();
            $data = $this->params()->fromPost();

            $viewModel = new ViewModel();
            $viewModel->setTemplate('user/register/index');
            $viewModel->setVariable("registerForm", $form);

            $form->setData($data);

            if ($form->isValid()) {

                if ($data["password"] == $data["confirm_password"]) {

                    $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $userRepo = $em->getRepository('Application\Entity\User');
                    $user = $userRepo->findByEmail($data['email']);

                    if($user){
                        $viewModel->setVariable('accountExistError', true);
                        return $viewModel;
                    }

                    $user = new User();
                    $user->setFirstname($data['firstname']);
                    $user->setLastname($data['lastname']);
                    $user->setEmail($data['email']);
                    $user->setPhone($data['phone']);
                    $user->setPassword($data['password']);

                    $user->setBlocked(0);
                    $user->setEmailVerified(0);
                    $user->setPhoneVerified(0);
                    $user->setRole('u');
                    $user->setRegistredDate(time());

                    $em->persist($user);
                    $em->flush();

                    $params = [
                        "email" => $user->getEmail(),
                    ];

                    //$eventManager = $this->getEventManager()->trigger('sendMail', null, );
                    //TODO continue and send mail by Listener class
                    $this->redirect()->toRoute('user', array('controller'=>'register', 'action'=>'success'));

                } else {
                    $viewModel->setVariable('passwordError', true);
                    return $viewModel;
                }
            } else {
                $viewModel->setVariable('formError', true);
                return $viewModel;
            }
        } else {
            $this->redirect()->toRoute('user', array('controller' => "register", "action" => "index"));
        }

    }


    /**
     * display success page
     *
     * @return ViewModel
     */
    public function successAction()
    {
        return new ViewModel();
    }
}