<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Form\View\Helper\FormElementErrors;

/**
 * Module Setup
 */
class Module implements AutoloaderProviderInterface
{
    /**
     * Get Config
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Set Autoloader Configuration
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Get View Helper Configuration
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'formElementErrors' => function ($sm) {
                    $fee = new FormElementErrors();
                    $fee->setMessageCloseString('</li></ul>');
                    $fee->setMessageOpenFormat('<ul%s><li>');
                    $fee->setMessageSeparatorString('</li><li>');
                    $fee->setAttributes(array(
                        'class' => 'help-inline',
                    ));

                    return $fee;
                },
            ),
        );
    }
}
