<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Image
 */
class Image extends AbstractHelper
{
    /**
     * @var string
     */
    protected $format = '<img src="%s" class="img-%s">';

    /**
     * Display an rounded image
     *
     * @param  string $src
     * @return string
     */
    public function rounded($src)
    {
        return $this->render($src, 'rounded');
    }

    /**
     * Display an circle image
     *
     * @param  string $src
     * @return string
     */
    public function circle($src)
    {
        return $this->render($src, 'circle');
    }

    /**
     * Display an polariod image
     *
     * @param  string $src
     * @return string
     */
    public function polaroid($src)
    {
        return $this->render($src, 'polaroid');
    }

    /**
     * Render the image
     *
     * @param  string $src
     * @param  string $class
     * @return string
     */
    public function render($src, $class = '')
    {
        $basePath = $this->view->plugin('basePath');
        $class = trim($class);

        return sprintf($this->format, $basePath($src), $class);
    }

    /**
     * Invoke Image
     *
     * @param  string      $src
     * @param  string      $class
     * @return string|self
     */
    public function __invoke($src = '', $class = '')
    {
        if ($src && $class) {
            return $this->render($src, $class);
        }

        return $this;
    }
}
