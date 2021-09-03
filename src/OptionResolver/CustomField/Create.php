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

namespace FGC\GoHighLevel\OptionResolver\CustomField;

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
            self::$resolver->define('name')
                ->allowedTypes('string')
                ->required()
                ->info('Field Label');
            self::$resolver->define('dataType')
                ->allowedValues(
                    'TEXT',
                    'LARGE_TEXT',
                    'NUMERICAL',
                    'PHONE',
                    'MONETORY',
                    'CHECKBOX',
                    'SINGLE_OPTIONS',
                    'MULTIPLE_OPTIONS',
                    'FLOAT',
                    'TIME',
                    'DATE',
                    'TEXTBOX_LIST',
                    'FILE_UPLOAD',
                    'SIGNATURE'
                )
                ->required()
                ->normalize(function (Options $options, $value) {
                    switch ($value) {
                        case 'FILE_UPLOAD':
                            if (!isset($options['acceptedFormat'])
                                || !is_array($options['acceptedFormat'])
                                || 0 === count($options['acceptedFormat'])
                            ) {
                                throw new InvalidArgumentException(sprintf('AcceptedFormat as string[] is required if %s is the DataType', $value));
                            }
                            break;
                        case 'SINGLE_OPTIONS':
                        case 'MULTIPLE_OPTIONS':
                        case 'CHECKBOX':
                            if (!isset($options['options'])
                                || !is_array($options['options'])
                                || 0 === count($options['options'])
                            ) {
                                throw new InvalidArgumentException(sprintf('options as string[] is required if %s is the DataType', $value));
                            }
                            break;
                        case 'TEXTBOX_LIST':
                            if (!isset($options['textBoxListOptions'])
                                || !is_array($options['textBoxListOptions'])
                                || 0 === count($options['textBoxListOptions'])
                            ) {
                                throw new InvalidArgumentException(sprintf('textBoxListOptions as array of options is required if %s is the DataType', $value));
                            }
                            break;
                    }

                    return $value;
                })
                ->info('On every data type of field have different validation rules. These are the different validation rules.');
            self::$resolver->define('placeholder')
                ->allowedTypes('string')
                ->info('Field placeholder');
            self::$resolver->define('position')
                ->allowedTypes('int')
                ->info('position of the input field');
            self::$resolver->define('options')
                ->allowedTypes('string[]')
                ->info('required when SINGLE_OPTIONS / MULTIPLE_OPTIONS / CHECKBOX is DataType');
            self::$resolver->define('acceptedFormat')
                ->allowedTypes('string[]')
                ->normalize(function (Options $options, $value) {
                    $formats = ['.pdf', '.docx', '.jpeg', '.png', '.gif', '.csv', 'all'];
                    if ($diff = array_diff($value, $formats)) {
                        throw new InvalidArgumentException(sprintf(
                            '(%s) are not allowed values. Allowed Values (%s)',
                            implode(', ', $diff),
                            implode(', ', $formats)
                        ));
                    }

                    return $value;
                })
                ->info('This will allow array of file format.');
            self::$resolver->define('isMulitpalFile')
                ->allowedTypes('boolean')
                ->info('it allow true or false. If you want to allow multipal files pass true');
            self::$resolver->define('maxNumberOfFiles')
                ->allowedTypes('int')
                ->info('It will allow maximum these number of files.');
            self::$resolver->define('textBoxListOptions')
                ->default(function (OptionsResolver $listResolver) {
                    $listResolver->setPrototype(true);
                    $listResolver->define('label')
                        ->allowedTypes('string')
                        ->required();
                    $listResolver->define('prefillValue')
                        ->allowedTypes('string')
                        ->required();
                })
                ->info('This will allow array of textbox list. Array will contanis label and prefillValue. ex.: ["label" => "Hello", "prefillValue" => "value"]');
        }

        return self::$resolver;
    }
}