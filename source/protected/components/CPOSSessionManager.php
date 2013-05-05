<?php
/**
 * User: ${Cristazn}
 * Date: 4/28/13
 * Time: 3:06 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

class CPOSSessionManager extends CHttpSession
{
    /* Cach dung :
     * Day la lop duoc dung thay cho session chuan cua Yii Framework - do Yii Framework ko ho tro kieu
     * truy xuat mang da chieu dang Yii::app()->session['foo']['bar']['abc'].....
     * Quy dinh $key => array()
     * Trong do $key : category key
     * array mang gia tri can dua vao cho key.
     * array co the la 1 gia tri hoac 1 mang da chieu gia tri
     * VD : Yii::app->CPOSSessionManager->setItem('key1',$item,array['foo']['bar']['abc']);
     * $key : key1 (string).
     * array['foo']['bar']['abc'] : mang 3 chieu.
     * Vi the tong cong ta co mang 4 chieu(bao gom ca key)
     */

    /*
     * Add item vao mot $key co san.
     */

    public function setItem($key, $item, $dims=array())
    {
        if (!empty($key)) {
            $elem = $this->get($key);
            if ($elem == null) {
                $elem = array();
            }
            if(is_array($dims))
                Helpers::array_create($elem,$dims,$item);
            else {
                // dims la kieu du lieu index number
                if(isset($dims))
                    $elem[$dims] = $item;
                else
                    $elem = $item;
            }
            $this->add($key, $elem);
        }
    }
    /*
     * Lay item tu trong 1 $key voi so chieu duoc quy dinh dang $dims = array('foo','bar','avs') hoac $dims = 0,1,2 ....
     * Day la phuong thuc ho tro de lay chi tiet ben trong cua 1 $key vi Yii khong ho tro
     */
    public function getItem($key, $dims = array())
    {
        if (!empty($key)) {
            $elem = $this->get($key);
            if ($elem != null) {
                if(is_array($dims))
                    return Helpers::array_getval($elem,$dims);
                else
                    return $elem[$dims];
            }
        } else
            return null;
    }

    /*
     * Xoa du lieu o 1 key nao do. Xoa tat ca trong $key
     */

    public function clearKey($key)
    {
        if (!empty($key)) {
            $result = parent::remove($key);
        }
    }

    /*
     * Xoa item trong $key.
     */

    public function clearItem($key, $dims=array()) {
        if(!empty($key)) {
            $elem = $this->get($key);
            if(is_array($dims))
                Helpers::array_clearitem($elem,$dims);
            else
                unset($elem[0][$dims]);
        }
        $this->add($key,$elem);
    }

    /*
     * Xoa tat ca du lieu
     */

    public function clearAll()
    {
        parent::clear();
    }

    public function isEmpty($key)
    {
        if (!empty($key)) {
            $ret = parent::get($key);
            return ($ret=== null || array_filter($ret) === array());
        }
    }


}