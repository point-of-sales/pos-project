<?php
/**
 * User: ${Cristazn}
 * Date: 4/6/13
 * Time: 12:26 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

class Helpers
{
    /*
     * cast from an $object to another object belong to class name
     */
    public static function cast($object, $className)
    {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($className) . ':"' . $className . '"', serialize($object)));
    }

    /*
     * return short url with this form : <controller>/<action>
     */
    public static function getShortURL($longUrl)
    {

        //find the id param
        $hasIdParams = strrpos($longUrl, 'id');
        if (!$hasIdParams) {

            //normal url style with form : http://abc.com/<module>/<controller>/<action>
            $lastPos = strrpos($longUrl, '/');
            $action = substr($longUrl, $lastPos + 1, strlen($longUrl));
            $longUrl = substr($longUrl, 0, $lastPos);
            //do again to get controller
            $lastPos = strrpos($longUrl, '/');
            $controller = substr($longUrl, $lastPos + 1, strlen($longUrl));
            return array($controller . '/' . $action);

        } else {
            //url with id param form : http://abc.com/<module>/<controller>/<action>/<id>

            $lastPos = strrpos($longUrl, '/');
            //get id first
            $id = substr($longUrl, $lastPos + 1, strlen($longUrl));
            $longUrl = substr($longUrl, 0, $lastPos - 3);
            //get action. ignore id
            $lastPos = strrpos($longUrl, '/');
            $action = substr($longUrl, $lastPos + 1, strlen($longUrl));
            $longUrl = substr($longUrl, 0, $lastPos);
            //get controller
            $lastPos = strrpos($longUrl, '/');
            $controller = substr($longUrl, $lastPos + 1, strlen($longUrl));

            return array($controller . '/' . $action, 'id' => $id);
        }

    }

    public static function getControllerFromShortUrl($shortUrl)
    {

        if (!empty($shortUrl)) {
            $lastPos = strrpos($shortUrl, '/');
            return substr($shortUrl, 0, $lastPos);
        }
    }


    public static function isEmptyArray($array)
    {
        foreach ($array as $key => $value) {
            if ($value != null) {
                return false;
            }
        }

        return true;
    }

    /*
     *  so sanh tung gia tri 2 mang voi nhau. Array1 la mang
     */

    public static function compareArray($smallArray, $bigArray)
    {
        foreach ($smallArray as $item) {
            if ($smallArray[$item] != $bigArray[$item])
                return false;

        }
        return true;
    }

    public static function deleteButtonClick()
    {
        return "js:function(){

                    var r = confirm('Bạn có muốn xóa không ?');
                    if(r) {
                        var url = $(this).attr('href');
                         $.fn.yiiGridView.update('grid', {  //change my-grid to your grid's name
                         type:'POST',
                         url:$(this).attr('href'),
                         success:function(data) {
                            if(jQuery.type(data) == 'string' && data!='') {
                                $('.search-form').after(
                                    '<div class=error>'+data+'</div>'
                            );
                            $('.error').addClass('response-msg');
                            $('.error').addClass('ui-corner-all')
                            $('.error').fadeOut(5000);
                         }

                         $.fn.yiiGridView.update('grid'); //change my-grid to your grid's name
                    }
                    })
                        return false;
                    } else {
                        return false;
                        }
                    }";
    }

    public static function urlRouting($controller, $subController = '', $actionId = 'index', $params = array(), $SEPARATOR = '/')
    {
        $moduleId = '';
        $controllerId = $controller->id;
        if ($subController != '')
            $controllerId = $subController;

        if ($controller->module != null) {
            $moduleId = $controller->module->id;
            return Yii::app()->createUrl($moduleId . $SEPARATOR . $controllerId . $SEPARATOR . $actionId, $params);
        }
        return Yii::app()->createUrl($controllerId . $SEPARATOR . $actionId, $params);
    }

    public static function refreshGrid($gridName = 'grid')
    {
        return "js:function(){
                                        var url = $(this).attr('href');
                                        $.fn.yiiGridView.update('grid', {  //change my-grid to your grid's name
                                            type:'POST',
                                            url:$(this).attr('href'),
                                            success:function(data) {
                                              $.fn.yiiGridView.update('$gridName'); //change my-grid to your grid's name
                                            }
                                        })
                                        return false;
                                      }
                                    ";
    }

    /*
     * Cat dau mang va tra ve gia tri gia tri la mang cat. Mang ban dau bi thay doi gia tri
     *
     */

    public static function array_cut(&$inputArray)
    {
        if (empty($inputArray))
            return null;
        if (count($inputArray) > 0) {
            $slice = array_slice($inputArray, 0, 1);
            $inputArray = array_slice($inputArray, 1);
            return $slice[0];
        }
    }


    public static function array_create(&$targetArray, $dims, $value)
    {
        if (!empty($dims)) { // neu dims la mang da chieu
            foreach ($dims as $dim) {
                if (!isset($targetArray[$dim])) {
                    $targetArray[$dim] = array();
                }
                $targetArray = & $targetArray[$dim];
            }
            $targetArray = $value;
        } else
            // mang la mang rong. Chen vao phan tu cuoi.
            $targetArray[] = $value;
    }

    public static function array_getval($targetArray, $dims)
    {
        if (!empty($dims)) { // neu dims la mang da chieu
            foreach ($dims as $dim) {
                if (isset($targetArray[$dim])) {
                    $tmp = $targetArray[$dim];
                    $targetArray = $tmp;
                } else
                    return null; // khong tim thay dim

            }
        } else { // neu dims ko duoc la mang rong. Lay phan tu cuoi cung
            if ($dims == null)
                $tmp = $targetArray;
            else
                $tmp = array_pop($targetArray);
        }
        return (!empty($tmp)) ? $tmp : null;
    }

    public static function checkIsNull($var)
    {
        return ($var == null);
    }

    public static function array_clearitem(&$targetArray, $dims)
    {
        if (!empty($dims)) {
            // set null
            Helpers::array_create($targetArray, $dims, null);
            //recreate array without null item
            // print_r($targetArray);exit;
            $targetArray = Helpers::array_filter_null_items($targetArray);
        }
    }

    public static function array_filter_null_items($inputArray)
    {
        // If it is an element, then just return it
        if (!is_array($inputArray)) {
            return $inputArray;
        }

        $non_empty_items = array();

        foreach ($inputArray as $key => $value) {
            // Ignore empty cells
            if ($value) {
                // Use recursion to evaluate cells
                $non_empty_items[$key] = Helpers::array_filter_null_items($value);
            }
        }
        // Finally return the array without empty items
        return $non_empty_items;
    }

    /*
     * Dinh dang lai du lieu cua mang Items theo dang ['SP002']=>Array(30,4000),
     */

    public static function formatArray($inputArray)
    {
        $resultArray = array();
        foreach ($inputArray as $array) {
            $id = $array['id'];
            $arr = array();
            foreach ($array as $key => $value) {
                if ($key != 'ma_vach' && $key != 'id' && $key != 'ten_san_pham')
                    $arr[$key] = $value;
            }
            $resultArray[$id] = $arr;

        }
        return $resultArray;
    }


}