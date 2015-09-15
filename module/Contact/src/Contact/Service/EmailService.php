<?php
/**
 * User: khaled
 * Date: 8/31/15 at 9:57 AM
 */

namespace Contact\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

class EmailService
{

    protected $emailFrom;
    protected $emailSubject;
    protected $emailBody;
    protected $to;
    protected $bcc = [];
    protected $acc = [];

    /**
     * @var Message
     */
    protected $mailMessageObject;

    /**
     * @var Smtp | Sendmail
     */
    protected $transport;

    public function __construct($subject = null, $to = null, $message = null){
        $this->mailMessageObject = new Message();
        $this->emailSubject = $subject;
        $this->to = $to;
        $this->emailBody = $message;
    }

    /**
     * set SMTP config
     *
     * @param array $config
     * @return $this
     */
    public function setTransport(array $config){
        $transport = new Smtp();
        $options   = new SmtpOptions(array(
            'name'              => $config['name'],
            'host'              => $config['host'],
            'connection_class'  => $config['login'],
            'connection_config' => array(
                'username' => $config['user'],
                'password' => $config['pass'],
            ),
        ));
        $transport->setOptions($options);
        $this->transport = $transport;
        return $this;
    }

    /**
     * Send mail
     */
    public function sendMail(){
        if(!$this->transport)
            $this->transport = new Sendmail();

        $this->getMailMessageObject()->setFrom($this->emailFrom);
        $this->getMailMessageObject()->setSubject($this->emailFrom);
        $this->getMailMessageObject()->setBody($this->emailFrom);

        $this->transport->send($this->getMailMessageObject());
    }

    /**
     * @return mixed
     */
    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    /**
     * @param mixed $emailFrom
     */
    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;
    }

    /**
     * @return null
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * @param null $emailSubject
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
    }

    /**
     * @return null
     */
    public function getEmailBody()
    {
        return $this->emailBody;
    }

    /**
     * @param null $emailBody
     */
    public function setEmailBody($emailBody)
    {
        $this->emailBody = $emailBody;
    }

    /**
     * @return null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param null $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param array $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return array
     */
    public function getAcc()
    {
        return $this->acc;
    }

    /**
     * @param array $acc
     */
    public function setAcc($acc)
    {
        $this->acc = $acc;
    }

    /**
     * @return Message
     */
    public function getMailMessageObject()
    {
        return $this->mailMessageObject;
    }

    /**
     * @param Message $mailMessageObject
     */
    public function setMailMessageObject($mailMessageObject)
    {
        $this->mailMessageObject = $mailMessageObject;
    }

}