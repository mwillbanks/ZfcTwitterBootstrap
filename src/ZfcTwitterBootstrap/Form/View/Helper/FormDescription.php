<?php
/**
 * ZfcTwitterBootstrap
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_Form
 * @subpackage View
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * Form Description
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_Form
 * @subpackage View
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
     * @param string $blockWrapper
     * @return FormDescription
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
     * @param string $inlineWrapper
     * @return FormDescription
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
     * @param ElementInterface $elmenet
     * @param string $blockWrapper
     * @param string $inlineWrapper
     * @return string
     */
    public function render(ElementInterface $element, $blockWrapper = null, $inlineWrapper = null)
    {
        $blockWrapper = $blockWrapper ?: $this->blockWrapper;
        $inlineWrapper = $inlineWrapper ?: $this->inlineWrapper;

        $html = '';
        if ($inline = $element->getAttribute('help-inline')) {
            $html .= sprintf($inlineWrapper, $inline);
        }
        if ($block = $element->getAttribute('help-block')) {
            $html .= sprintf($blockWrapper, $block);
        }
        return $html;
    }

    /**
     * Magical Invoke Method
     *
     * @param ElementInterface $elemnet
     * @param string $blockWrapper
     * @param string $invokeWrapper
     * @return string|FormDescription
     */
    public function __invoke(ElementInterface $element = null, $blockWrapper = null, $inlineWrapper = null)
    {
        if ($element) {
            return $this->render($element, $blockWrapper, $inlineWrapper);
        }
        return $this;
    }
}
