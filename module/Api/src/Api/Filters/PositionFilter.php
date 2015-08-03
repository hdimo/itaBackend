<?php
/**
 * User: khaled
 * Date: 8/3/15 at 11:16 AM
 */

namespace Api\Filters;


use Zend\InputFilter\InputFilter;

class PositionFilter extends InputFilter
{

    public function __construct(){

        $this->add([
            'name'=>'lat',
            'required'=>true,
            'validatros'=>[

            ],
        ]);

    }

}