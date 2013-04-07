<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Label
 */
class Label extends AbstractHelper
{

    /**
     * @var string
     */
     protected $format = <<<FORMAT
<span class="label %s">%s</span>
FORMAT;

    /**
     * Display an Informational Label
     *
     * @param  string $label
     * @return string
     */
    public function info($label)
    {
        return $this->render($label, 'label-info');
    }

    /**
     * Display an Important Label
     *
     * @param  string $label
     * @return string
     */
    public function important($label)
    {
        return $this->render($label, 'label-important');
    }

    /**
     * Display an Inverse Label
     *
     * @param  string $label
     * @return string
     */
    public function inverse($label)
    {
        return $this->render($label, 'label-inverse');
    }

    /**
     * Display a Sucess Label
     *
     * @param  string $label
     * @return string
     */
    public function success($label)
    {
        return $this->render($label, 'label-success');
    }

    /**
     * Display a Warning Label
     *
     * @param  string $label
     * @return string
     */
    public function warning($label)
    {
        return $this->render($label, 'label-warning');
    }

    /**
     * Render an Label
     *
     * @param  string $label
     * @param  string $class
     * @return string
     */
    public function render($label, $class = '')
    {
        $class = trim($class);

        return sprintf($this->format, $class, $label);
    }

    /**
     * Invoke Label
     *
     * @param  string      $label
     * @param  string      $class
     * @return string|self
     */
    public function __invoke($label = null, $class = '')
    {
        if ($label) {
            return $this->render($label, $class);
        }

        return $this;
    }
}
