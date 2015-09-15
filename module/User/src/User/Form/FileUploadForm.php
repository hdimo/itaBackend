<?php
/**
 * User: khaled
 * Date: 6/2/15 at 11:16 AM
 */

namespace User\Form;


use Zend\Form\Form;
use Zend\Validator\File\MimeType;

class FileUploadForm extends Form{

    public function __construct($name = null){

        parent::__construct('fileUpload');

        $this->add(array(
            'name'=>'filename',
            'attributes'=>array(
                'type'=>'text',
            ),
        ));

        $this->add(array(
            'name'=>'file',
            'attributes'=>array(
                'type'=>'file',
                'required'=>'true',
            ),
            'validators' => array(
                array(
                    'name' => 'Zend\Validator\File\Size',
                    'options' => array(
                        'min' => '100KB',
                        'max' => '2MB',
                    ),
                ),
                array(
                    'name' => 'Zend\Validator\File\IsImage',
                ),
            ),
        ));

    }

}