<?php
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

use Zend\Captcha\ReCaptcha;

class RegisterForm extends Form
{
    protected $filter;

    public function __construct($name = null){
        parent::__construct('register');


        $this->add(array(
            'name'=>'lastname',
            'attributes'=>array(
                'required'=>'required',
                'type'=>'text',
            ),
        ));
        
        $this->add(array(
            'name'=>'firstname',
            'attributes'=>array(
                'required'=>'required',
                'type'=>'text',
            ),
        ));
        
        $this->add(array(
            'name'=>'email',
            'attributes'=>array(
                'required'=>'required',
                'type'=>'text',
            ),
        ));

        $this->add(array(
            'name'=>'phone',
            'required'=>true,
            'attributes'=>array(
                'required'=>'required',
                'type'=>'text',

            ),
        ));
        
        $this->add(array(
            'name'=>'password',
            'attributes'=>array(
                'required'=>'required',
                'type'=>'password',
            ),
        ));
        
        $this->add(array(
            'name'=>'confirm_password',
            'attributes'=>array(
                'required'=>'required',
                'type'=>'password',
            ),
        ));
        \Common\Form\FormCommon::addClass($this->getElements(), 'class', 'form-control');
    }

    public function setInputFilter(InputFilterInterface $filter){
        throw new \Exception("not allowed");
    }

    public function getInputFilter(){

        if($this->filter == null){
            $this->filter = new InputFilter();

            $this->filter->add(array(
                "name"=>"firstname",
                "required"=>true,
                'validators'=>array(
                    array(
                        'name'=>'Alpha',
                        'options'=>array(
                            "allowWhiteSpace"=>true
                        ),
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 50,
                        ),
                    ),

                )
            ));

            $this->filter->add(array(
                "name"=>"lastname",
                "required"=>true,
                'validators'=>array(
                    array(
                        'name'=>'Alpha',
                        'options'=>array(
                            "allowWhiteSpace"=>true
                        ),
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 50,
                        ),
                    ),
                )
            ));

            $this->filter->add(array(
                "name"=>"email",
                "required"=>true,
                "validators"=>array(
                    array(
                        "name"=>'EmailAddress'
                    )
                ),
            ));

            $this->filter->add(array(
                'name'=>"phone",
                "required"=>true,
                'validators'=>array(
                    array(
                        'name'=>'regex',
                        'options'=>array(
                            "pattern"=>'/^[0-9]{8,15}$/',
                            "message"=>"numero invalide"
                        )

                    )
                ),
            ));

            $this->filter->add(array(
                'name'=>'password',
                'validators'=>array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min'      => 6,
                            'max'      => 50,
                        ),
                    ),
                ),
            ));
        }

        return $this->filter;

    }



}
