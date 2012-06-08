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
    'view_manager' => array(
        'helper_map' => array(
            'formelement' => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            'formrenderer' => 'ZfcTwitterBootstrap\Form\View\Helper\FormRenderer',
            'formdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
        ),
    ),
);
