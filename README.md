ZfcTwitterBootstrap
===================
Version 0.2.1 Created by Mike Willbanks

Naming
------

This module is currently named *Zfc*TwitterBootstrap since the goal is to
ultimately get this into the ZF-Commons area.  Once this gets more to a
feature complete state, it will be submitted to a vote for ZF-Commons.
If the module does not make it, it will be renamed.

Introduction
------------

ZfcTwitterBootstrap is a module that attempts to handle Twitter Bootstrap
integration for Zend Framework 2.  Out of the box this presently includes
view helpers to render forms, alerts, badges and labels.  Overall this module
will continue to grow out the view helpers to assist in generating many of
the items that Twitter Bootstrap contains.

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (2.*)

Installation
------------
Your composer.json should include the following:

    {
        "require": {
            "mwillbanks/zfc-twitter-bootstrap": "@dev"
        }
    }

Enable the module in your `application.config.php` file:

    <?php
    return array(
        'modules' => array(
            // ...
            'ZfcTwitterBootstrap',
        ),
        // ...
    );
    

Features
--------
* Form Integration
  * FormRenderer
  * FormElement
  * FormDescription
* Navigation Integration
  * Breadcrumbs
  * Menu
* View Helpers
  * Alerts
  * Badges
  * CloseIcons
  * FlashMessages
  * Icons
  * Images
  * Labels
  * Wells

Roadmap
-------

* Zend\Form - Completed basic integration
* Alert Messages - Completed basic view helper
* Close Icons - Completed basic view helper
* Badges - Completed basic view helper
* FlashMessages - Completed basic view helper
* Icons - Completed basic view helper
* Image - Completed basic view helper
* Labels - Completed basic view helper
* Wells - Completed basic view helper
* Zend\Navigation - Completed basic integration

Form Usage
----------

    <?php
    // render a whole form
    echo $this->ztbForm($this->form);
    ?>


    <?php
    // render element by element
    $form = $this->form;
    $form->prepare();
    echo $this->form()->openTag($form);
    echo $this->ztbFormElement($this->form->get('element'));
    echo $this->form()->closeTag();
    ?>

Alert Usage
-----------

    <?php
    echo $this->ztbAlert('This is an alert');
    // additional parameters: block level and class
    echo $this->ztbAlert('This is an alert', true, 'warning');

    // explicit usage
    // explicit types: info, error, success, warning
    echo $this->ztbAlert()->warning('This is an alert');
    // explicit additional parameters: block level
    echo $this->ztbAlert()->warning('This is an alert');
    ?>

Badge Usage
-----------

    <?php
    echo $this->ztbBadge('This is a badge');
    // additional parameters: class
    echo $this->ztbBadge('This is a badge', 'info');

    // explicit usage
    // explicit types: info, important, inverse, success, warning
    echo $this->ztbBadge()->info('This is a badge');
    ?>
    
Close Icon Usage
----------------

    <?php
    echo $this->ztbCloseIcon();
    // or render an anchor
    echo $this->ztbCloseIcon('a');
    ?>
    
FlashMessenger Usage
--------------------

    <?php
    // controller/action
    // other types Info, Success, Error
    $this->flashMessenger()->addMessage(
        'User could not be saved due to a database error.'
    );
    
    // other options
    $this->flashMessenger()->addMessage(array(
        'message'  => 'User could not be saved due to a database error.',
        'title'    => 'Fatal Error!',
        'titleTag' => 'h4',
        'isBlock'  => true,
    );
    ?>
    
    <?php
    // view script
    // render all messages in all namespaces
    echo $this->ztbFlashMessenger()->render();
    
    // explicit usage
    // explicit types: default, info, success, error
    echo $this->ztbFlashMessenger('error');
    // or
    echo $this->ztbFlashMessenger()->render('info');
    ?>
    
Icon Usage
-----------

    <?php
    echo $this->ztbIcon('user');
    // additional parameters: color
    echo $this->ztbIcon('user', 'white');

    // explicit usage
    echo $this->ztbIcon()->user();
    echo $this->ztbIcon()->user('white');
    // icon names with dashes should be camel cased when using this method
    echo $this->ztbIcon()->plusSign();
    ?>
    
see [Twitter Botstrap Icons](http://twitter.github.com/bootstrap/base-css.html#icons) for available icons

Image Usage
-----------

    <?php
    echo $this->ztbImage('/path/to/img/img.png', 'circle');

    // explicit usage
    // explicit types: circle, rounded, polaroid
    echo $this->ztbImage()->polaroid('/path/to/img/img.png');
    ?>
    
Label Usage
-----------

    <?php
    echo $this->ztbLabel('This is a label');
    // additional parameters: class
    echo $this->ztbLabel('This is a label', 'info');

    // explicit usage
    // explicit types: info, important, inverse, success, warning
    echo $this->ztbLabel()->info('This is a label');
    ?>


Navigation Usage
----------------

    <?php
    echo $this->ztbnavigation()->ztbmenu($navContainer);
    echo $this->ztbnavigation()->ztbbreadcrumbs($navContainer);

Well Usage
-----------

    <?php
    echo $this->ztbWell('This is a well');
    // additional parameters: class
    echo $this->ztbWell('This is a large well', 'well-large');

    // explicit usage
    // explicit types: small, large
    echo $this->ztbWell()->small('This is a small well');
    ?>
