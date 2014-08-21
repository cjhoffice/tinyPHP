<?php if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
/**
 *
 * AutoLoad
 *  
 * PHP 5
 *
 * tinyPHP(tm) : Simple & Lightweight MVC Framework (http://tinyphp.us/)
 * Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, 7 Media Web Solutions, LLC (http://www.7mediaws.org/)
 * @link http://tinyphp.us/ tinyPHP(tm) Project
 * @since tinyPHP(tm) v 0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

require( SYS_PATH . DS . 'Classes' . DS . 'Autoloader.php');

$loader = new \tinyPHP\Classes\Autoloader('tinyPHP\Classes',BASE_PATH);
$loader->register();

if(file_exists(SYS_PATH . 'Config/constants.php')) {
    require(SYS_PATH . 'Config/constants.php');
}

/**
 * Helper configuration to load default and custom
 * helper functions.
 */
\tinyPHP\Classes\Libraries\Util::_require( SYS_PATH . 'Config/helper.php' );

/** 
 * Errors are written to a log file as 
 * well as the database.
 */
error_reporting( E_ALL & ~E_NOTICE );
ini_set('display_errors','Off');
ini_set('log_errors', 'On');
ini_set('error_log', BASE_PATH . 'tmp' . DS . 'logs' . DS . 'error.' . date('m-d-Y') . '.txt');

/** Internationalization settings */
$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;
putenv('LC_MESSAGES='.$locale);

/* gettext setup */
T_setlocale(LC_MESSAGES, $locale);

/** Set the text domain as 'tinyPHP' */
$domain = 'tinyPHP';
T_bindtextdomain($domain, LOCALE_DIR);

/** bind_textdomain_codeset is supported only in PHP 4.2.0+ */
T_bind_textdomain_codeset($domain, ENCODING);
T_textdomain($domain);