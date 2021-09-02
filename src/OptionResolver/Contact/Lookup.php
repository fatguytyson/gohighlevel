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

use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Lookup
{
    /** @var OptionsResolver */
    private static OptionsResolver $resolver;

    static function resolve(array $options = []): array
    {
        if (!isset(self::$resolver)) {
            self::$resolver = new OptionsResolver();
            self::$resolver->define('email')
                ->allowedTypes('string', 'null')
                ->default(null)
                ->info('johndeo@gmail.com');
            self::$resolver->define('phone')
                ->allowedTypes('string', 'null')
                ->default(null)
                ->info('+1 888-888-8888')
                ->normalize(function (Options $options, $value) {
                    if (null === $value && null === $options['email']) {
                        throw new InvalidArgumentException('Email or Phone are required to lookup contact');
                    }

                    return $value;
                });
        }

        return array_filter(self::$resolver->resolve($options));
    }
}