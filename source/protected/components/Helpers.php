<?php
/**
 * User: ${Cristazn}
 * Date: 4/6/13
 * Time: 12:26 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class Helpers {
    // cast from an $object to another object belong to class name
    public static  function cast($object, $className)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($className) . ':"' . $className . '"', serialize($object)));
    }
}