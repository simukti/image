<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Set PHPThumb class map loader
     * 
     * @return Zend_Loader_Autoloader
     */
    protected function _initPHPThumb()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->pushAutoloader(new Simukti_Loader_PhpThumb());
        return $loader;
    }

}
