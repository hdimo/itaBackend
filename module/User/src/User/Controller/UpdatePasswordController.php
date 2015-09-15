<?php
/**
 * User: khaled
 * Date: 9/10/15 at 3:59 PM
 */

namespace User\Controller;


use User\Form\RegisterForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UpdatePasswordController extends AbstractActionController
{
    /**
     * display update password form
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new RegisterForm();
        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * process Updating password
     *
     * @return ViewModel
     */
    public function processAction()
    {
        $form = new RegisterForm();
        $viewModel = new ViewModel();
        $viewModel->setTemplate('user/update-password/index');
        $viewModel->setVariable('form', $form);

        $data = $this->params()->fromPost();

        if (!isset($data["password"]) || !isset($data["confirm_password"]))
            return $viewModel;

        if ($data["password"] == $data['confirm_password']) {
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $user = $this->identity();
            $user->setPassword($data['password']);
            $em->persist($user);
            $em->flush();
            $viewModel->setVariable('successChanged', true);
        } else {
            $viewModel->setVariable('successChanged', false);
        }
        return $viewModel;
    }

}