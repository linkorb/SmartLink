<?php

namespace LinkORB\Component\SmartLink;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class SmartLink
{

    private $autoLink = false;
    private $nofollow = false;

    /**
     * @var AutoCorrection[]
     */
    private $autoCorrections = array();

    /**
     * @var KeywordLink[] 
     */
    private $keyworkLinks = array();

    /**
     * @var RegexLink[]
     */
    private $regexLinks = array();

    public function setAutoLink($autoLink)
    {
        $this->autoLink = $autoLink;
    }

    public function setNofollow($nofollow)
    {
        $this->nofollow = $nofollow;
    }

    public function addAutoCorrection(AutoCorrection $autoCorrection)
    {
        $this->autoCorrections[] = $autoCorrection;
        return $this;
    }

    public function addKeywordLink(KeywordLink $keyworkLink)
    {
        $this->keyworkLinks[] = $keyworkLink;
        return $this;
    }

    public function addRegexLink(RegexLink $regexLink)
    {
        $this->regexLinks[] = $regexLink;
        return $this;
    }

    public function process($input)
    {
        foreach ($this->regexLinks as $regexlink) {
            $input = $regexlink->process($input);
        }
        
        foreach ($this->autoCorrections as $autoCorrection) {
            $input = $autoCorrection->process($input);
        }

        foreach ($this->keyworkLinks as $keywordlink) {
            $input = $keywordlink->process($input);
        }
        
        return $input;
    }
}
