<?php declare(strict_types=1);

namespace Inhere\GoogleTranslate\Tokens;

/**
 * A nice interface for providing tokens.
 */
class SampleTokenGenerator implements TokenProviderInterface
{
    /**
     * Generate a fake token just as an example.
     *
     * @param string $source Source language
     * @param string $target Target langiage
     * @param string $text   Text to translate
     *
     * @return string Token
     * @throws \Exception
     */
    public function generateToken(string $source, string $target, string $text) : string
    {
        return sprintf('%d.%d', random_int(10000, 99999), random_int(10000, 99999));
    }
}
