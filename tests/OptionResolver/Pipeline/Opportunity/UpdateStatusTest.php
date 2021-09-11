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

namespace Tests\OptionResolver\Pipeline\Opportunity;

use FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity\UpdateStatus;
use Tests\OptionResolver\OptionResolverTest;

/**
 * @covers \FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity\UpdateStatus
 */
class UpdateStatusTest extends OptionResolverTest
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
                    'stageId' => 'stageIdentification',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'status' => 'won',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'stageId' => 'stageIdentification',
                    'status' => null,
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'stageId' => null,
                    'status' => 'won',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'stageId' => 'stageIdentification',
                    'status' => 'won',
                ],
                'result' => [
                    'stageId' => 'stageIdentification',
                    'status' => 'won',
                ],
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return UpdateStatus::class;
    }
}
