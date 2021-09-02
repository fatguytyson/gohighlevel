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

namespace Tests\FGC\GoHighLevel\OptionResolver\Contact;

use FGC\GoHighLevel\OptionResolver\Contact\Get;
use Tests\FGC\GoHighLevel\OptionResolver\OptionResolverTest;

/**
 * @covers \FGC\GoHighLevel\OptionResolver\Contact\Get
 */
class GetTest extends OptionResolverTest
{
    public function scenarioProvider(): array
    {
        return [
            [
                'options' => [],
                'result' => [],
            ],
            [
                'options' => [
                    'query' => 'search',
                    'sortBy' => 'date_added',
                    'order' => 'desc',
                    'startAfterId' => 'rAnDoMiD',
                    'startAfter' => 123456,
                    'limit' => 20,
                ],
                'result' => [
                    'query' => 'search',
                    'sortBy' => 'date_added',
                    'order' => 'desc',
                    'startAfterId' => 'rAnDoMiD',
                    'startAfter' => 123456,
                    'limit' => 20,
                ],
            ],
            [
                'options' => [
                    'queries' => 'Bad Key',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'query' => 1,
                ],
                'result' => null,
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return Get::class;
    }
}
