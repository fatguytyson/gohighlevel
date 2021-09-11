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

use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateStatus
{
    /** @var OptionsResolver */
    private static OptionsResolver $resolver;

    static function resolve(array $options = []): array
    {
        if (!isset(self::$resolver)) {
            self::$resolver = new OptionsResolver();
            self::$resolver->define('stageId')
                ->allowedTypes('string')
                ->required()
                ->info('Example: 7915dedc-8f18-44d5-8bc3-77c04e994a10');
            self::$resolver->define('status')
                ->allowedValues('open', 'won', 'lost', 'abandoned')
                ->required()
                ->info('Example: open');
        }

        return self::$resolver->resolve($options);
    }
}