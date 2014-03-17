<?php

namespace LinkORB\Component\SmartLink;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class KeywordLink
{

    private $keyword;
    private $link;
    private $nofollow = false;

    public function __construct($keyword, $link, $nofollow = false)
    {
        $this->keyword = $keyword;
        $this->link = $link;
        $this->nofollow = $nofollow;
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

    public function process($input)
    {
        $link = Utils::renderLinkHtml($this->keyword, $this->link, $this->nofollow);
        $input = str_replace($this->keyword, $link, $input);
        return $input;
    }
}
