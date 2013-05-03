<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZfcTwitterBootstrap\I18n\View\Helper;

use Zend\I18n\View\Helper\Translate;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * View helper for translating messages.
 */
class ZtbTranslate extends Translate implements ServiceLocatorAwareInterface
{
    /**
     * Text Domain
     * 
     * @var string
     */
    protected $translatorTextDomain = 'ZfcTwitterBootstrap';
    
    /**
     * Translate a message.
     *
     * @param  string $message
     * @return string
     */
    public function __invoke($message)
    {
        $translator = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('ztbTranslate');
        
        $this->setTranslator($translator);
        
        return parent::__invoke($message);
    }
    
    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CustomHelper
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
    
    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
