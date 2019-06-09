<?php

namespace Inhere\GoogleTranslate\Tests;

use PHPUnit\Framework\TestCase;
use Inhere\GoogleTranslate\GoogleTranslate;
use Swoole\Event;

class TranslationTest extends TestCase
{
    /** @var GoogleTranslate */
    public $tr;

    public function setUp(): void
    {
        $this->tr = new GoogleTranslate();
    }

    public function testTranslationEquality()
    {
        try {
            $resultOne = GoogleTranslate::trans('Hello', 'ka', 'en');
        } catch (\ErrorException $e) {
            $resultOne = null;
        }
        $resultTwo = $this->tr->setSource('en')->setTarget('ka')->translate('Hello');

        $this->assertEquals($resultOne, $resultTwo, 'გამარჯობა');
    }

    public function testUTF16Translation()
    {
        try {
            $resultOne = GoogleTranslate::trans('yes 👍🏽', 'de', 'en');
        } catch (\ErrorException $e) {
            $resultOne = null;
        }
        $resultTwo = $this->tr->setSource('en')->setTarget('de')->translate('yes 👍🏽');

        $this->assertEquals($resultOne, $resultTwo, 'ja 👍🏽');
    }

    public function testZhCNTranslation(): void
    {
        \go(function () {
            try {
                $resultOne = GoogleTranslate::trans('欢迎你', 'en', 'zh-CN');
            } catch (\ErrorException $e) {
                $resultOne = null;
            }

            $resultTwo = $this->tr->setSource('zh-CN')->setTarget('en')->translate('欢迎你');

            $this->assertEquals($resultOne, $resultTwo, 'Welcome');
        });

        Event::wait();
    }

    public function testRawResponse(): void
    {
        $rawResult = $this->tr->getResponse('cat');

        $this->assertTrue(is_array($rawResult), 'Method getResponse() should return an array.');
    }
}
