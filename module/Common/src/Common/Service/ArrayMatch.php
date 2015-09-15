<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 5/7/15
 * Time: 11:05 AM
 */

namespace Common\Service;


class ArrayMatch implements ArrayMatchInterface{


    /**
     * @var array
     */
    protected $array;

    /**
     * must be in structure
     * array(
            0=>array(
     *          'required'=>  //boolean true or false  default false
     *          'constraint'=> //regular expression to be matched by the item is same position
     *      )
     * )
     *
     * @var $model
     *
     */
    protected $model;

    /**
     * @var array
     */
    protected $errors;

    public function __construct($array, $model){
        $this->array = $array;
        $this->model = $model;
        $this->errors = array();
    }

    /**
     * match an array with its model to check if it equivalent
     *
     * @return boolean
     */
    public function isMatch()
    {
        foreach($this->model as $key=>$value){
            if($this->model[$key]['required'] && !isset($this->array[$key])) {
                $this->errors[] = $key . ' is required but not set';
                continue;
            }else {
                $this->check($key, $this->array[$key], $this->model[$key]);
            }
        }

        if(count($this->errors) > 0){
            return false;
        }
        return true;
    }

    /**
     * check value against regx
     *
     * @param $key
     * @param $value
     * @param $pattern
     */
    public function check($key, $value, $pattern){
        if($pattern['required'] && $value = null)
            $this->errors[] = $key .' can not be null';

        if(!preg_match($pattern['constraint'], $value))
            $this->errors[] = $key. 'value not valid';
    }
}