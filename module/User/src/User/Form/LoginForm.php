<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 14/03/15
 * Time: 17:12
 */

namespace User\Form;

use Zend\Form\Form;

class LoginForm extends Form{

    public function __construct($name = null){

        parent::__construct('login');
        
        $this->add(array(
            'name'=>'email',
            'required'=>true,
            'attributes'=>array(
                'required'=>'required',
                'class'=>'form-control',
            ),
        ));

        $this->add(array(
            'name'=>'password',
            'required'=>true,
            'attributes'=>array(
                'required'=>'required',
                'class'=>'form-control',
                'type'=>'password',
            ),
        ));

    }

}