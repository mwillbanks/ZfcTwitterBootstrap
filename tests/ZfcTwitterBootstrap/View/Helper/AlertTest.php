<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Alert;

class AlertTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Alert();
    }

    public function testInfo()
    {
        $expected = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->info('foo'));

        $expected = '<div class="alert alert-info alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->info('foo', true));
    }

    public function testError()
    {
        $expected = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->error('foo'));

        $expected = '<div class="alert alert-error alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->error('foo', true));
    }

    public function testWarning()
    {
        $expected = '<div class="alert "><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->warning('foo'));

        $expected = '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->warning('foo', true));
    }

    public function testSuccess()
    {
        $expected = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->success('foo'));

        $expected = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->success('foo', true));
    }

    public function testRender()
    {
        $expected = '<div class="alert "><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->render('foo'));

        $expected = '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->render('foo', true));

        $expected = '<div class="alert foo alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->render('foo', true, 'foo'));
    }

    public function testInvoke()
    {
        $expected = '<div class="alert "><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->__invoke('foo'));

        $expected = '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->__invoke('foo', true));

        $expected = '<div class="alert foo alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>foo</div>';
        $this->assertEquals($expected, $this->helper->__invoke('foo', true, 'foo'));
    }
}
