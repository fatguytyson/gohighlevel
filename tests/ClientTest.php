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

namespace Tests;

use FGC\GoHighLevel\Client;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\GoHighLevel\Client
 */
class ClientTest extends TestCase
{
    private Client $test;

    protected function setUp(): void
    {
        $this->test = new Client('fake-api-key');
    }

    public function test__construct()
    {
        self::assertInstanceOf(Client::class, $this->test);
    }

    public function testContact()
    {
        self::assertInstanceOf(Client\Contact::class, $first = $this->test->contact());
        self::assertSame($first, $this->test->contact());
    }

    public function testCustomFiled()
    {
        self::assertInstanceOf(Client\CustomField::class, $first = $this->test->customField());
        self::assertSame($first, $this->test->customField());
    }

    public function testPipeline()
    {
        self::assertInstanceOf(Client\Pipeline::class, $first = $this->test->pipeline());
        self::assertSame($first, $this->test->pipeline());
    }

    public function testPipelineOpportunity()
    {
        self::assertInstanceOf(Client\Pipeline\Opportunity::class, $first = $this->test->pipeline()->opportunity());
        self::assertSame($first, $this->test->pipeline()->opportunity());
    }
}
