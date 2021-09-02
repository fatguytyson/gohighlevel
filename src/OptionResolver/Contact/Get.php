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

namespace FGC\GoHighLevel\OptionResolver\Contact;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Get
{
    /** @var OptionsResolver */
    private static OptionsResolver $resolver;

    static function resolve(array $options = []): array
    {
        if (!isset(self::$resolver)) {
            self::$resolver = new OptionsResolver();
            self::$resolver->define('query')
                ->allowedTypes('string')
                ->info('It will search on these fields: `Name`, `Phone`, `Email`, `Tags`, and `Company Name`.');
            self::$resolver->define('sortBy')
                ->allowedValues('date_added', 'date_updated')
                ->info('default `date_added`');
            self::$resolver->define('order')
                ->allowedValues('asc', 'desc')
                ->info('default `desc`');
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