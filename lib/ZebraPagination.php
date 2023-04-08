<?php

namespace Flynt;

class ZebraPagination
{
    private $_properties = array(
        'always_show_navigation'    =>  true,
        'avoid_duplicate_content'   =>  true,
        'css_classes'   =>  array(
            'list'      =>  'pagination',
            'list_item' =>  'page-item',
            'anchor'    =>  'page-link',
        ),
        'method'                    =>  'get',
        'next'                      =>  '<span></span>',
        'padding'                   =>  true,
        'page'                      =>  1,
        'page_set'                  =>  false,
        'navigation_position'       =>  'outside',
        'preserve_query_string'     =>  0,
        'previous'                  =>  '<span></span>',
        'records'                   =>  '',
        'records_per_page'          =>  '',
        'reverse'                   =>  false,
        'selectable_pages'          =>  6,
        'total_pages'               =>  0,
        'trailing_slash'            =>  true,
        'variable_name'             =>  'page',

    );

    public function __construct()
    {
        $this->baseUrl();
    }

    public function alwaysShowNavigation($show = true)
    {
        $this->_properties['always_show_navigation'] = $show;
    }

    public function avoidDuplicateContent($avoid_duplicate_content = true)
    {
        $this->_properties['avoid_duplicate_content'] = $avoid_duplicate_content;
    }

    public function baseUrl($base_url = '', $preserve_query_string = true)
    {
        $base_url = ($base_url == '' ? $_SERVER['REQUEST_URI'] : $base_url);
        $parsed_url = parse_url($base_url);
        $this->_properties['base_url'] = $parsed_url['path'];
        $this->_properties['base_url_query'] = isset($parsed_url['query']) ? $parsed_url['query'] : '';
        parse_str($this->_properties['base_url_query'], $this->_properties['base_url_query']);
        $this->_properties['preserve_query_string'] = $preserve_query_string;
    }

    public function cssClasses($css_classes)
    {
        if (
            !is_array($css_classes) || empty($css_classes) || array_keys($css_classes) != array_filter(array_keys($css_classes), function ($value) {
                return in_array($value, array('list', 'list_item', 'anchor'), true);
            })
        ) {
            trigger_error('Invalid argument. Method <strong>classes()</strong> accepts as argument an associative array with one or more of the following keys: <em>list, list_item, anchor</em>', E_USER_ERROR);
        }

        $this->_properties['css_classes'] = array_merge($this->_properties['css_classes'], $css_classes);
    }

    public function getPage()
    {
        if (!$this->_properties['page_set']) {
            if (
                $this->_properties['method'] == 'url' &&
                preg_match('/\b' . preg_quote($this->_properties['variable_name']) . '([0-9]+)\b/i', $_SERVER['REQUEST_URI'], $matches) > 0
            ) {
                $this->set_page((int)$matches[1]);
            } elseif (isset($_GET[$this->_properties['variable_name']])) {
                $this->set_page((int)$_GET[$this->_properties['variable_name']]);
            }
        }

        if ($this->_properties['reverse'] && $this->_properties['records'] == '') {
            trigger_error('When showing records in reverse order you must specify the total number of records (by calling the "records" method) *before* the first use of the "get_page" method!', E_USER_ERROR);
        }

        if ($this->_properties['reverse'] && $this->_properties['records_per_page'] == '') {
            trigger_error('When showing records in reverse order you must specify the number of records per page (by calling the "records_per_page" method) *before* the first use of the "get_page" method!', E_USER_ERROR);
        }

        $this->_properties['total_pages'] = $this->getPages();
        if ($this->_properties['total_pages'] > 0) {
            if ($this->_properties['page'] > $this->_properties['total_pages']) {
                $this->_properties['page'] = $this->_properties['total_pages'];
            } elseif ($this->_properties['page'] < 1) {
                $this->_properties['page'] = 1;
            }
        }

        if (!$this->_properties['page_set'] && $this->_properties['reverse']) {
            $this->set_page($this->_properties['total_pages']);
        }

        return $this->_properties['page'];
    }

    public function getPages()
    {
        return @ceil($this->_properties['records'] / $this->_properties['records_per_page']);
    }

    public function labels($previous = '&laquo;', $next = '&raquo;')
    {
        $this->_properties['previous'] = $previous;
        $this->_properties['next'] = $next;
    }

    public function isMobile($is_mobile)
    {
        if ($is_mobile) {
            $this->selectablePages(5);
        }
    }

    public function method($method = 'get')
    {
        $this->_properties['method'] = (strtolower($method) == 'url' ? 'url' : 'get') ;
    }

    public function navigationPosition($position)
    {
        $this->_properties['navigation_position'] = (in_array(strtolower($position), array('left', 'right')) ? strtolower($position) : 'outside') ;
    }

    public function padding($enabled = true)
    {
        $this->_properties['padding'] = $enabled;
    }

    public function records($records)
    {
        $this->_properties['records'] = (int)$records;
    }

    public function recordsPerPage($records_per_page)
    {
        $this->_properties['records_per_page'] = (int)$records_per_page;
    }

    public function render($return_output = false)
    {
        $this->getPage();
        if ($this->_properties['total_pages'] <= 1 && !$this->_properties['always_show_navigation']) {
            return '';
        }

        $output = '<ul' . ($this->_properties['css_classes']['list'] != '' ? ' class="' . trim($this->_properties['css_classes']['list']) . '"' : '') . '>';
        if ($this->_properties['reverse']) {
            if ($this->_properties['navigation_position'] == 'left') {
                $output .= $this->showNext() . $this->showPrevious() . $this->showPages();
            } elseif ($this->_properties['navigation_position'] == 'right') {
                $output .= $this->showPages() . $this->showNext() . $this->showPrevious();
            } else {
                $output .= $this->showNext() . $this->showPages() . $this->showPrevious();
            }
        } else {
            if ($this->_properties['navigation_position'] == 'left') {
                $output .= $this->showPrevious() . $this->showNext() . $this->showPages();
            } elseif ($this->_properties['navigation_position'] == 'right') {
                $output .= $this->showPages() . $this->showPrevious() . $this->showNext();
            } else {
                $output .= $this->showPrevious() . $this->showPages() . $this->showNext();
            }
        }

        $output .= '</ul>';
        if ($return_output) {
            return $output;
        }

        echo $output;
    }

    public function reverse($reverse = false)
    {
        $this->_properties['reverse'] = $reverse;
    }

    public function selectablePages($selectable_pages)
    {
        $this->_properties['selectable_pages'] = (int)$selectable_pages;
    }

    public function setPage($page)
    {
        $this->_properties['page'] = (int)$page;
        if ($this->_properties['page'] < 1) {
            $this->_properties['page'] = 1;
        }
        $this->_properties['page_set'] = true;
    }

    public function trailingSlash($enabled)
    {
        $this->_properties['trailing_slash'] = $enabled;
    }

    public function variableName($variable_name)
    {
        $this->_properties['variable_name'] = strtolower($variable_name);
    }

    private function buildUri($page)
    {
        if ($this->_properties['method'] == 'url') {
            if (preg_match('/\b' . $this->_properties['variable_name'] . '([0-9]+)\b/i', $this->_properties['base_url']) > 0) {
                $url = str_replace('//', '/', preg_replace('/\b' . $this->_properties['variable_name'] . '([0-9]+)\b/i', ($page == 1 ? '' : $this->_properties['variable_name'] . $page), $this->_properties['base_url']));
            } else {
                $url = rtrim($this->_properties['base_url'], '/') . '/' . ($this->_properties['variable_name'] . $page);
            }

            $url = rtrim($url, '/') . ($this->_properties['trailing_slash'] ? '/' : '');
            if (!$this->_properties['preserve_query_string']) {
                $query = implode('&', $this->_properties['base_url_query']);
            } else {
                $query = $_SERVER['QUERY_STRING'];
            }
            return $url . ($query != '' ? '?' . $query : '');
        } else {
            if (!$this->_properties['preserve_query_string']) {
                $query = $this->_properties['base_url_query'];
            } else {
                parse_str($_SERVER['QUERY_STRING'], $query);
            }

            if (!$this->_properties['avoid_duplicate_content'] || ($page != ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1))) {
                $query[$this->_properties['variable_name']] = $page;
            } elseif ($this->_properties['avoid_duplicate_content'] && $page == ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1)) {
                unset($query[$this->_properties['variable_name']]);
            }

            return htmlspecialchars(html_entity_decode($this->_properties['base_url']) . (!empty($query) ? '?' . urldecode(http_build_query($query)) : ''));
        }
    }

    private function showNext()
    {
        $output = '';
        if ($this->_properties['always_show_navigation'] || $this->_properties['total_pages'] > $this->_properties['selectable_pages']) {
            $css_classes = isset($this->_properties['css_classes']['list_item']) && $this->_properties['css_classes']['list_item'] != '' ? array(trim($this->_properties['css_classes']['list_item'])) : array();
            if ($this->_properties['page'] == $this->_properties['total_pages']) {
                $css_classes[] = 'disabled';

                return '';
            }

            $output = '<li class="next-btn"><a href="#' . ($this->_properties['page'] + 1) . '"' . ' rel="next">' . $this->_properties['next'] . '</a></li>';
        }

        return $output;
    }

    private function showPages()
    {

        $output = '';

        if ($this->_properties['total_pages'] <= $this->_properties['selectable_pages']) {
            for ($i = ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1); ($this->_properties['reverse'] ? $i >= 1 : $i <= $this->_properties['total_pages']); ($this->_properties['reverse'] ? $i-- : $i++)) {
                $css_classes = 'page-item';
                if ($this->_properties['page'] == $i) {
                    $css_classes = 'page-item-active';
                }

                $output .= '<li class="' . $css_classes . '"><a href="#' . $i . '">' . $i . '</a></li>';
            }
        } else {
            $css_classes = 'page-item';
            if ($this->_properties['page'] == ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1)) {
                $css_classes = 'page-item-active';
            }

            $output .= '<li class="' . $css_classes . '"><a href="#1">1</a></li>';
            $adjacent = floor(($this->_properties['selectable_pages'] - 2) / 2);
            if ($adjacent == 0) {
                $adjacent = 1;
            }

            $scroll_from = ($this->_properties['reverse'] ?
                $this->_properties['total_pages'] - ($this->_properties['selectable_pages'] - $adjacent) + 1 :
                $this->_properties['selectable_pages'] - $adjacent);
            $starting_page = ($this->_properties['reverse'] ? $this->_properties['total_pages'] - 1 : 2);
            if (
                ($this->_properties['reverse'] && $this->_properties['page'] <= $scroll_from) ||
                (!$this->_properties['reverse'] && $this->_properties['page'] >= $scroll_from)
            ) {
                $starting_page = $this->_properties['page'] + ($this->_properties['reverse'] ? $adjacent : -$adjacent);
                if (
                    ($this->_properties['reverse'] && $starting_page < ($this->_properties['selectable_pages'] - 1)) ||
                    (!$this->_properties['reverse'] && $this->_properties['total_pages'] - $starting_page < ($this->_properties['selectable_pages'] - 2))
                ) {
                    if ($this->_properties['reverse']) {
                        $starting_page = $this->_properties['selectable_pages'] - 1;
                    } else {
                        $starting_page -= ($this->_properties['selectable_pages'] - 2) - ($this->_properties['total_pages'] - $starting_page);
                    }
                }

                $output .= '<li class="page-item-dot"><span>&hellip;</span></li>';
            }

            $ending_page = $starting_page + (($this->_properties['reverse'] ? -1 : 1) * ($this->_properties['selectable_pages'] - 3));
            if ($this->_properties['reverse'] && $ending_page < 2) {
                $ending_page = 2;
            } elseif (!$this->_properties['reverse'] && $ending_page > $this->_properties['total_pages'] - 1) {
                $ending_page = $this->_properties['total_pages'] - 1;
            }

            for (
                $i = $starting_page; $this->_properties['reverse'] ? $i >= $ending_page : $i <= $ending_page;
                $this->_properties['reverse'] ? $i-- : $i++
            ) {
                $css_classes = 'page-item';
                if ($this->_properties['page'] == $i) {
                    $css_classes = 'page-item-active';
                }

                $output .= '<li class="' . $css_classes . '"><a href="#' . $i . '">' . $i . '</a></li>';
            }

            if (
                ($this->_properties['reverse'] && $ending_page > 2) ||
                (!$this->_properties['reverse'] && $this->_properties['total_pages'] - $ending_page > 1)
            ) {
                $output .= '<li class="page-item-dot"><span>&hellip;</span></li>';
            }

            $css_classes = 'page-item';
            if ($this->_properties['page'] == $i) {
                $css_classes = 'page-item-active';
            }

            $output .= '<li class="' . $css_classes . '"><a href="#' . $this->_properties['total_pages'] . '">' . $this->_properties['total_pages'] . '</a></li>';
        }

        return $output;
    }

    private function showPrevious()
    {
        $output = '';
        if ($this->_properties['always_show_navigation'] || $this->_properties['total_pages'] > $this->_properties['selectable_pages']) {
            $css_classes = isset($this->_properties['css_classes']['list_item']) && $this->_properties['css_classes']['list_item'] != '' ? array(trim($this->_properties['css_classes']['list_item'])) : array();
            if ($this->_properties['page'] == 1) {
                $css_classes[] = 'disabled';

                return '';
            }

            $output = '<li class="prev-btn"><a href="#' . ($this->_properties['page'] - 1) . '"' . ' rel="prev">' . $this->_properties['previous'] . '</a></li>';
        }
        
        return $output;
    }

    public function renderWithParam($page_url, $page_url_param)
    {
        $this->getPage();
        if ($this->_properties['total_pages'] <= 1 && !$this->_properties['always_show_navigation']) {
            return '';
        }

        $output = '<ul' . ($this->_properties['css_classes']['list'] != '' ? ' class="' . trim($this->_properties['css_classes']['list']) . '"' : '') . '>';

        // $this->showPrevious()
        if ($this->_properties['always_show_navigation'] || $this->_properties['total_pages'] > $this->_properties['selectable_pages']) {
            $css_classes = isset($this->_properties['css_classes']['list_item']) && $this->_properties['css_classes']['list_item'] != '' ? array(trim($this->_properties['css_classes']['list_item'])) : array();
            if ($this->_properties['page'] > 1) {
                $output .= '<li class="prev-btn"><a href="' . $page_url . ($this->_properties['page'] - 1) . $page_url_param . '" rel="prev">' . $this->_properties['previous'] . '</a></li>';
            }
        }

        // $this->showPages()
        if ($this->_properties['total_pages'] <= $this->_properties['selectable_pages']) {
            for ($i = ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1); ($this->_properties['reverse'] ? $i >= 1 : $i <= $this->_properties['total_pages']); ($this->_properties['reverse'] ? $i-- : $i++)) {
                $css_classes = 'page-item';
                if ($this->_properties['page'] == $i) {
                    $css_classes = 'page-item-active';
                }

                $output .= '<li class="' . $css_classes . '"><a href="' . $page_url . $i . $page_url_param . '">' . $i . '</a></li>';
            }
        } else {
            $css_classes = 'page-item';
            if ($this->_properties['page'] == ($this->_properties['reverse'] ? $this->_properties['total_pages'] : 1)) {
                $css_classes = 'page-item-active';
            }

            $output .= '<li class="' . $css_classes . '"><a href="' . $page_url . '1' . $page_url_param . '">1</a></li>';
            $adjacent = floor(($this->_properties['selectable_pages'] - 2) / 2);
            if ($adjacent == 0) {
                $adjacent = 1;
            }

            $scroll_from = ($this->_properties['reverse'] ?
                $this->_properties['total_pages'] - ($this->_properties['selectable_pages'] - $adjacent) + 1 :
                $this->_properties['selectable_pages'] - $adjacent);
            $starting_page = ($this->_properties['reverse'] ? $this->_properties['total_pages'] - 1 : 2);
            if (
                ($this->_properties['reverse'] && $this->_properties['page'] <= $scroll_from) ||
                (!$this->_properties['reverse'] && $this->_properties['page'] >= $scroll_from)
            ) {
                $starting_page = $this->_properties['page'] + ($this->_properties['reverse'] ? $adjacent : -$adjacent);
                if (
                    ($this->_properties['reverse'] && $starting_page < ($this->_properties['selectable_pages'] - 1)) ||
                    (!$this->_properties['reverse'] && $this->_properties['total_pages'] - $starting_page < ($this->_properties['selectable_pages'] - 2))
                ) {
                    if ($this->_properties['reverse']) {
                        $starting_page = $this->_properties['selectable_pages'] - 1;
                    } else {
                        $starting_page -= ($this->_properties['selectable_pages'] - 2) - ($this->_properties['total_pages'] - $starting_page);
                    }
                }

                $output .= '<li class="page-item-dot"><span>&hellip;</span></li>';
            }

            $ending_page = $starting_page + (($this->_properties['reverse'] ? -1 : 1) * ($this->_properties['selectable_pages'] - 3));
            if ($this->_properties['reverse'] && $ending_page < 2) {
                $ending_page = 2;
            } elseif (!$this->_properties['reverse'] && $ending_page > $this->_properties['total_pages'] - 1) {
                $ending_page = $this->_properties['total_pages'] - 1;
            }

            for (
                $i = $starting_page; $this->_properties['reverse'] ? $i >= $ending_page : $i <= $ending_page;
                $this->_properties['reverse'] ? $i-- : $i++
            ) {
                $css_classes = 'page-item';
                if ($this->_properties['page'] == $i) {
                    $css_classes = 'page-item-active';
                }

                $output .= '<li class="' . $css_classes . '"><a href="' . $page_url . $i . $page_url_param . '">' . $i . '</a></li>';
            }

            if (
                ($this->_properties['reverse'] && $ending_page > 2) ||
                (!$this->_properties['reverse'] && $this->_properties['total_pages'] - $ending_page > 1)
            ) {
                $output .= '<li class="page-item-dot"><span>&hellip;</span></li>';
            }

            $css_classes = 'page-item';
            if ($this->_properties['page'] == $i) {
                $css_classes = 'page-item-active';
            }

            $output .= '<li class="' . $css_classes . '"><a href="' . $page_url . $this->_properties['total_pages'] . $page_url_param . '">' . $this->_properties['total_pages'] . '</a></li>';
        }

        // $this->showNext()

        if ($this->_properties['always_show_navigation'] || $this->_properties['total_pages'] > $this->_properties['selectable_pages']) {
            $css_classes = isset($this->_properties['css_classes']['list_item']) && $this->_properties['css_classes']['list_item'] != '' ? array(trim($this->_properties['css_classes']['list_item'])) : array();
            if ($this->_properties['page'] < $this->_properties['total_pages']) {
                $output .= '<li class="next-btn"><a href="' . $page_url . ($this->_properties['page'] + 1) . $page_url_param . '" rel="next">' . $this->_properties['next'] . '</a></li>';
            }
        }

        $output .= '</ul>';

        return $output;
    }
}
