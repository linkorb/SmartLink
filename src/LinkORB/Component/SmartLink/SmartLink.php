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

    public function enableAutoLink()
    {
        $this->autoLink = true;
    }
    
    public function disableAutoLink()
    {
        $this->autoLink = false;
    }

    public function setNofollow($nofollow)
    {
        $this->nofollow = $nofollow;
    }

    /**
     * Add auto correction
     * @param AutoCorrection $autoCorrection
     * @return SmartLink
     */
    public function addAutoCorrection(AutoCorrection $autoCorrection)
    {
        $this->autoCorrections[] = $autoCorrection;
        return $this;
    }

    /**
     * Add keyword link
     * @param KeywordLink $keyworkLink
     * @return SmartLink
     */
    public function addKeywordLink(KeywordLink $keyworkLink)
    {
        $this->keyworkLinks[] = $keyworkLink;
        return $this;
    }

    /**
     * Add regex link
     * @param RegexLink $regexLink
     * @return SmartLink
     */
    public function addRegexLink(RegexLink $regexLink)
    {
        $this->regexLinks[] = $regexLink;
        return $this;
    }

    /**
     * Auto add link for the content. when the content contains the volaid url.
     * @param string $input
     */
    protected function autoLink($input)
    {
        $input = strip_tags($input);
        $urlPatterns = '/(https?|ftp|file){1}(:\/\/)?([\da-z-\.]+)\.([a-z]{2,6})([\/\w\.-?&%-=]*)*\/?/';
        
        preg_match_all($urlPatterns, $input, $matches);
        foreach ($matches[0] as $m) {
            $this->addKeywordLink(
                new KeywordLink($m, $m)
            );
        }
    }
    
    public function autoLinkTwitter()
    {
        $this->addRegexLink(
            new RegexLink('@([A-Za-z0-9]+)', 'http://twitter.com/{{1}}', true)
        );
    }
    
    public function autoLinkGooglPlus()
    {
        $this->addRegexLink(
            new RegexLink('\+[A-Za-z0-9]+', 'http://plus.google.com/{{0}}/Posts', true)
        );
    }

    public function process($input)
    {
        if ($this->autoLink) {
            $this->autoLink($input);
        }
        
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
