<?php
/**
 * File ini adalah bagian dari pustaka yang ditulis oleh Sarjono Mukti Aji. 
 */

/**
 * Description of PHPThumb
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 * @copyright Copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net>
 */
class Simukti_Loader_PhpThumb implements Zend_Loader_Autoloader_Interface
{
    protected $_class_map = array(
        'GdThumb'         => 'GdThumb.inc.php',
        'PhpThumb'        => 'PhpThumb.inc.php',
        'ThumbBase'       => 'ThumbBase.inc.php',  
        'PhpThumbFactory' => 'ThumbLib.inc.php',
        'GdReflectionLib' => 'thumb_plugins/gd_reflection.inc.php',
    );
    
    /**
     * @see Zend_Loader_Autoloader_Interface::autoload()
     * @link http://blog.montmere.com/2010/12/26/autoload-phpthumb-with-zend-framework/
     */
    public function autoload($class)
    {
        $file = APPLICATION_PATH . '/../library/PhpThumb/' . $this->_class_map[$class];
        if (is_file($file)) {
            require_once($file);
            return $class;
        }
        return false;
    }
}
