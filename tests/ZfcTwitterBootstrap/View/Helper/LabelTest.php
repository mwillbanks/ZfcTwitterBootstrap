<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Label;

class LabelTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Label();
    }

    public function testInfo()
    {
        $expected = '<span class="label label-info">foo</span>';
        $this->assertEquals($expected, $this->helper->info('foo'));
    }

    public function testImportant()
    {
        $expected = '<span class="label label-important">foo</span>';
        $this->assertEquals($expected, $this->helper->important('foo'));
    }

    public function testInverse()
    {
        $expected = '<span class="label label-inverse">foo</span>';
        $this->assertEquals($expected, $this->helper->inverse('foo'));
    }

    public function testSuccess()
    {
        $expected = '<span class="label label-success">foo</span>';
        $this->assertEquals($expected, $this->helper->success('foo'));
    }

    public function testWarning()
    {
        $expected = '<span class="label label-warning">foo</span>';
        $this->assertEquals($expected, $this->helper->warning('foo'));
    }

    public function testRender()
    {
        $expected = '<span class="label foo">foo</span>';
        $this->assertEquals($expected, $this->helper->render('foo', 'foo'));
    }

    public function testInvoke()
    {
        $expected = '<span class="label ">foo</span>';
        $this->assertEquals($expected, $this->helper->__invoke('foo'));
    }
}
