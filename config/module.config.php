<?php
return array(
    'view_helpers' => array(
        'factories' => array(
            'formElementErrors' => function ($sm) {
                $fee = new \Zend\Form\View\Helper\FormElementErrors();
                $fee->setMessageCloseString('</li></ul>');
                $fee->setMessageOpenFormat('<ul%s><li>');
                $fee->setMessageSeparatorString('</li><li>');
                $fee->setAttributes(array(
                    'class' => 'help-inline',
                )); 
                return $fee;
            },  
        ),  
        'invokables' => array(
            'ztbalert'           => 'ZfcTwitterBootstrap\View\Helper\Alert',
            'ztbbadge'           => 'ZfcTwitterBootstrap\View\Helper\Badge',
        	'ztbflashmessenger'  => 'ZfcTwitterBootstrap\View\Helper\FlashMessenger',
            'ztbform'            => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbformdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbformelement'     => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            'ztbformrenderer'    => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbicon'            => 'ZfcTwitterBootstrap\View\Helper\Icon',
            'ztbimage'           => 'ZfcTwitterBootstrap\View\Helper\Image',
            'ztblabel'           => 'ZfcTwitterBootstrap\View\Helper\Label',
        ),  
    ),  
);
