<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 */

namespace ZfcTwitterBootstrap\View\Helper\Navigation;

use Zend\View\Helper\Navigation;

/**
 * Plugin manager implementation for navigation helper in Twitter Bootstrap.
 *
 * Enforces that helpers retrieved are instances of
 * Navigation\HelperInterface. Additionally, it registers a number of default
 * helpers.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 */
class PluginManager extends Navigation\PluginManager {

	/**
	 * Default set of helpers
	 *
	 * @var array
	 */
	protected $invokableClasses = array(
		'nav' => 'ZfcTwitterBootstrap\View\Helper\Navigation\Nav',
	);

}
