<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\Form\View\Helper;

use ZfcTwitterBootstrap\Form\View\Helper\FormElement;
use Zend\Form\ElementInterface;
use Zend\View\Model\ViewModel;
use Exception;

/**
 * Form Element
 */
class FormWysihtml5 extends FormElement
{   
    protected $toolbar = '<ul style="display:none" class="wysihtml5-toolbar">%s</ul>';
    
    protected $options = array(
        'cleanUp' => 'false',
        'toolbar' => array(
            'font-styles', // Font styling, e.g. h1, h2, etc.
            'edit', // undo, redo
            'justify', // left, center, right.
            'emphasis', // Italics, bold, etc.
            'lists', //(Un)ordered lists, e.g. Bullets, Numbers.
            'html', // Button which allows you to edit the generated HTML.
            'link', // Button to insert a link.
            'image', // Button to insert an image.
            //'color', // add text color requires wysiwyg-color.css
        ),
        'stylesheets' => array(
            '/css/bootstrap.min.css',
            '/css/style.css',
            //'/zfctb/css/wysihtml5/wysiwyg-color.css',
        ),
    );
    
    /**
     * Magical Invoke
     *
     * @param  \Zend\Form\ElementInterface $element
     * @param  array                       $options
     * @param  string                      $controlWrapper
     * @return string|self
     */
    public function __invoke(ElementInterface $element = null, $options = array(), $controlWrapper = null)
    {
        if ($element) {
            return $this->render($element, $options, $controlWrapper);
        }

        return $this;
    }
    
    /**
     * Render
     *
     * @param Zend\Form\ElementInterface $element
     * @param array $options
     * @param string $groupWrapper
     * @return string
     */
    public function render(ElementInterface $element, $options = array(), $groupWrapper = null)
    {
        if (!$element->getAttribute('id')) {
            throw new Exception('Form element id attribute needs to be set to use WYSIHTML5 text editor');
        }
        
        $scriptHelper = $this->view->plugin('headscript');
        $linkHelper = $this->view->plugin('headlink');
        $urlHelper = $this->view->plugin('url');
        $basePathHelper = $this->view->plugin('basepath');
        
        if(isset($options['toolbar'])) {
            $this->options['toolbar'] = $options['toolbar'];
        }
        
        if(isset($options['stylesheets'])) {
            $this->options['stylesheets'] = $options['stylesheets'];
        }
        
        $toolbar = '';
        
        foreach($this->options['toolbar'] as $btn)
        {
            $toolbar .= $this->getToolbarButton($btn);
        }
        
        $toolbar = sprintf($this->toolbar, $toolbar);
        
        $controlWrapper = '<div class="controls" id="controls-%s">'.$toolbar.'%s%s%s</div>';
        
        $scriptHelper()->prependFile($urlHelper('ZfcTwitterBootstrap/js', array(
            'namespace' => 'wysihtml5',
            'file' => 'bootstrap-wysihtml5.js'
        )));

        $scriptHelper()->prependFile($urlHelper('ZfcTwitterBootstrap/js', array(
            'namespace' => 'wysihtml5',
            'file' => 'wysihtml5-0.4.0-zfcTwitterBootstrap.js'
        )));
        
        $scriptHelper()->prependFile($urlHelper('ZfcTwitterBootstrap/js', array(
            'namespace' => 'wysihtml5',
            'file' => 'parser.rules.js'
        )));
        
        $linkHelper()->prependStylesheet($urlHelper('ZfcTwitterBootstrap/css', array(
            'namespace' => 'wysihtml5',
            'file' => 'bootstrap-wysihtml5.css'
        )));
        
        $editor = parent::render($element, $groupWrapper, $controlWrapper);
        
        $styles = '';
        
        foreach ($this->options['stylesheets'] as $style) {
            $styles .= '"' . $basePathHelper($style) . '"';
            $styles .= ',';
        }
        
        $styles = substr($styles, 0, -1);
        
        $script = <<<JS
$(document).ready(function(){
    $('#{$element->getAttribute('id')}').wysihtml5({
		cleanUp: {$this->options['cleanUp']}, 
		"stylesheets": [
            $styles
        ]
	});
});
JS;
        return $editor . '<script>'.$script.'</script>';
    }
    
    public function getToolbarButton($btnName)
    {
        $button = new ViewModel();
        $button->setTemplate('wysihtml5/'.$btnName);
        return $this->getView()->render($button);
    }
}