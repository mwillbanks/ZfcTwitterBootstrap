<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Well
 */
class Well extends AbstractHelper
{
    /**
     * @var string
     */
    protected $format = '<div class="well%s">%s</div>';

    /**
     * Invoke Well
     *
     * @param  string      $content
     * @param  string      $class
     * @return string|self
     */
    public function __invoke($content = '', $class = '')
    {
        if ($content) {
            return $this->render($content, $class);
        }

        return $this;
    }

    /**
     * Display a large well
     *
     * @param  string $content
     * @return string
     */
    public function large($content)
    {
        $class = 'well-large';

        return $this->render($content, $class);
    }

    /**
     * Display an small well
     *
     * @param  string $content
     * @return string
     */
    public function small($content)
    {
        $class = 'well-small';

        return $this->render($content, $class);
    }

    /**
     * Render the well
     *
     * @param  string $content
     * @param  string $class
     * @return string
     */
    public function render($content, $class = '')
    {
        $class = ' ' . trim($class);

        return sprintf($this->format, $class, $content);
    }
}
