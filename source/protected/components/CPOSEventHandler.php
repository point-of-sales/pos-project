<?php
/**
 * User: ${Cristazn}
 * Date: 4/18/13
 * Time: 9:44 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

/*
 * Lop cung cap cac Handler de xu ly cac Event
 */

class CPOSEventHandler  {

    function clearExportSession($event) {
        if(isset($event->currentSession))
            unset($event->currentSession);
    }
}