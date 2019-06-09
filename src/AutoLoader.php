<?php declare(strict_types=1);

namespace Inhere\GoogleTranslate;

use Swoft\Helper\ComposerJSON;
use Swoft\SwoftComponent;
use function dirname;

/**
 * Class AutoLoader
 *
 * @since 2.0
 */
class AutoLoader extends SwoftComponent
{
    /**
     * @return array
     */
    public function getPrefixDirs(): array
    {
        return [
            __NAMESPACE__ => __DIR__,
        ];
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        $jsonFile = dirname(__DIR__) . '/composer.json';

        return ComposerJSON::open($jsonFile)->getMetadata();
    }

    public function beans(): array
    {
        return [
            'docTranslator' => [
                'class' => GoogleTranslate::class,
                'source' => 'zh-CN',
                'target' => 'en',
                // 'url' => 'https://translate.google.com/translate_a/single',
                'url' => 'https://translate.google.cn/translate_a/single',
            ]
        ];
    }
}
