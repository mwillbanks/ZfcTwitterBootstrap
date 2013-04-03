<?php
/**
 * ZfcTwitterBootstrap
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_View
 * @subpackage Helper
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Close Icon
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_View
 * @subpackage Helper
 */
class CloseIcon extends AbstractHelper
{   
    /**
     * Invoke CloseIcon
     *
     * @param string $type
     * @return string
     */
    public function __invoke($type = 'button')
    {
        if ('button' === $type) {
            return '<button class="close">&times;</button>';
        }
        
        if ('a' === $type) {
            return '<a class="close" href="#">&times;</a>';
        }
        
        return '';
    }
}
