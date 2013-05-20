<?php

Yii::import('application.modules.quanlyphanquyen.RightsModule');

class QuanlyphanquyenModule extends RightsModule
{

    private $_assetsUrl;
    public $appLayout = 'webroot.themes.asia.views.layouts.main';

    public function init()
    {
        // Set required classes for import.
        $this->setImport(array(
            'quanlyphanquyen.components.*',
            'quanlyphanquyen.components.behaviors.*',
            'quanlyphanquyen.components.dataproviders.*',
            'quanlyphanquyen.controllers.*',
            'quanlyphanquyen.models.*',
        ));

        // Set the required components.
        $this->setComponents(array(
            'authorizer' => array(
                'class' => 'RAuthorizer',
                'superuserName' => $this->superuserName,
            ),
            'generator' => array(
                'class' => 'RGenerator',
            ),
        ));

        // Normally the default controller is Assignment.
        $this->defaultController = 'assignment';

        // Set the installer if necessary.
        if ($this->install === true) {
            $this->setComponents(array(
                'installer' => array(
                    'class' => 'RInstaller',
                    'superuserName' => $this->superuserName,
                    'authenticatedName' => $this->authenticatedName,
                    'guestName' => Yii::app()->user->guestName,
                    'defaultRoles' => Yii::app()->authManager->defaultRoles,
                ),
            ));

            // When installing we need to set the default controller to Install.
            $this->defaultController = 'install';
        }
    }

    public function getAssetsUrl()
    {
        if( $this->_assetsUrl===null )
        {
            $assetsPath = Yii::getPathOfAlias('quanlyphanquyen.assets');

            // We need to republish the assets if debug mode is enabled.
            if( $this->debug===true )
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
            else
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }

        return $this->_assetsUrl;
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    public function registerCss($file, $media='all')
    {
        $href = $this->getAssetsUrl().'/css/'.$file;
        return '<link rel="stylesheet" type="text/css" href="'.$href.'" media="'.$media.'" />';
    }

    public function registerImage($file)
    {
        return $this->getAssetsUrl().'/images/'.$file;
    }

}
