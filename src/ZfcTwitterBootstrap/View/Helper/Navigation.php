<?php

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\View\Helper;

/**
 * Proxy helper for retrieving navigational helpers and forwarding calls
 *
 * @category   ZfcTwitterBootstrap
 * @package    Zend_View
 * @subpackage Helper
 */
class Navigation extends Helper\Navigation {

	/**
	 * View helper namespace
	 *
	 * @var string
	 */
	const NS = 'ZfcTwitterBootstrap\View\Helper\Navigation';

	/**
	 * @var Navigation\PluginManager
	 */
	protected $plugins;

	/**
	 * Default proxy to use in {@link render()}
	 *
	 * @var string
	 */
	protected $defaultProxy = 'nav';

	/**
	 * Retrieve plugin loader for navigation helpers
	 *
	 * Lazy-loads an instance of Navigation\HelperLoader if none currently
	 * registered.
	 *
	 * @return Navigation\PluginManager
	 */
	public function getPluginManager() {
		if (null === $this->plugins) {
			$this->setPluginManager(new Navigation\PluginManager());
		}
		return $this->plugins;
	}

}