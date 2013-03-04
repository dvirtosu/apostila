<?php

class AjaxPager extends CLinkPager
{
    protected function createPageButton($label, $page, $class, $hidden, $selected)
    {
        if ($hidden || $selected)
        {
            $class .= ' ' . ($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
        }

        return '<li class="' . $class . '" data-page="'.$page.'"><a href="#">' . $label . '</a></li>';
    }
}

?>
