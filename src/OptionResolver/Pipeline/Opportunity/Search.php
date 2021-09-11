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

class Search
{
    /** @var OptionsResolver */
    private static OptionsResolver $resolver;

    static function resolve(array $options = []): array
    {
        if (!isset(self::$resolver)) {
            self::$resolver = new OptionsResolver();
            self::$resolver->define('stageId')
                ->allowedTypes('string')
                ->info('Example: 7915dedc-8f18-44d5-8bc3-77c04e994a10');
            self::$resolver->define('query')
                ->allowedTypes('string')
                ->info('Example: john@deo.com');
            self::$resolver->define('status')
                ->allowedValues('open', 'won', 'lost', 'abandoned')
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
            self::$resolver->define('campaignId')
                ->allowedTypes('string')
                ->info('Example: Y2I9XM7aO1hncuSOlc9L');
            self::$resolver->define('startDate')
                ->allowedTypes('int')
                ->info('epoch timestamp. for ex: 1598107050459');
            self::$resolver->define('endDate')
                ->allowedTypes('int')
                ->info('epoch timestamp. for ex: 1614091050459');
            self::$resolver->define('startAfterId')
                ->allowedTypes('string')
                ->info('You can fetched next and more by passing the `startAfterId` on the query params. You can see `startAfterId` fields found into the response meta field.');
            self::$resolver->define('startAfter')
                ->allowedTypes('int')
                ->info('You can fetched next and more by passing the `startAfter` on the query params. You can see `startAfter` fields found into the response meta field.');
            self::$resolver->define('limit')
                ->allowedTypes('int')
                ->info('Limit Per Page records count. will allow maximum up to 100 and default will be 20');
        }

        return self::$resolver->resolve($options);
    }
}