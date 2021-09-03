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
            self::$resolver->define('firstName')
                ->allowedTypes('string')
                ->info('John');
            self::$resolver->define('lastName')
                ->allowedTypes('string')
                ->info('Deo');
            self::$resolver->define('name')
                ->allowedTypes('string')
                ->info('John Deo');
            self::$resolver->define('companyName')
                ->allowedTypes('string')
                ->info('Company Name');
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
                        throw new InvalidArgumentException('Email or Phone are required to create contact');
                    }

                    return $value;
                });
            self::$resolver->define('address1')
                ->allowedTypes('string')
                ->info('Tonkawa Trail W');
            self::$resolver->define('city')
                ->allowedTypes('string')
                ->info('Austin');
            self::$resolver->define('state')
                ->allowedTypes('string')
                ->info('Texas');
            self::$resolver->define('postalCode')
                ->allowedTypes('string')
                ->info('45001');
            self::$resolver->define('website')
                ->allowedTypes('string')
                ->info('https://www.google.com');
            self::$resolver->define('timezone')
                ->allowedTypes('string')
                ->info('America/Chihuahua');
            self::$resolver->define('dnd')
                ->allowedTypes('boolean')
                ->info('true');
            self::$resolver->define('tags')
                ->allowedTypes('string[]')
                ->info('["tag1", "tag2"]');
            self::$resolver->define('customField')
                ->allowedTypes('array')
                ->info('["3r6dEOnsApNaKIhnFM6u" => "Value 1", "MgobCB14YMVKuE4Ka8p1" => "Value 2"]. Notes: 3r6dEOnsApNaKIhnFM6u and MgobCB14YMVKuE4Ka8p1 is a custom field id. You can find it using *Custom Fields* endpoints.')
                ->normalize(function (Options $options, $value) {
                    if (!is_array($value)) {
                        throw new InvalidArgumentException('Value should be an array with CustomField IDs as Keys for the fields values.');
                    }
                    foreach ($value as $key => $item) {
                        if (!is_string($key)) {
                            throw new InvalidArgumentException('The keys should be CustomField IDs.');
                        }
                    }

                    return $value;
                });
            self::$resolver->define('source')
                ->allowedTypes('string')
                ->info('Public API');
        }

        return self::$resolver;
    }
}