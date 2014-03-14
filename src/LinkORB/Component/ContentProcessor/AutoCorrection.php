<?php

namespace LinkORB\Component\ContentProcessor;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class AutoCorrection
{
    private $originWord;
    private $correctWord;
    
    public function __construct($originWord, $correctWork)
    {
        $this->originWord = $originWord;
        $this->correctWord = $correctWork;
    }
    
    public function getOriginWord()
    {
        return $this->originWord;
    }

    public function getCorrectWord()
    {
        return $this->correctWord;
    }

    public function setOriginWord($originWord)
    {
        $this->originWord = $originWord;
    }

    public function setCorrectWord($correctWord)
    {
        $this->correctWord = $correctWord;
    }
    
    public function process($input) {
        $output = str_replace($this->originWord, $this->correctWord, $input);
        return $output;
    }
}
