<?php

namespace LinkORB\Component\ContentProcessor;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class RegexLink
{

    private $regex;
    private $link;

    public function __construct($regex, $link)
    {
        $this->setRegex($regex);
        $this->link = $link;
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
                $link = '<a href="' . str_replace('{{x}}', $matches[1], $this->link) . '">'.$matches[1].'</a>';
                return $link;
            },
            $input
        );
        return $output;
    }
}
