<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
)));

// ini constant untuk folder upload gambar (absolute path)
defined('PUBLIC_ABSOLUTE_PATH')
    || define('PUBLIC_ABSOLUTE_PATH', realpath(dirname(__FILE__)));

defined('IMAGE_PATH') 
    || define('IMAGE_PATH', '/image/');

// cek db sqlite yang digunakan untuk menyimpan gambar
if (! file_exists(APPLICATION_PATH . '/db/image.db')) {
    include_once APPLICATION_PATH . '/db/dbScript.php';
    ImageDb::createDb(APPLICATION_PATH . '/db/image.db');
}

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();
