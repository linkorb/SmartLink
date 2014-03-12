<?php

namespace LinkORB\Component\ContentProcessor;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class ContentProcessor
{
    private $autoLink = false;
    
    private $nofollow = false;
    
    private $autoCorrections;
    
    private $keyworkLinks;
    
    private $regexLinks;


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
    }
    
    public function addKeywordLink(KeywordLink $keyworkLink)
    {
        $this->keyworkLinks[] = $keyworkLink;
    }
    
    public function addRegexLink(RegexLink $regexLink)
    {
        $this->regexLinks = $regexLink;
    }
    
    public function process($input)
    {
        
    }
}
