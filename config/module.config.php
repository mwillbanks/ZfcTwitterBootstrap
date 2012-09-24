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
                        'class' => 'inline-help',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formelementwrapper' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElementWrapper',
            'ztbformelementwrapper' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElementWrapper',
            'formrenderer' => 'ZfcTwitterBootstrap\Form\View\Helper\FormRenderer',
            'ztbformrenderer' => 'ZfcTwitterBootstrap\Form\View\Helper\FormRenderer',
            'formdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbformdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbalert' => 'ZfcTwitterBootstrap\View\Helper\Alert',
            'ztblabel' => 'ZfcTwitterBootstrap\View\Helper\Label',
            'ztbbadge' => 'ZfcTwitterBootstrap\View\Helper\Badge',
        ),
    ),
);
