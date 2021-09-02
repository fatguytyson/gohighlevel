<?php

namespace Tests\FGC\GoHighLevel;

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
        self::assertInstanceOf(Client\Contact::class, $this->test->Contact());
    }
}
