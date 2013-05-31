<?php
/**
 * User: ${Cristazn}
 * Date: 5/21/13
 * Time: 7:52 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

class CPOSRequireLogin extends CBehavior
{

    public function attach($owner)
    {
        $owner->attachEventHandler('onBeginRequest', array($this, 'handlerBeginRequest'));
    }

    public function handlerBeginRequest($event)
    {
        if (Yii::app()->user->isGuest && !in_array($_SERVER['REQUEST_URI'],array('/pos-project/source/site/login'))) {
            Yii::app()->request->redirect('/pos-project/source/site/login');
        }
    }

}