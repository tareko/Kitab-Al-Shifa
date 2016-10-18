<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
 CakePlugin::loadAll(); // Loads all plugins at once

 // Enable the Dispatcher filters for plugin assets, and
 // CacheHelper.
 Configure::write('Dispatcher.filters', array(
 		'AssetDispatcher',
 		'CacheDispatcher'
 ));

 // Add logging configuration.
 CakeLog::config('debug', array(
 		'engine' => 'FileLog',
 		'types' => array('notice', 'info', 'debug'),
 		'file' => 'debug',
 ));
 CakeLog::config('error', array(
 		'engine' => 'FileLog',
 		'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
 		'file' => 'error',
 ));

 //Logs for trading accountability
 CakeLog::config('TradeRequest', array(
                'engine' => 'FileLog',
                'file' => 'trade_request',
 ));

 CakeLog::config('TradeComplete', array(
                'engine' => 'FileLog',
                'file' => 'trade_complete',
 ));


 //Load CakePdf
 CakePlugin::load('CakePdf', array(
 		'bootstrap' => true,
 		'routes' => true
 ));
 Configure::write('CakePdf', array(
 		'engine' => 'CakePdf.WkHtmlToPdf',
		'binary' => '/usr/bin/wkhtmltopdf',
 		'margin' => array(
 				'bottom' => 15,
 				'left' => 5,
 				'right' => 5,
 				'top' => 10
 		),
 		'orientation' => 'landscape',
 		'download' => true,
 		'pageSize' => 'Letter',
 ));

 /* Option to save OHIP numbers for patients when entering billing information
  * Note: Do not enable this unless you have a very, very secure system
  * as it compromises patient safety if in the public.
 */
 Configure::write('save_ohip', false);

 /* Option for total number of shifts a user is allowed to take per day in the
  * marketplace. Set this suitably high if you want no limit
  * Default: 3
  */
 Configure::write('marketplace_take_limit', 3);

 /* Time at which the take limit restarts (24 hour clock. Give only hour)
  *
  */
 Configure::write('marketplace_take_limit_restart', 12);

 /* Should the marketplace be available to users?
  * TODO: Make this setting web-adjustable
  *
  */
 Configure::write('marketplace_blind', true);