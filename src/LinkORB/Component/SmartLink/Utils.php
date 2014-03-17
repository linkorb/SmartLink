<?php

namespace LinkORB\Component\SmartLink;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class Utils
{

    public static function renderLinkHtml($text, $link, $nofollw = false)
    {
        $nofollwRel = $nofollw ? ' rel="nofollow" ' : '';
        return '<a href="' . $link . '"' . $nofollwRel . '>' . $text . '</a>';
    }
}
