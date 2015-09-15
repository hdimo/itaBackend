<?php
/**
 * User: khaled
 * Date: 8/31/15 at 10:55 AM
 */

namespace Common\Form;


class FormCommon
{
    public static function addClass($elements, $attrName, $attrValue){
        foreach($elements as $element){
            $element->setAttribute($attrName, $attrValue);
        }
    }

}