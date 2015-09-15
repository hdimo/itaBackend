<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 5/7/15
 * Time: 11:03 AM
 */

namespace Common\Service;


interface ArrayMatchInterface {

    /**
     * match an array with its model to check if it equivalent
     *
     * @param mixed $array
     * @param mixed $model
     * @return mixed
     */
    public function isMatch();

}