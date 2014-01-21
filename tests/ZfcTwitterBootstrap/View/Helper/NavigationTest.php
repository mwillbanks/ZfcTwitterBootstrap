<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrapTest\View\Helper;

use ZfcTwitterBootstrap\View\Helper\Navigation;

class NavigationTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Navigation();
        $this->helper->setView(new \Zend\View\Renderer\PhpRenderer());
        $this->helper->getView()->plugin('basePath')->setBasePath('/');
    }

    public function testSimpleRender()
    {
        $container = new \Zend\Navigation\Navigation(array(
            array(
                'label' => 'Page 1',
                'id'    => 'p1',
                'uri'   => 'p1',
            ),
            array(
                'label' => 'Page 2',
                'id'    => 'p2',
                'uri'   => 'p2',
            ),
        ));
        $expected = '<ul class="nav">
    <li>
        <a id="menu-p1" href="p1">Page 1</a>
    </li>
    <li>
        <a id="menu-p2" href="p2">Page 2</a>
    </li>
</ul>';

        $actual = $this->helper->render($container);
        $this->assertEquals($expected, $actual);
    }

    public function testDropdownRender()
    {
        $container = new \Zend\Navigation\Navigation(array(
            array(
                'label' => 'Page 1',
                'id'    => 'p1',
                'uri'   => 'p1',
            ),
            array(
                'label' => 'Page 2',
                'id'    => 'p2',
                'uri'   => 'p2',
                'pages' => array(
                    array(
                        'label' => 'Page 2.1',
                        'id'    => 'p2-1',
                        'uri'   => 'p2-1',
                    ),
                    array(
                        'label' => 'Page 2.2',
                        'id'    => 'p2-2',
                        'uri'   => 'p2-2',
                    ),
                ),
            ),
        ));
        $expected = '<ul class="nav">
    <li>
        <a id="menu-p1" href="p1">Page 1</a>
    </li>
    <li class="dropdown">
        <a id="menu-p2" href="p2" data-toggle="dropdown" class=" dropdown-toggle">Page 2 <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a id="menu-p2-1" href="p2-1">Page 2.1</a>
            </li>
            <li>
                <a id="menu-p2-2" href="p2-2">Page 2.2</a>
            </li>
        </ul>
    </li>
</ul>';

        $actual = $this->helper->render($container);
        $this->assertEquals($expected, $actual);
    }
}
