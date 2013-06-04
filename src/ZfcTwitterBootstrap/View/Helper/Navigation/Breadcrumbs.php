<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\View\Helper\Navigation;

use Zend\Navigation\Page\AbstractPage;
use Zend\View\Helper\Navigation\Breadcrumbs as ZendBreadcrumbs;

/**
 * Helper for printing breadcrumbs
 */
class Breadcrumbs extends ZendBreadcrumbs
{
    /**
     * The minimum depth a page must have to be included when rendering
     *
     * @var int
     */
    protected $minDepth = 0;

    /**
     * Breadcrumbs separator string
     *
     * @var string
     */
    protected $separator = '/';

    /**
     * Returns an HTML string containing an 'a' element for the given page
     *
     * @param  AbstractPage $page  page to generate HTML for
     * @param  boolean      $hasParent if the breadcrumb has a parent
     * @return string
     */
    public function htmlify(AbstractPage $page, $hasParent = false)
    {
        if (!$page->getHref()) {
            $page->setHref('#');
        }

        $html = '<li';
        if (!$hasParent) {
            $html .= ' class="active"';
        }
        $html .= '>';

        if (!$hasParent && $this->getLinkLast()) {
            $html .= parent::htmlify($page);
        } else {
            $label = $page->getLabel();
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate($label, $this->getTranslatorTextDomain());
            }
            $escaper = $this->view->plugin('escapeHtml');
            $html    .= $escaper($label);
        }

        if ($hasParent) {
            $html .= ' <span class="divider">' . $this->getSeparator() . '</span>';
        }
        $html .= '</li>';
        return $html;
    }

    /**
     * Renders breadcrumbs by chaining 'a' elements with the separator
     * registered in the helper
     *
     * @param  AbstractContainer $container [optional] container to render. Default is
     *                                      to render the container registered in the helper.
     * @return string
     */
    public function renderStraight($container = null)
    {
        $this->parseContainer($container);
        if (null === $container) {
            $container = $this->getContainer();
        }

        // find deepest active
        if (!$active = $this->findActive($container)) {
            return '';
        }

        $active = $active['page'];
        $html = $this->htmlify($active);

        // walk back to root
        while ($parent = $active->getParent()) {
            if ($parent instanceof AbstractPage) {
                // prepend crumb to html
                $html = $this->htmlify($parent, true) . $html;
            }

            if ($parent === $container) {
                // at the root of the given container
                break;
            }

            $active = $parent;
        }

        $html = '<ul class="breadcrumb">' . $html . '</ul>';

        return strlen($html) ? $this->getIndent() . $html : '';
    }
}
