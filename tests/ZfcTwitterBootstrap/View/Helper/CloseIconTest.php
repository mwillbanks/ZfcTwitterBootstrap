<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\CloseIcon;

class CloseIconTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new CloseIcon();
    }

    public function testInvoke()
    {
        $expected = '<button class="close">&times;</button>';
        $this->assertEquals($expected, $this->helper->__invoke(CloseIcon::TYPE_BUTTON));

        $expected = '<a class="close" href="#">&times;</a>';
        $this->assertEquals($expected, $this->helper->__invoke(CloseIcon::TYPE_ANCOR));
    }
}
