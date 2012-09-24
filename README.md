ZfcTwitterBootstrap
===================
Version 0.2.0 Created by Mike Willbanks

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
Your composer.json should include the following. 

	{
	"repositories": [
	        {
	            "type": "package",
	            "package": {
	                "version": "master",
	                "name": "ZfcTwitterBootstrap",
	                "source": {
	                    "type": "git",
	                    "url": "https://github.com/mwillbanks/ZfcTwitterBootstrap",
	                    "reference": "master"
	                } 
	            }

	        }
	    ],
		"require": {
		        "ZfcTwitterBootstrap": "master"
		    }
    }
 

Features
--------
* Form Integration
  * FormRenderer
  * FormElement
  * FormDescription
* View Helpers
  * Alerts
  * Badges
  * Labels

Roadmap
-------

* Zend\Form - Completed basic integration
* Alert Messages - Completed basic view helper
* Badges - Completed basic view helper
* Labels - Completed basic view helper
* Zend\Navigation - See current pull request.

Form Usage
----------

    <?php
    // render a whole form
    echo $this->ztbFormRenderer($this->form);
    ?>


    <?php
    // render element by element
    $form = $this->form;
    $form->prepare();
    echo $this->form()->openTag($form);
    echo $this->ztbFormElementWrapper($this->form->get('element'));
    echo $this->form()->closeTag();
    ?>>

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

Badge Usage
-----------

    <?php
    echo $this->ztbBadge('This is a badge');
    // additional parameters: class
    echo $this->ztbBadge('This is a badge', 'info');

    // explicit usage
    // explicit types: info, important, inverse, success, warning
    echo $this->ztbBadge()->info('This is a badge');

Label Usage
-----------

    <?php
    echo $this->ztbLabel('This is a label');
    // additional parameters: class
    echo $this->ztbLabel('This is a label', 'info');

    // explicit usage
    // explicit types: info, important, inverse, success, warning
    echo $this->ztbLabel()->info('This is a label');
