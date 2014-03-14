<?php

namespace LinkORB\Component\ContentProcessor;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class RegexLink
{

    private $regex;
    private $link;
    private $nofollow = false;

    public function __construct($regex, $link, $nofollow = false)
    {
        $this->setRegex($regex);
        $this->link = $link;
        $this->nofollow = $nofollow;
    }

    public function getRegex()
    {
        return $this->regex;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setRegex($regex)
    {
        $this->regex = '/' . $regex . '/';
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
    
    public function process($input)
    {
        $output = preg_replace_callback(
            $this->regex,
            function($matches) {
                preg_match('/\{\{(\d+?)\}\}/', $this->link, $m);
                $text = $matches[$m[1]];
                $link = str_replace($m[0], $text, $this->link);
                return Utils::renderLinkHtml($text, $link, $this->nofollow);
            },
            $input
        );
        return $output;
    }
}
