<?php
/**
 * ZfcTwitterBootstrap
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_View
 * @subpackage Helper
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\EscapeHtml;

/**
 * View Helper
 */
class FlashAlert extends AbstractHelper implements ServiceLocatorAwareInterface
{
	/**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var string Templates for the open/close/seperator for message tags
     */
    protected $messageCloseString     = '</div>';
    protected $messageOpenString     = '<div%s><button type="button" class="close" data-dismiss="alert">&times;</button>';
    protected $messageSeparatorString = '</div><div%s><button type="button" class="close" data-dismiss="alert">&times;</button>';
    
    /**
     * @var EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * @var PluginFlashMessenger
     */
    protected $pluginFlashMessenger;

    /**
     * @var array Default attributes for the open format tag
     */
    protected $classMessages = array(
        PluginFlashMessenger::NAMESPACE_INFO => 'alert alert-info',
        PluginFlashMessenger::NAMESPACE_ERROR => 'alert alert-error',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'alert alert-success',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'alert',
    );

    /**
     * Returns the flash messenges as a string
     *
     * @return string
     */
    public function __invoke()
    {
    	$messagesToPrint = '';
    	
    	// get messages from each namespace.
    	foreach ($this->classMessages as $namespace => $class) {
    		$messages = $this->getMessagesFromNamespace($namespace);
    		
    		if (count($messages) > 0) {
    			$messagesToPrint .= $this->render($messages, $namespace);
    		}
    	}
    	
    	return $messagesToPrint;
    }
    
    /**
     * Render Messages
     *
     * @param  string $namespace
     * @param  array  $classes
     * @return string
     */
    public function render(array $messages, $namespace)
    {
    	$escapeHtml = $this->getEscapeHtmlHelper();
    	$messagesToPrint = array();
    	
    	foreach($messages as $message) {
    		$messagesToPrint[] = $escapeHtml($message);
    	}
    	
    	if (empty($messagesToPrint)) {
    		return '';
    	}
    	
    	// Generate markup
    	$markup  = sprintf($this->messageOpenString, ' class="' . $this->classMessages[$namespace] . '"');
    	$markup .= implode(sprintf($this->messageSeparatorString, ' class="' . $this->classMessages[$namespace] . '"'), $messagesToPrint);
    	$markup .= $this->messageCloseString;
    	
    	return $markup;
    }

    /**
     * Proxy the flash messenger plugin controller
     *
     * @param  string $method
     * @param  array  $argv
     * @return mixed
     */
    public function __call($method, $argv)
    {
        $flashMessenger = $this->getPluginFlashMessenger();
        return call_user_func_array(array($flashMessenger, $method), $argv);
    }

    /**
     * Retrieve the escapeHtml helper
     *
     * @return EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->escapeHtmlHelper = $this->view->plugin('escapehtml');
        }

        if (!$this->escapeHtmlHelper instanceof EscapeHtml) {
            $this->escapeHtmlHelper = new EscapeHtml();
        }

        return $this->escapeHtmlHelper;
    }

    /**
     * Get the flash messenger plugin
     *
     * @return PluginFlashMessenger
     */
    public function getPluginFlashMessenger()
    {
        if (null === $this->pluginFlashMessenger) {
            $this->setPluginFlashMessenger(new PluginFlashMessenger());
        }

        return $this->pluginFlashMessenger;
    }

    /**
     * Set the flash messenger plugin
     *
     * @return FlashMessenger
     */
    public function setPluginFlashMessenger(PluginFlashMessenger $pluginFlashMessenger)
    {
        $this->pluginFlashMessenger = $pluginFlashMessenger;
        return $this;
    }

    /**
     * Set the service locator.
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return AbstractHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
