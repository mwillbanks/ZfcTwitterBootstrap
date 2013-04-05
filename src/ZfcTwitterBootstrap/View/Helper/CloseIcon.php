<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Close Icon
 */
class CloseIcon extends AbstractHelper
{

    const TYPE_BUTTON = 'button';
    const TYPE_ANCOR  = 'a';

    /**
     * Invoke CloseIcon
     *
     * @param  string $type
     * @return string
     */
    public function __invoke($type = self::TYPE_BUTTON)
    {
        if ('button' === self::TYPE_BUTTON) {
            return '<button class="close">&times;</button>';
        }

        if ('a' === self::TYPE_ANCOR) {
            return '<a class="close" href="#">&times;</a>';
        }

        return '';
    }
}
