<?php
/**
 * User: khaled
 * Date: 8/30/15 at 4:11 PM
 */

namespace Contact\Controller;

use Contact\Form\ContactForm;
use Contact\Service\EmailService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    const EMAIL_RECEIVER = 'khaled.hadj.a@gmail.com';

    /**
     * @var EmailService
     */
    protected $emailService;

    public function indexAction(){
        $form = new ContactForm();
        return new ViewModel([
            'contactForm'=>$form
        ]);
    }

    public function processAction(){
        $emailFrom = $data = $this->params()->fromPost('emailFrom');
        $emailSubject = $data = $this->params()->fromPost('emailSubject');
        $emailBody = $data = $this->params()->fromPost('emailBody');

        //TODO validate data
        $this->getEmailService()->setEmailFrom($emailFrom);
        $this->getEmailService()->setEmailSubject($emailSubject);
        $this->getEmailService()->setEmailBody($emailBody);
        $this->getEmailService()->setTo(self::EMAIL_RECEIVER);
        $this->getEmailService()->sendMail();
    }

    public function getEmailService(){
        if(!$this->emailService)
            $this->emailService = $this->getServiceLocator()->get('email_service');
        return $this->emailService;
    }
}