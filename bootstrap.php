<?php
/**
 * temporary file to load library.
 * TODO: remove it!!!!
 */

$exceptionBasePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR;
require_once($exceptionBasePath . 'BaseException.php');
$exceptionFiles = scandir($exceptionBasePath);
foreach ($exceptionFiles as $fileName) {
    if (preg_match('/.*.php/', $fileName)) {
        require_once($exceptionBasePath . $fileName);
    }
}
require_once('Thing.php');
require_once('World.php');