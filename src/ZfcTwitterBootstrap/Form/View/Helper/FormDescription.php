<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * Form Description
 */
class FormDescription extends AbstractHelper
{
    /**
     * @var string wrapper for displaying block help
     */
    protected $blockWrapper = '<p class="help-block">%s</p>';

    /**
     * @var string wrapper for displaying inline help
     */
    protected $inlineWrapper = '<span class="help-inline">%s</span>';

    /**
     * Set Block Wrapper
     *
     * @param  string $blockWrapper
     * @return self
     */
    public function setBlockWrapper($blockWrapper)
    {
        $this->blockWrapper = (string) $blockWrapper;

        return $this;
    }

    /**
     * Get Block Wrapper
     *
     * @return string
     */
    public function getBlockWrapper()
    {
        return $this->blockWrapper;
    }

    /**
     * Set Inline wrapper
     *
     * @param  string $inlineWrapper
     * @return self
     */
    public function setInlineWrapper($inlineWrapper)
    {
        $this->inlineWrapper = (string) $inlineWrapper;

        return $this;
    }

    /**
     * Get Inline Wrapper
     *
     * @return string
     */
    public function getInlineWrapper()
    {
        return $this->inlineWrapper;
    }

    /**
     * Render
     *
     * @param  \Zend\Form\ElementInterface $element
     * @param  string                      $blockWrapper
     * @param  string                      $inlineWrapper
     * @return string
     */
    public function render(ElementInterface $element, $blockWrapper = null, $inlineWrapper = null)
    {
        $blockWrapper = $blockWrapper ?: $this->blockWrapper;
        $inlineWrapper = $inlineWrapper ?: $this->inlineWrapper;

        $html = '';
        if ($inline = $element->getOption('help-inline')) {
            $html .= sprintf($inlineWrapper, $inline);
        }
        if ($block = $element->getOption('help-block')) {
            $html .= sprintf($blockWrapper, $block);
        }

        return $html;
    }

    /**
     * Magical Invoke Method
     *
     * @param  \Zend\Form\ElementInterface $elemnet
     * @param  string                      $blockWrapper
     * @param  string                      $invokeWrapper
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null, $blockWrapper = null, $inlineWrapper = null)
    {
        if ($element) {
            return $this->render($element, $blockWrapper, $inlineWrapper);
        }

        return $this;
    }
}
