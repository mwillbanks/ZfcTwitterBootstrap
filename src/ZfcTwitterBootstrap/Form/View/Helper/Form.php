<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Traversable;
use Zend\Form\ElementInterface;
use Zend\Form\Form as ZendForm;
use Zend\Form\Fieldset;
use Zend\Form\View\Helper\Form as FormHelper;
use Zend\View\Helper\AbstractHelper;

/**
 * Form
 */
class Form extends AbstractHelper
{
    /**
     * @var \Zend\View\Helper\Form
     */
    protected $formHelper;

    /**
     * @var FormElementWrapper
     */
    protected $formElementHelper;

    /**
     * Set Form Element Helper
     *
     * @param  FormElement $helper
     * @return self
     */
    public function setElementHelper(FormElement $helper)
    {
        $helper->setView($this->getView());
        $this->formElementHelper = $helper;
    }

    /**
     * Get Form Element Helper
     *
     * @return FormElement
     */
    public function getElementHelper()
    {
        if (!$this->formElementHelper) {
            $this->setElementHelper($this->view->plugin('ztbformelement'));
        }

        return $this->formElementHelper;
    }

    /**
     * Set Form Helper
     *
     * @param  \Zend\Form\View\Helper\Form $form
     * @return self
     */
    public function setFormHelper(FormHelper $form)
    {
        $form->setView($this->getView());
        $this->formHelper = $form;

        return $this;
    }

    /**
     * Get Form Helper
     *
     * @return \Zend\Form\View\Helper\Form
     */
    public function getFormHelper()
    {
        if (!$this->formHelper) {
            $this->setFormHelper($this->view->plugin('form'));
        }

        return $this->formHelper;
    }

    /**
     * Display a Form
     *
     * @param  \Zend\Form\Form $form
     * @return string
     */
    public function __invoke(ZendForm $form)
    {
        $form->prepare();
        $html = $this->getFormHelper()->openTag($form);
        $html .= $this->render($form->getIterator());

        return $html . $this->getFormHelper()->closeTag();
    }

    /**
     * Render the Form
     * Handles tranversable since we get a priority queue
     * or a fieldset which is basically an iterator.
     *
     * @param  \Traversable $fieldset
     * @return string
     */
    public function render(Traversable $fieldset)
    {
        $form = '';
        $elementHelper = $this->getElementHelper();
        foreach ($fieldset as $element) {
            if ($element instanceof Fieldset) {
                $form .= $this->renderFieldset($element);
            } elseif ($element instanceof ElementInterface) {
                $form .= $elementHelper->render($element);
            }
        }

        return $form;
    }

    /**
     * Render a Fieldset
     *
     * @param  \Zend\Form\Fieldset $fieldset
     * @return string
     */
    public function renderFieldset(Fieldset $fieldset)
    {
        $id = $fieldset->getAttribute('id') ?: $fieldset->getName();
        $class = $fieldset->getAttribute('class');
        $label = $fieldset->getLabel();
        if (!empty($label)) {
            $label = "<legend>$label</legend>";
        }

        return '<fieldset id="fieldset-' . $id . '" class="' . $class . '">'
            . $label
            . $this->render($fieldset)
            . '</fieldset>';
    }
}
