<?php
/**
 * User: ${Cristazn}
 * Date: 4/6/13
 * Time: 12:26 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class Helpers {
    /*
     * cast from an $object to another object belong to class name
     */
    public static  function cast($object, $className)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($className) . ':"' . $className . '"', serialize($object)));
    }

    /*
     * return short url with this form : <controller>/<action>
     */
    public static  function getShortURL($longUrl) {

        //find the id param
        $hasIdParams = strrpos($longUrl,'id');
        if(!$hasIdParams) {
            //normal url style with form : http://abc.com/<module>/<controller>/<action>
            $lastPos = strrpos($longUrl,PATH_SEPARATOR);
            $action = substr($longUrl,$lastPos+1,strlen($longUrl));
            $longUrl = substr($longUrl,0,$lastPos);
            //do again to get controller
            $lastPos = strrpos($longUrl,PATH_SEPARATOR);
            $controller = substr($longUrl,$lastPos+1,strlen($longUrl));
            return array($controller . PATH_SEPARATOR . $action);

        } else {
            //url with id param form : http://abc.com/<module>/<controller>/<action>/<id>

            $lastPos = strrpos($longUrl,PATH_SEPARATOR);
            //get id first
            $id = substr($longUrl,$lastPos+1,strlen($longUrl));
            $longUrl = substr($longUrl,0,$lastPos-3);
            //get action. ignore id
            $lastPos = strrpos($longUrl,PATH_SEPARATOR);
            $action = substr($longUrl,$lastPos+1,strlen($longUrl));
            $longUrl = substr($longUrl,0,$lastPos);
            //get controller
            $lastPos = strrpos($longUrl,PATH_SEPARATOR);
            $controller = substr($longUrl,$lastPos+1,strlen($longUrl));

            return array($controller . PATH_SEPARATOR . $action, 'id'=>$id);
        }

    }

    public static function getControllerFromShortUrl($shortUrl) {

        if(!empty($shortUrl)) {
            $lastPos  = strrpos($shortUrl,PATH_SEPARATOR);
            return substr($shortUrl,0,$lastPos);
        }
    }


    public static function isEmptyArray($array) {
           foreach($array as $key=>$value) {
               if($value!=null) {
                   return false;
               }
           }

        return true;
    }
    /*
     *  so sanh tung gia tri 2 mang voi nhau. Array1 la mang
     */

    public static function compareArray($smallArray, $bigArray) {
        foreach($smallArray as $item) {
            if($smallArray[$item] != $bigArray[$item])
                return false;

        }
        return true;
    }

}