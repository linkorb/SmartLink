<?php

namespace LinkORB\Component\ContentProcessor;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class KeywordLink
{

    private $keyword;
    private $link;
    
    public function __construct($keyword, $link)
    {
        $this->keyword = $keyword;
        $this->link = $link;
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
    
    public function process($input) {
        $link = '<a href="' . str_replace('{{x}}', $this->keyword, $this->link) . '">' . $this->keyword . '</a>';
        $input = str_replace($this->keyword, $link, $input);
        return $input;
    }
}
