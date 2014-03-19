<?php

namespace LinkORB\Component\ContentProcessor\Tests;

use LinkORB\Component\SmartLink\AutoCorrection;
use LinkORB\Component\SmartLink\SmartLink;
use LinkORB\Component\SmartLink\KeywordLink;
use LinkORB\Component\SmartLink\RegexLink;
use PHPUnit_Framework_TestCase;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class SmartLinkTest extends PHPUnit_Framework_TestCase
{

    public function testProcess()
    {
        $input = file_get_contents('tests/input.txt');
        $process = new SmartLink();
        
        $process->enableAutoLink();
        
        $process->addAutoCorrection(
            new AutoCorrection('FB', 'Facebook')
        );
        
        $process->addAutoCorrection(
            new AutoCorrection('+github', '+GitHub')
        );

        $process->addKeywordLink(
            new KeywordLink('Octocat', 'http://octodex.github.com')
        )->addKeywordLink(
            new KeywordLink('Github', 'http://github.com', true)
        )->addKeywordLink(
            new KeywordLink('google.com', 'http://google.com', true)
        );

        $process->addRegexLink(
            new RegexLink('@([A-Za-z0-9]+)', 'http://twitter.com/{{1}}', true)
        );

        $process->addRegexLink(
            new RegexLink('\+[A-Za-z0-9]+', 'http://plus.google.com/{{0}}/Posts', true)
        );
        
        $output = $process->process($input);
        $this->assertEquals($output, file_get_contents('tests/output.txt'));
        //echo file_get_contents('tests/output.txt');
    }
}
