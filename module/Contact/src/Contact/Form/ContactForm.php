<?php

/**
 * User: khaled
 * Date: 8/31/15 at 10:37 AM
 */

namespace Contact\Form;


use Zend\Form\Form;

class ContactForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('contact');

        $this->add([
            'name'=>'emailFrom',
            'required'=>'true',
            'attributes'=>[
                'type'=>'email',
                'required'=>'required',
            ],
        ]);

        $this->add([
            'name'=>'emailSubject',
            'required'=>'true',
            'attributes'=>[
                'type'=>'text',
                'required'=>'required',
            ],
        ]);

        $this->add([
            'name'=>'emailBody',
            'required'=>'true',
            'attributes'=>[
                'type'=>'textarea',
                'required'=>'required',
            ],
        ]);

        \Common\Form\FormCommon::addClass($this->getElements(), 'class', 'form-control');

    }


}