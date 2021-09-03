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

namespace Tests\OptionResolver\CustomField;

use FGC\GoHighLevel\OptionResolver\CustomField\Create;
use Tests\OptionResolver\OptionResolverTest;

/**
 * @covers \FGC\GoHighLevel\OptionResolver\CustomField\Create
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
                    'name' => 'Some Value',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'dataType' => 'TEXT',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXT',
                ],
                'result' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXT',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'SINGLE_OPTIONS',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'MULTIPLE_OPTIONS',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'CHECKBOX',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'SINGLE_OPTIONS',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                ],
                'result' => [
                    'name' => 'Some Value',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                    'dataType' => 'SINGLE_OPTIONS',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'MULTIPLE_OPTIONS',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                ],
                'result' => [
                    'name' => 'Some Value',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                    'dataType' => 'MULTIPLE_OPTIONS',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'CHECKBOX',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                ],
                'result' => [
                    'name' => 'Some Value',
                    'options' => [
                        'option1',
                        'option2',
                    ],
                    'dataType' => 'CHECKBOX',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'SINGLE_OPTIONS',
                    'options' => [],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'SINGLE_OPTIONS',
                    'options' => [
                        1,
                        2,
                    ],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'FILE_UPLOAD',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'FILE_UPLOAD',
                    'acceptedFormat' => [],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'FILE_UPLOAD',
                    'acceptedFormat' => ['all'],
                ],
                'result' => [
                    'name' => 'Some Value',
                    'acceptedFormat' => ['all'],
                    'dataType' => 'FILE_UPLOAD',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'FILE_UPLOAD',
                    'acceptedFormat' => ['.pdf', '.docx', '.jpeg', '.png', '.gif', '.csv', 'all'],
                ],
                'result' => [
                    'name' => 'Some Value',
                    'acceptedFormat' => ['.pdf', '.docx', '.jpeg', '.png', '.gif', '.csv', 'all'],
                    'dataType' => 'FILE_UPLOAD',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'FILE_UPLOAD',
                    'acceptedFormat' => ['.zip', '.docx', '.jpeg', '.png', '.gif', '.csv', 'all'],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                    'textBoxListOptions' => [],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                    'textBoxListOptions' => [
                        'label' => 'Option1',
                        'prefillValue' => 'prefilledValue',
                    ],
                ],
                'result' => null,
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                    'textBoxListOptions' => [
                        [
                            'label' => 'Option1',
                            'prefillValue' => 'prefilledValue',
                        ],
                    ],
                ],
                'result' => [
                    'textBoxListOptions' => [
                        [
                            'label' => 'Option1',
                            'prefillValue' => 'prefilledValue',
                        ],
                    ],
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                ],
            ],
            [
                'options' => [
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                    'textBoxListOptions' => [
                        [
                            'label' => 'Option1',
                            'prefillValue' => 'prefilledValue',
                        ],
                        [
                            'label' => 'Option2',
                            'prefillValue' => 'prefilledValue',
                        ],
                        [
                            'label' => 'Option3',
                            'prefillValue' => 'prefilledValue',
                        ],
                    ],
                ],
                'result' => [
                    'textBoxListOptions' => [
                        [
                            'label' => 'Option1',
                            'prefillValue' => 'prefilledValue',
                        ],
                        [
                            'label' => 'Option2',
                            'prefillValue' => 'prefilledValue',
                        ],
                        [
                            'label' => 'Option3',
                            'prefillValue' => 'prefilledValue',
                        ],
                    ],
                    'name' => 'Some Value',
                    'dataType' => 'TEXTBOX_LIST',
                ],
            ],
        ];
    }

    protected function getOptionResolverClass(): string
    {
        return Create::class;
    }
}
