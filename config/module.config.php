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
            'ztbformrenderer'    => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbformdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbalert'           => 'ZfcTwitterBootstrap\View\Helper\Alert',
            'ztbform'            => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbformelement'     => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            'ztblabel'           => 'ZfcTwitterBootstrap\View\Helper\Label',
            'ztbbadge'           => 'ZfcTwitterBootstrap\View\Helper\Badge',
        	'ztbflashmessenger'  => 'ZfcTwitterBootstrap\View\Helper\FlashMessenger',
        ),  
    ),  
);
