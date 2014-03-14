# SEO Smart Link

## Usage

```php
    
$input = <<<INPUT
    <p>Hello, my name is Octocat.</p>
    <p>I like Github, you can find it on <a href="http://github.com">http://github.com</a></p>
    <p>I also use google.com a lot, and http://baidu.com too.</p>
    <h3>Sometimes I use FB. <a href="http://dont.change.this.fb">fb test</a>, here's an image: <img src="http://dont.change.this.too.fb" /></h3>
    <p>Link to twitter: @github, and google plus: +github!</p>
INPUT;
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
```