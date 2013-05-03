<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\I18n\Translator\Translator;

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
     * Get Service Configuration
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'formElementErrors' => function ($sm) {
                    $fee = new \Zend\Form\View\Helper\FormElementErrors();
                    $fee->setMessageCloseString('</li></ul>');
                    $fee->setMessageOpenFormat('<ul%s><li>');
                    $fee->setMessageSeparatorString('</li><li>');
                    $fee->setAttributes(array(
                        'class' => 'help-inline',
                    ));

                    return $fee;
                },
                'ztbTranslate' => function($sm) {
                    // Configure the translator
                    $config = $sm->get('config');
                    $translator = Translator::factory($config['ztbtranslator']);
                       
                    // accept languages
                    // from browser if language not supported then the locale setting
                    // set in the module config will be used.
                    $acceptLanguage = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                    $langDir = $config['ztbtranslator']['translation_file_patterns'][0]['base_dir'];
                    
                    if(is_file($langDir.'/'.$acceptLanguage.'.php')) {
                        $translator->setLocale($acceptLanguage);
                    }
                    
                    // and fall back to english.
                    $translator->setFallbackLocale('en');
                    
                    return $translator;
                },
            ),
        );
    }
}
