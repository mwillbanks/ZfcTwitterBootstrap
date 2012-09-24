<?php
/**
 * ZfcTwitterBootstrap
 *
 * @category ZfcTwitterBootstrap
 * @package ZfcTwitterBootstrap\View
 * @subpackage Helper
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\View\Helper\EscapeHtml;

/**
 * Form Element
 *
 * @category ZfcTwitterBootstrap
 * @package ZfcTwitterBootstrap\View
 * @subpackage Helper
 */
class FormElementWrapper extends FormElement
{
    /**
     * @var Zend\Form\View\Helper\FormLabel
     */
    protected $labelHelper;

    /**
     * @var Zend\Form\View\Helper\FormElement
     */
    protected $elementHelper;

    /**
     * @var Zend\View\Helper\EscapeHtml
     */
    protected $escapeHelper;

    /**
     * @var Zend\Form\View\Helper\FormElementErrors
     */
    protected $elementErrorHelper;

    /**
     * @var ZfcTwitterBootstrap\Form\View\Helper\FormDescription
     */
    protected $descriptionHelper;

    /**
     * @var string
     */
    protected $groupWrapper = '<div class="control-group%s" id="control-group-%s">%s</div>';

    /**
     * @var string
     */
    protected $controlWrapper = '<div class="controls" id="controls-%s">%s%s%s</div>';

    /**
     * Set Label Helper
     *
     * @param Zend\Form\View\Helper\FormLabel $labelHelper
     * @return FormElement
     */
    public function setLabelHelper(FormLabel $labelHelper)
    {
        $labelHelper->setView($this->getView());
        $this->labelHelper = $labelHelper;
        return $this;
    }

    /**
     * Get Label Helper
     *
     * @return Zend\Form\View\Helper\FormLabel
     */
    public function getLabelHelper()
    {
        if (!$this->labelHelper) {
            $this->setLabelHelper($this->view->plugin('formlabel'));
        }
        return $this->labelHelper;
    }

    /**
     * Set EscapeHtml Helper
     * 
     * @param Zend\View\Helper\EscapeHtml $escapeHelper
     * @return FormElement
     */
    public function setEscapeHtmlHelper(EscapeHtml $escapeHelper)
    {
        $escapeHelper->setView($this->getView());
        $this->escapeHelper = $escapeHelper;
        return $this;
    }

    /**
     * Get EscapeHtml Helper
     *
     * @return Zend\View\Helper\EscapeHtml
     */
    public function getEscapeHtmlHelper()
    {
        if (!$this->escapeHelper) {
            $this->setEscapeHtmlHelper($this->view->plugin('escapeHtml'));
        }
        return $this->escapeHelper;
    }

    /**
     * Set Element Helper
     *
     * @param Zend\Form\View\Helper\FormElement $elementHelper
     * @return FormElement
     */
    public function setElementHelper(FormElement $elementHelper)
    {
        $elementHelper->setView($this->getView());
        $this->elementHelper = $elementHelper;
        return $this;
    }

    /**
     * Get Element Helper
     *
     * @return Zend\Form\View\Helper\FormElement
     */
    public function getElementHelper()
    {
        if (!$this->elementHelper) {
            $this->setElementHelper($this->view->plugin('formElement'));
        }
        return $this->elementHelper;
    }

    /**
     * Set Element Error Helper
     *
     * @param Zend\Form\View\Helper\FormElementErrors $errorHelper
     * @return FormElement
     */
    public function setElementErrorHelper(FormElementErrors $errorHelper)
    {
        $errorHelper->setView($this->getView());
        $this->elementErrorHelper = $errorHelper;
        return $this;
    }

    /**
     * Get Element Error Helper
     *
     * @return Zend\Form\View\Helper\FormElementErrors
     */
    public function getElementErrorHelper()
    {
        if (!$this->elementErrorHelper) {
            $this->setElementErrorHelper($this->view->plugin('formElementErrors'));
        }
        return $this->elementErrorHelper;
    }

    /**
     * Set Description Helper
     *
     * @param ZfcTwitterBootstrap\Form\View\Helper\FormDescription
     * @return FormElement
     */
    public function setDescriptionHelper(FormDescription $descriptionHelper)
    {
        $descriptionHelper->setView($this->getView());
        $this->descriptionHelper = $descriptionHelper;
        return $this;
    }

    /**
     * Get Description Helper
     *
     * @return ZfcTwitterBootstrap\Form\View\Helper\FormDescription
     */
    public function getDescriptionHelper()
    {
        if (!$this->descriptionHelper) {
            $this->setDescriptionHelper($this->view->plugin('formDescription'));
        }
        return $this->descriptionHelper;
    }

    /**
     * Set Group Wrapper
     *
     * @param string $groupWrapper
     * @return FormElement
     */
    public function setGroupWrapper($groupWrapper)
    {
        $this->groupWrapper = (string) $groupWrapper;
        return $this;
    }

    /**
     * Get Group Wrapper
     *
     * @return string
     */
    public function getGroupWrapper()
    {
        return $this->groupWrapper;
    }

    /**
     * Set Control Wrapper
     *
     * @param string $controlWrapper;
     * @return FormElement
     */
    public function setControlWrapper($controlWrapper)
    {
        $this->controlWrapper = (string) $controlWrapper;
        return $this;
    }

    /**
     * Get Control Wrapper
     *
     * @return string
     */
    public function getControlWrapper()
    {
        return $this->controlWrapper;
    }

    /**
     * Render
     *
     * @param Zend\Form\ElementInterface $element
     * @param string $groupWrapper
     * @param string $controlWrapper
     * @return string
     */
    public function render(ElementInterface $element, $groupWrapper = null, $controlWrapper = null)
    {
        $labelHelper = $this->getLabelHelper();
        $escapeHelper = $this->getEscapeHtmlHelper();
        $elementHelper = $this->getElementHelper();
        $elementErrorHelper = $this->getElementErrorHelper();
        $descriptionHelper = $this->getDescriptionHelper();
        $groupWrapper = $groupWrapper ?: $this->groupWrapper;
        $controlWrapper = $controlWrapper ?: $this->controlWrapper;

        $id = $element->getAttribute('id') ?: $element->getAttribute('name');
        $html = "";

        $label = $element->getAttribute('label');
        if ($label) {
            $html .= $labelHelper->openTag(array(
                'for' => $id,
                'class' => 'control-label',
            ));
            // todo allow for not escaping the label
            $html .= $escapeHelper($label);
            $html .= $labelHelper->closeTag();
        }

        $elementHelper->getView()->plugin('form_radio')->setLabelAttributes(array(
            'class' => $element->getAttribute('type'),
        ));

        $html .= sprintf($controlWrapper,
            $id,
            $elementHelper->render($element),
            $descriptionHelper->render($element),
            $elementErrorHelper->render($element)
        );

        $addtClass = ($element->getMessages()) ? ' error' : '';
        return sprintf($groupWrapper, $addtClass, $id, $html);
    }

    /**
     * Magical Invoke
     *
     * @param Zend\Form\ElementInterface $element
     * @param string $groupWrapper
     * @param string $controlWrapper
     * @return string|FormElement
     */
    public function __invoke(ElementInterface $element = null, $groupWrapper = null, $controlWrapper = null)
    {
        if ($element) {
            return $this->render($element, $groupWrapper, $controlWrapper);
        }
        return $this;
    }
}
