<?php
/*
 * Copyright (c) 2021. Fat Guy Consulting - Tyson Green
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity;

use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Create
{
    /** @var OptionsResolver */
    private static OptionsResolver $resolver;

    public static function resolve(array $options = []): array
    {
        return array_filter(self::getResolver()->resolve($options), function ($value) {
            return !(null === $value || (is_array($value) && empty($value)));
        });
    }

    public static function getDefined(): array
    {
        return self::getResolver()->getDefinedOptions();
    }

    protected static function getResolver(): OptionsResolver
    {
        if (!isset(self::$resolver)) {
            self::$resolver = new OptionsResolver();
            self::$resolver->define('title')
                ->allowedTypes('string')
                ->required()
                ->info('First Opps');
            self::$resolver->define('stageId')
                ->allowedTypes('string')
                ->required()
                ->info('Example: 7915dedc-8f18-44d5-8bc3-77c04e994a10');
            self::$resolver->define('status')
                ->allowedValues('open', 'won', 'lost', 'abandoned')
                ->required()
                ->info('Example: open');
            self::$resolver->define('monetaryValue')
                ->normalize(function (Options $options, $value) {
                    if (is_numeric($value)) {
                        return $value;
                    }

                    throw new InvalidArgumentException(sprintf('Field `%s` must be numeric', 'monetaryValue'));
                })
                ->info('Example: 220');
            self::$resolver->define('assignedTo')
                ->allowedTypes('string')
                ->info('Example: 082goXVW3lIExEQPOnd3');
            self::$resolver->define('contactId')
                ->allowedTypes('string', 'null')
                ->default(null)
                ->normalize(function (Options $options, $value) {
                    if (null === $value
                        && !$options->offsetExists('email')
                        && !$options->offsetExists('phone')
                    ) {
                        throw new InvalidArgumentException('A contact identifier (contactId, email, or phone) must be included.');
                    }

                    return $value;
                })
                ->info('Example: mTkSCb1UBjb5tk4OvB69');
            self::$resolver->define('name')
                ->allowedTypes('string')
                ->info('Company Name');
            self::$resolver->define('email')
                ->allowedTypes('string')
                ->info('johndeo@gmail.com');
            self::$resolver->define('phone')
                ->allowedTypes('string')
                ->info('+1 888-888-8888');
            self::$resolver->define('tags')
                ->allowedTypes('string[]')
                ->info('["tag1", "tag2"]');
            self::$resolver->define('companyName')
                ->allowedTypes('string')
                ->info('Company Name');
        }

        return self::$resolver;
    }
}