<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Well;

class WellTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Well();
    }

    public function testLarge()
    {
        $expected = '<div class="well well-large">foo</div>';
        $this->assertEquals($expected, $this->helper->large('foo'));
    }

    public function testSmall()
    {
        $expected = '<div class="well well-small">foo</div>';
        $this->assertEquals($expected, $this->helper->small('foo'));
    }

    public function testRender()
    {
        $expected = '<div class="well ">foo</div>';
        $this->assertEquals($expected, $this->helper->render('foo'));
    }

    public function testInvoke()
    {
        $expected = '<div class="well foo">foo</div>';
        $this->assertEquals($expected, $this->helper->__invoke('foo', 'foo'));
    }
}
