<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Image;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Image();
        $this->helper->setView(new \Zend\View\Renderer\PhpRenderer());
        $this->helper->getView()->plugin('basePath')->setBasePath('/');
    }

    public function testRounded()
    {
        $expected = '<img src="/foo.jpg" class="img-rounded">';
        $this->assertEquals($expected, $this->helper->rounded('/foo.jpg'));
    }

    public function testCircle()
    {
        $expected = '<img src="/foo.jpg" class="img-circle">';
        $this->assertEquals($expected, $this->helper->circle('/foo.jpg'));
    }

    public function testPolaroid()
    {
        $expected = '<img src="/foo.jpg" class="img-polaroid">';
        $this->assertEquals($expected, $this->helper->polaroid('/foo.jpg'));
    }

    public function testRender()
    {
        $expected = '<img src="/foo.jpg" class="img-foo">';
        $this->assertEquals($expected, $this->helper->render('/foo.jpg', 'foo'));
    }

    public function testInvoke()
    {
        $expected = '<img src="/foo.jpg" class="img-foo">';
        $this->assertEquals($expected, $this->helper->__invoke('/foo.jpg', 'foo'));
    }
}
