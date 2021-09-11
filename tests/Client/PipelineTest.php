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

namespace Tests\Client;

use FGC\GoHighLevel\Client\Pipeline;
use FGC\GoHighLevel\Object\Pipeline\Pipeline as PipelineObject;
use FGC\GoHighLevel\Object\Pipeline\Pipelines;
use FGC\GoHighLevel\Object\Pipeline\Stage;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\GoHighLevel\Client\Pipeline
 * @covers \FGC\GoHighLevel\Object\Pipeline\Pipelines
 * @covers \FGC\GoHighLevel\Object\Pipeline\Pipeline
 * @covers \FGC\GoHighLevel\Object\Pipeline\Stage
 */
class PipelineTest extends TestCase
{
    private Pipeline $test;
    private MockHandler $stack;

    protected function setUp(): void
    {
        $this->stack = new MockHandler();
        $this->test = new Pipeline('fake_api_key', new Client(['handler' => HandlerStack::create($this->stack)]));
    }

    public function testGet()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"pipelines":[{"id":"5pW6z3hDtWuBxm245sPI","name":"Funding Team","stages":[{"id":"6d8bb641-d830-4820-8fdf-feb4bbb85708","name":"CONSULT CALLS REQUESTED"},{"id":"dda1c27d-2430-4b89-8cbf-b13cc8ac63b1","name":"BIZ CHECKING 10K-20K "},{"id":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","name":" BIZ CHECKING 20K+"},{"id":"ac64b2fd-c3e1-4870-991f-a53c6da180bd","name":"700 + LOC - TERM LOANS "},{"id":"41ba9f86-021a-4cc5-9b3e-28afc0081303","name":"RENEWELS"},{"id":"2aa7c998-7455-4e78-825d-eb868ea29da7","name":"APPROVED"},{"id":"166ec614-78d7-40c7-8162-8a8ea03fd0cf","name":"FUNDED/SOLD"},{"id":"0df3fd93-40ca-44f7-a0fb-9982f64442c0","name":"CREDIT REPAIR "},{"id":"7f312dff-3a3b-4410-9d79-2a148026e539","name":"BIZ CREDIT"},{"id":"f2fda7e7-9b0f-47f6-8909-33c91c621fc7","name":"CONSULT NO SHOW"},{"id":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","name":"PHIL\'S LEADS"}],"locationId":"IfbKIgadZ0OF7opUv3XZ"}]}'
        ));
        $result = $this->test->get();
        self::assertInstanceOf(Pipelines::class, $result);
        self::assertIsArray($result->pipelines);
        self::assertNotEmpty($result->pipelines);
        self::assertInstanceOf(PipelineObject::class, $result->pipelines[0]);
        self::assertIsArray($result->pipelines[0]->stages);
        self::assertNotEmpty($result->pipelines[0]->stages);
        self::assertInstanceOf(Stage::class, $result->pipelines[0]->stages[0]);
    }
}
