<?php

/**
 * ZfcTwitterBootstrap
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_Form
 * @subpackage View
 */

namespace ZfcTwitterBootstrap\View\Helper\Navigation;

use RecursiveIteratorIterator;
use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\AbstractPage;
use Zend\View\Helper\Navigation\Menu;

/**
 * Nav
 *
 * @category   ZfcTwitterBootstrap
 * @package    ZfcTwitterBootstrap_View
 * @subpackage Helper
 */
class Nav extends Menu {

	/**
	 * CSS class to use for the ul element
	 *
	 * @var string
	 */
	protected $ulClass = 'nav';

	// Public methods:

	/**
	 * Returns an HTML string containing an 'a' element for the given page if
	 * the page's href is not empty, and a 'span' element if it is empty
	 *
	 * Overrides {@link AbstractHelper::htmlify()}.
	 *
	 * @param  AbstractPage $page   page to generate HTML for
	 * @param bool $escapeLabel     Whether or not to escape the label
	 * @return string               HTML string for the given page
	 */
	public function htmlify(AbstractPage $page, $escapeLabel = true) {
		// get label and title for translating
		$label = $page->getLabel();
		$title = $page->getTitle();

		$hasChildren = $page->hasChildren();
		$class = $page->getClass();

		// translate label and title?
		if (null !== ($translator = $this->getTranslator())) {
			$textDomain = $this->getTranslatorTextDomain();
			if (is_string($label) && !empty($label)) {
				$label = $translator->translate($label, $textDomain);
			}
			if (is_string($title) && !empty($title)) {
				$title = $translator->translate($title, $textDomain);
			}
		}

		// get attribs for element
		$attribs = array(
			'id' => $page->getId(),
			'title' => $title,
		);

		// Setting class attributes elegantly.
		$class_array = array();
		if ($hasChildren) {
			$class_array[] = 'dropdown-toggle';
		}
		if (!empty($class)) {
			$class_array[] = trim($class);
		}
		if (count($class_array) > 0) {
			$attribs['class'] = implode(' ', $class_array);
		}

		// Toggle
		if ($hasChildren) {
			$attribs['data-toggle'] = 'dropdown';
		}

		// does page have a href?
		$href = $page->getHref();
		if ($href) {
			$element = 'a';
			$attribs['href'] = $href;
			$attribs['target'] = $page->getTarget();
		} else {
			$element = 'a';
			$attribs['href'] = '#';
		}

		$html = '<' . $element . $this->htmlAttribs($attribs) . '>';
		if ($escapeLabel === true) {
			$escaper = $this->view->plugin('escapeHtml');
			$html .= $escaper($label);
		} else {
			$html .= $label;
		}

		if ($hasChildren) {
			$html .= ' <b class="caret"></b>';
		}

		$html .= '</' . $element . '>';

		return $html;
	}

	// Render methods:

	/**
	 * Renders the deepest active menu within [$minDepth, $maxDepth], (called
	 * from {@link renderMenu()})
	 *
	 * @param  AbstractContainer         $container  container to render
	 * @param  array                     $active     active page and depth
	 * @param  string                    $ulClass    CSS class for first UL
	 * @param  string                    $indent     initial indentation
	 * @param  int|null                  $minDepth   minimum depth
	 * @param  int|null                  $maxDepth   maximum depth
	 * @return string                                rendered menu
	 */
	protected function renderDeepestMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $escapeLabels
	) {
		if (!$active = $this->findActive($container, $minDepth - 1, $maxDepth)) {
			return '';
		}

		// special case if active page is one below minDepth
		if ($active['depth'] < $minDepth) {
			if (!$active['page']->hasPages()) {
				return '';
			}
		} elseif (!$active['page']->hasPages()) {
			// found pages has no children; render siblings
			$active['page'] = $active['page']->getParent();
		} elseif (is_int($maxDepth) && $active['depth'] + 1 > $maxDepth) {
			// children are below max depth; render siblings
			$active['page'] = $active['page']->getParent();
		}

		$ulClass = $ulClass ? ' class="' . $ulClass . '"' : '';
		$html = $indent . '<ul' . $ulClass . '>' . self::EOL;

		foreach ($active['page'] as $subPage) {
			if (!$this->accept($subPage)) {
				continue;
			}

			$isActive = $subPage->isActive(true);
			$hasChildren = $subPage->hasPages();

			// Setting class attributes elegantly.
			$class_array = array();
			if ($hasChildren) {
				$class_array[] = 'dropdown';
			}
			if ($isActive) {
				$class_array[] = 'active';
			}
			$liClass = ' class="' . implode(' ', $class_array) . '"';
			unset($class_array);

			$html .= $indent . '    <li' . $liClass . '>' . self::EOL;
			$html .= $indent . '        ' . $this->htmlify($subPage, $escapeLabels) . self::EOL;
			$html .= $indent . '    </li>' . self::EOL;
		}

		$html .= $indent . '</ul>';

		return $html;
	}

	/**
	 * Renders a normal menu (called from {@link renderMenu()})
	 *
	 * @param  AbstractContainer         $container   container to render
	 * @param  string                    $ulClass     CSS class for first UL
	 * @param  string                    $indent      initial indentation
	 * @param  int|null                  $minDepth    minimum depth
	 * @param  int|null                  $maxDepth    maximum depth
	 * @param  bool                      $onlyActive  render only active branch?
	 * @return string
	 */
	protected function renderNormalMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $onlyActive, $escapeLabels
	) {
		$html = '';

		// find deepest active
		$found = $this->findActive($container, $minDepth, $maxDepth);
		if ($found) {
			$foundPage = $found['page'];
			$foundDepth = $found['depth'];
		} else {
			$foundPage = null;
		}

		// create iterator
		$iterator = new RecursiveIteratorIterator($container,
				RecursiveIteratorIterator::SELF_FIRST);
		if (is_int($maxDepth)) {
			$iterator->setMaxDepth($maxDepth);
		}

		// iterate container
		$prevDepth = -1;
		foreach ($iterator as $page) {
			//var_dump($page);
			$depth = $iterator->getDepth();
			$isActive = $page->isActive(true);
			$hasChildren = $page->hasChildren();
			$hasParent = $page->getParent();
			if ($depth < $minDepth || !$this->accept($page)) {
				// page is below minDepth or not accepted by acl/visibility
				continue;
			} elseif ($onlyActive && !$isActive) {
				// page is not active itself, but might be in the active branch
				$accept = false;
				if ($foundPage) {
					if ($foundPage->hasPage($page)) {
						// accept if page is a direct child of the active page
						$accept = true;
					} elseif ($foundPage->getParent()->hasPage($page)) {
						// page is a sibling of the active page...
						if (!$foundPage->hasPages() ||
							is_int($maxDepth) && $foundDepth + 1 > $maxDepth) {
							// accept if active page has no children, or the
							// children are too deep to be rendered
							$accept = true;
						}
					}
				}

				if (!$accept) {
					continue;
				}
			}

			// make sure indentation is correct
			$depth -= $minDepth;
			$myIndent = $indent . str_repeat('        ', $depth);

			if ($depth > $prevDepth) {
				// start new ul tag
				$classArray = array();
				if ($ulClass && $depth == 0) {
					$classArray[] = $ulClass;
				} else {
					if ($hasParent) {
						$classArray[] = 'dropdown-menu';
					}
				}
				if (count($classArray) > 0) {
					$ulClass = ' class="' . trim(implode(' ', $classArray)) . '"';
				}
				$html .= $myIndent . '<ul' . $ulClass . '>' . self::EOL;

			} elseif ($prevDepth > $depth) {
				// close li/ul tags until we're at current depth
				for ($i = $prevDepth; $i > $depth; $i--) {
					$ind = $indent . str_repeat('        ', $i);
					$html .= $ind . '    </li>' . self::EOL;
					$html .= $ind . '</ul>' . self::EOL;
				}
				// close previous li tag
				$html .= $myIndent . '    </li>' . self::EOL;
			} else {
				// close previous li tag
				$html .= $myIndent . '    </li>' . self::EOL;
			}

			// render li tag and page
			$class_array = array();
			$liClass = '';
			if ($hasChildren) {
				$class_array[] = 'dropdown';
			}
			if ($isActive) {
				$class_array[] = 'active';
			}
			if (count($class_array) > 0) {
				$liClass = ' class="' . implode(' ', $class_array) . '"';
			}

			$html .= $myIndent . '    <li' . $liClass . '>' . self::EOL
				. $myIndent . '        ' . $this->htmlify($page, $escapeLabels) . self::EOL;

			// store as previous depth for next iteration
			$prevDepth = $depth;
		}

		if ($html) {
			// done iterating container; close open ul/li tags
			for ($i = $prevDepth + 1; $i > 0; $i--) {
				$myIndent = $indent . str_repeat('        ', $i - 1);
				$html .= $myIndent . '    </li>' . self::EOL
					. $myIndent . '</ul>' . self::EOL;
			}
			$html = rtrim($html, self::EOL);
		}

		return $html;
	}

}
