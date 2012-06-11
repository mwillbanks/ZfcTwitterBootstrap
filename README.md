ZfcTwitterBootstrap
===================
Version 0.1.0 Created by Mike Willbanks

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
view helpers to render forms.  Overall this module will continue to grow
out the view helpers to assist in generating many of the items that Twitter
Bootstrap contains.

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)

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

Roadmap
-------

* Zend\Form - Completed basic integration
* Zend\Navigation - Not started
* Alert Messages - Not started

Usage
-----

    <?php
    // render a whole form
    echo $this->formRenderer($this->form);
    ?>


    <?php
    // render element by element
    $form = $this->form;
    $form->prepare();
    echo $this->form()->openTag($form);
    echo $this->formElement($this->form->get('element'));
    echo $this->form()->closeTag();
    ?>>
