<?php
return array(
    'di'              => array(
        'instance' => array(
            'Zend\Form\View\Helper\FormElementErrors' => array(
                'parameters' => array(
                    'messageCloseString' => '</span>',
                    'messageOpenFormat' => '<span%s>',
                    'messageSeparatorString' => '<br />',
                    'attributes' => array(
                        'class' => 'help-inline',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            // @deprecated
            'formelementwrapper' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            // @deprecated
            'ztbformelementwrapper' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            // @deprecated
            'formrenderer' => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            // @deprecated
            'ztbformrenderer' => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'formdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbformdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbalert' => 'ZfcTwitterBootstrap\View\Helper\Alert',
            'ztbform' => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbformelement' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            'ztblabel' => 'ZfcTwitterBootstrap\View\Helper\Label',
            'ztbbadge' => 'ZfcTwitterBootstrap\View\Helper\Badge',
        ),
    ),
);
