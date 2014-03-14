<?php

namespace LinkORB\Component\ContentProcessor\Tests;

use LinkORB\Component\ContentProcessor\AutoCorrection;
use LinkORB\Component\ContentProcessor\ContentProcessor;
use LinkORB\Component\ContentProcessor\KeywordLink;
use LinkORB\Component\ContentProcessor\RegexLink;
use PHPUnit_Framework_TestCase;

/**
 * @author Cong Peijun <p.cong@linkorb.com>
 */
class ContentProcessorTest extends PHPUnit_Framework_TestCase
{

    public function testProcess()
    {
        $input = file_get_contents('tests/input.txt');

        $process = new ContentProcessor();
        $process->addAutoCorrection(
            new AutoCorrection('FB', 'Facebook')
        );

        $process->addKeywordLink(
            new KeywordLink('Octocat', 'http://octodex.github.com')
        );

        $process->addRegexLink(
            new RegexLink('@([A-Za-z0-9]+)', 'http://twitter.com/{{x}}')
        );

        $process->addRegexLink(
            new RegexLink('\+([A-Za-z0-9]+)', 'http://plus.google.com/+{{x}}/Posts')
        );
        
        $process->addAutoCorrection(
            new AutoCorrection('+github', '+GitHub')
        );

        echo $output = $process->process($input);

        $this->assertEquals($output, file_get_contents('tests/output.txt'));
        //echo file_get_contents('tests/output.txt');
    }
}
