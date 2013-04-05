<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\View\Helper\AbstractHelper;

/**
 * Helper to proxy the plugin flash messenger
 */
class FlashMessenger extends AbstractHelper
{
    /**
     * @var string
     */
    protected $titleFormat = '<%s>%s </%s>';

    /**
     * @var Alert
     */
    protected $alertHelper;

    /**
     * @var \Zend\View\Helper\EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * @var \Zend\Mvc\Controller\Plugin\FlashMessenger
     */
    protected $pluginFlashMessenger;

    /**
     * @var array Default attributes for the open format tag
     */
    protected $classMessages = array(
        PluginFlashMessenger::NAMESPACE_INFO    => 'info',
        PluginFlashMessenger::NAMESPACE_ERROR   => 'error',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'success',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'warning',
    );

    /**
     * @var array An array of allowed title tags
     */
    protected $allowedTags = array(
        'h1','h2','h3','h4','h5','h6','b','strong'
    );

    /**
     * Returns the flash messenges as a string
     *
     * @return self|string
     */
    public function __invoke($namespace = null)
    {
        if (null === $namespace) {
            return $this;
        }

        return $this->render($namespace);
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
     * Render Messages
     *
     * @param  array  $namespace
     * @return string
     */
    public function render($namespace = null)
    {
        $messagesToPrint = '';

        // get messages from each namespace.
        if (null === $namespace) {
            foreach ($this->classMessages as $namespace => $class) {
                $messagesToPrint .= $this->fetchMessagesFromNamespace($namespace);
            }
        } else {
            $messagesToPrint .= $this->fetchMessagesFromNamespace($namespace);
        }

        return $messagesToPrint;
    }

    /**
     * Gets messages from flash messenger plugin namespace
     *
     * @param  string $namespace
     * @return string
     */
    protected function fetchMessagesFromNamespace($namespace)
    {
        $this->setNamespace($namespace);

        if ($this->hasMessages()) {
            $messages = $this->getMessagesFromNamespace($namespace);
            // reset namespace
            $this->setNamespace();

            return $this->buildMessage($namespace, $messages);
        }

        return '';
    }

    /**
     * Build the message
     *
     * @param  string       $namespace
     * @param  array|string $messages
     * @return string
     */
    protected function buildMessage($namespace, $messages)
    {
        $escapeHtml = $this->getEscapeHtmlHelper();
        $messagesToPrint = array();

        foreach ($messages as $message) {

            if (is_array($message)) {

                $isBlock = (isset($message['isBlock'])) ? true : false;

                if (isset($message['title'])) {
                    $title = $escapeHtml($message['title']);
                }

                if (isset($message['titleTag']) &&
                in_array($message['titleTag'], $this->allowedTags)) {
                    $titleTag = $escapeHtml($message['titleTag']);
                } else {
                    $titleTag = ($isBlock) ? 'h4' : 'strong';
                }

                $messagesToPrint[] = $this->getAlert(
                        $namespace,
                        $escapeHtml($message['message']),
                        $title,
                        $titleTag,
                        $isBlock
                );
            } else {
                $messagesToPrint[] = $this->getAlert(
                        $namespace,
                        $escapeHtml($message)
                );
            }
        }

        // Generate markup string
        $markup = implode(PHP_EOL, $messagesToPrint);

        return $markup;
    }

    /**
     * Get the alert string
     *
     * @param  string $namespace
     * @return string $alert
     */
    protected function getAlert($namespace, $message, $title = null, $titleTag = 'h4', $isBlock = false)
    {
        $namespace = $this->classMessages[$namespace];

        $html = ($title) ? sprintf($this->titleFormat, $titleTag, $title, $titleTag) : '';
        $html .= $message . PHP_EOL;

        $alert = $this->getAlertHelper()->$namespace($html, $isBlock);

        return $alert;
    }

    /**
     * Retrieve the alert helper
     *
     * @return Alert
     */
    protected function getAlertHelper()
    {
        if ($this->alertHelper) {
            return $this->alertHelper;
        }

        $this->alertHelper = $this->view->plugin('ztbalert');

        return $this->alertHelper;
    }

    /**
     * Retrieve the escapeHtml helper
     *
     * @return \Zend\View\Helper\EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }

        $this->escapeHtmlHelper = $this->view->plugin('escapehtml');

        return $this->escapeHtmlHelper;
    }

    /**
     * Retrieve the flash messenger plugin
     *
     * @return \Zend\Mvc\Controller\Plugin\FlashMessenger
     */
    public function getPluginFlashMessenger()
    {
        if ($this->pluginFlashMessenger) {
            return $this->pluginFlashMessenger;
        }

        $this->pluginFlashMessenger = new PluginFlashMessenger();

        return $this->pluginFlashMessenger;
    }
}
