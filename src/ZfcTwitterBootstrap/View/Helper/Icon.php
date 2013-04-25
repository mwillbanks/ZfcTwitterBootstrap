<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Filter\FilterChain;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\Filter\StringToLower;
use InvalidArgumentException;
use Exception;

/**
 * Icon
 */
class Icon extends AbstractHelper
{
    /**
     * @var string
     */
    protected $color = "icon-white";

    /**
     * @var string
     */
    protected $format = '<i class="%s"></i>';

    /**
     * @var array
     */
    protected $icons = array(
        'adjust', 'align-center', 'align-justify', 'align-left',
        'align-right', 'arrow-down', 'arrow-left', 'arrow-right',
        'arrow-up', 'asterisk', 'backward', 'ban-circle',
        'barcode', 'bell', 'bold', 'book',
        'bookmark', 'briefcase', 'bullhorn', 'calendar',
        'camera', 'certificate', 'check', 'chevron-down',
        'chevron-left', 'chevron-right', 'chevron-up', 'circle-arrow-down',
        'circle-arrow-left', 'circle-arrow-right', 'circle-arrow-up', 'cog',
        'comment', 'download', 'download-alt', 'edit',
        'eject', 'envelope', 'exclamation-sign', 'eye-close',
        'eye-open', 'facetime-video', 'fast-backward', 'fast-forward',
        'file', 'film', 'filter', 'fire',
        'flag', 'folder-close', 'folder-open', 'font',
        'forward', 'fullscreen', 'gift', 'glass',
        'globe', 'hand-down', 'hand-left', 'hand-right',
        'hand-up', 'hdd', 'headphones', 'heart',
        'home', 'inbox', 'indent-left', 'indent-right',
        'info-sign', 'italic', 'leaf', 'list',
        'list-alt', 'lock', 'magnet', 'map-marker',
        'minus', 'minus-sign', 'move', 'music',
        'off', 'ok', 'ok-circle', 'ok-sign',
        'pause', 'pencil', 'picture', 'plane',
        'play', 'play-circle', 'plus', 'plus-sign',
        'print', 'qrcode', 'question-sign', 'random',
        'refresh', 'remove', 'remove-circle', 'remove-sign',
        'repeat', 'resize-full', 'resize-horizontal', 'resize-small',
        'resize-vertical', 'retweet', 'road', 'screenshot',
        'search', 'share', 'share-alt', 'shopping-cart',
        'signal', 'star', 'star-empty', 'step-backward',
        'step-forward', 'stop', 'tag', 'tags',
        'tasks', 'text-height', 'text-width', 'th',
        'th-large', 'th-list', 'thumbs-down', 'thumbs-up',
        'time', 'tint', 'trash', 'upload',
        'user', 'volume-down', 'volume-off', 'volume-up',
        'warning-sign', 'wrench', 'zoom-in', 'zoom-out'
    );

    /**
     * Invoke Icon
     *
     * @param  string      $icon
     * @param  string      $color
     * @return string|self
     */
    public function __invoke ($icon = null, $color = '')
    {
        if ($icon) {
            return $this->render($icon, $color);
        }

        return $this;
    }

    /**
     * Display Icon
     *
     * @param  string                    $method
     * @param  array                     $argv
     * @throws \InvalidArgumentException
     * @return string
     */
    public function __call($method, $argv)
    {
        $filterChain = new FilterChain();

        $filterChain->attach(new CamelCaseToDash())
            ->attach(new StringToLower());

        $icon = $filterChain->filter($method);

        if (!in_array($icon, $this->icons)) {
            throw new InvalidArgumentException($icon . ' is not supported');
        }

        if ($argv) {
            $argv = (string) $argv[0];
        }

        return $this->render($icon, $argv);
    }

    /**
     * Render Icon
     *
     * @param  string    $icon
     * @param  string    $color
     * @throws Exception
     * @return string
     */
    public function render($icon, $color = '')
    {
        if (!in_array($icon, $this->icons)) {
            throw new Exception($icon . ' icon is not supported');
        }

        $class = 'icon-' . $icon;

        if ($color) {
            $class .= ' icon-white';
        }

        $class = trim($class);

        return sprintf($this->format, $class);
    }
}
