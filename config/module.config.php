<?php

return array(
    'view_helpers' => array(
        'invokables' => array(
            'ztbalert'           => 'ZfcTwitterBootstrap\View\Helper\Alert',
            'ztbbadge'           => 'ZfcTwitterBootstrap\View\Helper\Badge',
            'ztbcloseicon'       => 'ZfcTwitterBootstrap\View\Helper\CloseIcon',
        	'ztbflashmessenger'  => 'ZfcTwitterBootstrap\View\Helper\FlashMessenger',
            'ztbform'            => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbformdescription' => 'ZfcTwitterBootstrap\Form\View\Helper\FormDescription',
            'ztbformelement'     => 'ZfcTwitterBootstrap\Form\View\Helper\FormElement',
            'ztbformrenderer'    => 'ZfcTwitterBootstrap\Form\View\Helper\Form',
            'ztbicon'            => 'ZfcTwitterBootstrap\View\Helper\Icon',
            'ztbimage'           => 'ZfcTwitterBootstrap\View\Helper\Image',
            'ztblabel'           => 'ZfcTwitterBootstrap\View\Helper\Label',
            'ztbwell'            => 'ZfcTwitterBootstrap\View\Helper\Well',
            'ztbformwysihtml5'   => 'ZfcTwitterBootstrap\Form\View\Helper\FormWysihtml5',
            'ztbtranslate'       => 'ZfcTwitterBootstrap\I18n\View\Helper\ZtbTranslate',
        ),  
    ),
    'controllers' => array(
        'invokables' => array(
            'ZfcTwitterBootstrap\Controller\Assets' => 'ZfcTwitterBootstrap\Controller\AssetsController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'wysihtml5/color'       => __DIR__ . '/../view/wysihtml5/buttons/color.phtml',
            'wysihtml5/edit'        => __DIR__ . '/../view/wysihtml5/buttons/edit.phtml',
            'wysihtml5/emphasis'    => __DIR__ . '/../view/wysihtml5/buttons/emphasis.phtml',
            'wysihtml5/font-styles' => __DIR__ . '/../view/wysihtml5/buttons/font-styles.phtml',
            'wysihtml5/html'        => __DIR__ . '/../view/wysihtml5/buttons/html.phtml',
            'wysihtml5/image'       => __DIR__ . '/../view/wysihtml5/buttons/image.phtml',
            'wysihtml5/html'        => __DIR__ . '/../view/wysihtml5/buttons/html.phtml',
            'wysihtml5/justify'     => __DIR__ . '/../view/wysihtml5/buttons/justify.phtml',
            'wysihtml5/link'        => __DIR__ . '/../view/wysihtml5/buttons/link.phtml',
            'wysihtml5/lists'       => __DIR__ . '/../view/wysihtml5/buttons/lists.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ZfcTwitterBootstrap' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/zfctb',
                    'defaults' => array(
                        'controller' => 'ZfcTwitterBootstrap\Controller\Assets',                
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'css' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/css[/:namespace[/:file]]',
                            'constraints' => array(
                                'namespace' => '[a-zA-Z][a-zA-Z0-9._-]*',
                                'file' => '[a-zA-Z][a-zA-Z0-9._-]*',
                            ),
                            'defaults' => array(
                                'action' => 'load-css',                
                            ),
                        ),
                    ),
                    'js' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/js[/:namespace[/:file]]',
                            'constraints' => array(
                                'namespace' => '[a-zA-Z][a-zA-Z0-9._-]*',
                                'file' => '[a-zA-Z][a-zA-Z0-9._-]*',
                            ),
                            'defaults' => array(
                                'action' => 'load-js',                
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'ztbtranslator' => array(
        'locale' => 'en',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
                'text_domain' => 'ZfcTwitterBootstrap',
            ),
        ),
    ),
);
