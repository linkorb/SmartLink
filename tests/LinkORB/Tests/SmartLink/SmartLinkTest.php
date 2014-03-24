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
        /*
        $process->autoLinkGooglPlus(true);
        $process->autoLinkTwitter(true);
        */
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
    
    public function testAutoLinkGooglPlus()
    {
        $input = <<<INPUT
<p>Hello, my name is Octocat.</p>
My google plus is +Github  a+b=c
我的G+是+Peijun哈哈哈
INPUT;
        
        $output = <<<OUTPUT
<p>Hello, my name is Octocat.</p>
My google plus is <a href="http://plus.google.com/+Github/Posts">+Github</a>  a+b=c
我的G+是<a href="http://plus.google.com/+Peijun/Posts">+Peijun</a>哈哈哈
OUTPUT;
    
        $smartlink = new SmartLink();
        $smartlink->autoLinkGooglPlus();
        $smartlink->process($input);
        $this->assertEquals($output, $smartlink->process($input));
    }
    
    public function testAutoLinkTwitter()
    {
        $input = <<<INPUT
<p>Hello, my name is Octocat.</p>
My twitter is @Github, and email is test@github.com
你好，我的名字是丛培君
我的推特是@_congpeijun
INPUT;
        
        $output = <<<OUTPUT
<p>Hello, my name is Octocat.</p>
My twitter is <a href="http://twitter.com/Github">@Github</a>, and email is test@github.com
你好，我的名字是丛培君
我的推特是<a href="http://twitter.com/_congpeijun">@_congpeijun</a>
OUTPUT;
    
        $smartlink = new SmartLink();
        $smartlink->autoLinkTwitter();
        $this->assertEquals($output, $smartlink->process($input));
    }
}
