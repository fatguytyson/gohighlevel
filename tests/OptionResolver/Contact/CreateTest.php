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

namespace Tests\OptionResolver\Contact;

use FGC\GoHighLevel\OptionResolver\Contact\Create;
use Tests\OptionResolver\OptionResolverTest;

/**
 * @covers \FGC\GoHighLevel\OptionResolver\Contact\Create
 */
class CreateTest extends OptionResolverTest
{
    public function scenarioProvider(): array
    {
        return [
            [
                'options' => [],
                'result' => null,
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                ],
                'result' => [
                    'email' => 'email@value.com',
                ],
            ],
            [
                'options' => [
                    'phone' => 'phonenumber',
                ],
                'result' => [
                    'phone' => 'phonenumber',
                ],
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                ],
                'result' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                ],
            ],
            [
                'options' => [
                    'firstName' => 'firstName',
                    'lastName' => 'lastName',
                    'name' => 'name',
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'address1' => 'address1',
                    'city' => 'city',
                    'state' => 'state',
                    'postalCode' => 'postalCode',
                    'website' => 'website',
                    'timezone' => 'timezone',
                    'dnd' => true,
                    'tags' => ['tag1', 'tag2'],
                    'customField' => [
                        'key1' => 'value',
                        'key2' => 'value'
                    ],
                    'source' => 'source',
                ],
                'result' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'firstName' => 'firstName',
                    'lastName' => 'lastName',
                    'name' => 'name',
                    'address1' => 'address1',
                    'city' => 'city',
                    'state' => 'state',
                    'postalCode' => 'postalCode',
                    'website' => 'website',
                    'timezone' => 'timezone',
                    'dnd' => true,
                    'tags' => ['tag1', 'tag2'],
                    'customField' => [
                        'key1' => 'value',
                        'key2' => 'value'
                    ],
                    'source' => 'source',
                ],
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'dnd' => false,
                ],
                'result' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'dnd' => false,
                ],
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'tags' => [1,2],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'customField' => [
                        'value',
                        'key2' => 'value',
                    ],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'customField' => [
                        'key1' => 'value',
                        'value',
                    ],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'customField' => null,
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                    'customField' => [],
                ],
                'result' => [
                    'email' => 'email@value.com',
                    'phone' => 'phonenumber',
                ],
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return Create::class;
    }
}
