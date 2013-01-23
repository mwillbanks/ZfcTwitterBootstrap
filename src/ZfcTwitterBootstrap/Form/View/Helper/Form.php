<?php
/**
 * ZfcTwitterBootstrap
 *
 * @category ZfcTwitterBootstrap
 * @package ZfcTwitterBootstrap\View
 * @subpackage Helper
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use Traversable;
use Zend\Form\ElementInterface;
use Zend\Form\Form as ZendForm;
use Zend\Form\Fieldset;
use Zend\Form\View\Helper\Form as FormHelper;
use Zend\View\Helper\AbstractHelper;

/**
 * Form Renderer
 *
 * @category ZfcTwitterBootstrap
 * @package ZfcTwitterBootstrap\View
 * @subpackage Helper
 */
class Form extends AbstractHelper
{
    /**
     * @var Zend\View\Helper\Form
     */
    protected $formHelper;

    /**
     * @var ZfcTwitterBootstrap\View\Helper\FormElementWrapper
     */
    protected $formElementHelper;

    /**
     * Set Form Element Helper
     *
     * @param ZfcTwitterBootstrap\View\Helper\FormElement $helper
     * @return ZfcTwitterBootstrap\View\Helper\Form
     */
    public function setElementHelper(FormElement $helper)
    {
        $helper->setView($this->getView());
        $this->formElementHelper = $helper;
    }

    /**
     * Get Form Element Helper
     *
     * @return ZfcTwitterBootstrap\View\Helper\FormElement
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
     * @param Zend\Form\View\Helper\Form $form
     * @return Form
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
     * @return Zend\Form\View\Helper\Form
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
     * @param Zend\Form\Form $form
     * @return void
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
     * @param Traversable $fieldset
     * @return void
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
     * @param Zend\Form\Fieldset $fieldset
     * @return void
     */
    public function renderFieldset(Fieldset $fieldset)
    {
        $id = $fieldset->getAttribute('id') ?: $fieldset->getName();
        return '<fieldset id="fieldset-' . $id . '">'
            . $this->render($fieldset)
            . '</fieldset>';
    }
}
