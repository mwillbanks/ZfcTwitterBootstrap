<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Badge;

class BadgeTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Badge();
    }

    public function testInfo()
    {
        $expected = '<span class="badge badge-info">foo</span>';
        $this->assertEquals($expected, $this->helper->info('foo'));
    }

    public function testImportant()
    {
        $expected = '<span class="badge badge-important">foo</span>';
        $this->assertEquals($expected, $this->helper->important('foo'));
    }

    public function testInverse()
    {
        $expected = '<span class="badge badge-inverse">foo</span>';
        $this->assertEquals($expected, $this->helper->inverse('foo'));
    }

    public function testSuccess()
    {
        $expected = '<span class="badge badge-success">foo</span>';
        $this->assertEquals($expected, $this->helper->success('foo'));
    }

    public function testWarning()
    {
        $expected = '<span class="badge badge-warning">foo</span>';
        $this->assertEquals($expected, $this->helper->warning('foo'));
    }

    public function testRender()
    {
        $expected = '<span class="badge foo">foo</span>';
        $this->assertEquals($expected, $this->helper->render('foo', 'foo'));
    }

    public function testInvoke()
    {
        $expected = '<span class="badge ">foo</span>';
        $this->assertEquals($expected, $this->helper->__invoke('foo'));
    }
}
