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

use FGC\GoHighLevel\Client\CustomField;
use FGC\GoHighLevel\Object\CustomField\CustomField as CustomFieldObject;
use FGC\GoHighLevel\Object\CustomField\CustomFields;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\GoHighLevel\Client\CustomField
 * @covers \FGC\GoHighLevel\Object\CustomField\CustomFields
 * @covers \FGC\GoHighLevel\Object\CustomField\CustomField
 */
class CustomFieldTest extends TestCase
{
    private CustomField $test;
    private MockHandler $stack;

    protected function setUp(): void
    {
        $this->stack = new MockHandler();
        $this->test = new CustomField('fake_api_key', new Client(['handler' => HandlerStack::create($this->stack)]));
    }

    public function testGet()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"customFields":[{"id":"4TpylkzgT6MX2c25ORQU","name":"Are you Interested in credit repair services? It will increase your chances of getting a loan.","fieldKey":"contact.are_you_interested_in_credit_repair_services_it_will_increase_your_chances_of_getting_a_loan","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes Help me raise my score!","No I\'m happy with my credit"]},{"id":"54nFCEGMOPhEiDBeutxY","name":"What State Are you In ?","fieldKey":"contact.what_state_are_you_in_","placeholder":"","dataType":"TEXT","position":0},{"id":"7OT67TfCGopyez49ATqN","name":"What is your credit score?","fieldKey":"contact.what_is_your_credit_score","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Below 600","600-649","680-719","720+"]},{"id":"F9L11kTvz5prdJNajifN","name":"Do you have $10,000 or more in debt you would like to eliminate?","fieldKey":"contact.do_you_have_10000_or_more_in_debt_you_would_like_to_eliminate","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes I would like to get rid of my debt!","No I\'m ok thank you"]},{"id":"JqEmk8IulOb7SZtN3Vp4","name":"Are you currently employed?","fieldKey":"contact.are_you_currently_employed","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes","No"]},{"id":"Nv8FPUgPQOzGV3gN5w7O","name":"What type of checking account do you have?","fieldKey":"contact.what_type_of_checking_account_do_you_have","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Business Checking Account","Business Checking Account + Personal Checking","Personal Checking Account"]},{"id":"ZH0SPfRC01JxMXlyTOgy","name":"What is your gross monthly sales?","fieldKey":"contact.what_is_your_gross_monthly_sales","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Start Up","Less than $5k/mo","$5k - $9,999/mo","$20k - $50k/mo","$50k - $100k/mo","$100k+/mo"]},{"id":"chQVHGrWlrRB7VA251gv","name":"User Title","fieldKey":"contact.user_title","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Funding Director","Funding Sales Manager"]},{"id":"p7UCvspUT9xmSrQOkkTQ","name":"How long have you been in business?","fieldKey":"contact.how_long_have_you_been_in_business","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Purchase Business","Less than 6 months","6-12 months","1+ years"]}]}'
        ));
        $result = $this->test->get();
        self::assertInstanceOf(CustomFields::class, $result);
        self::assertIsArray($result->customFields);
        self::assertCount(9, $result->customFields);
        self::assertInstanceOf(CustomFieldObject::class, $result->customFields[0]);
    }

    public function testCreate()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"4TpylkzgT6MX2c25ORQU","name":"Are you Interested in credit repair services? It will increase your chances of getting a loan.","fieldKey":"contact.are_you_interested_in_credit_repair_services_it_will_increase_your_chances_of_getting_a_loan","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes Help me raise my score!","No I\'m happy with my credit"]}'
        ));
        $result = $this->test->create([
            'name' => 'Are you Interested in credit repair services? It will increase your chances of getting a loan.',
            'dataType' => 'SINGLE_OPTIONS',
            'options' => ['Yes Help me raise my score!', 'No I\'m happy with my credit'],
        ]);
        self::assertInstanceOf(CustomFieldObject::class, $result);
        self::assertSame('4TpylkzgT6MX2c25ORQU', $result->id);
    }

    public function testFetch()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"4TpylkzgT6MX2c25ORQU","name":"Are you Interested in credit repair services? It will increase your chances of getting a loan.","fieldKey":"contact.are_you_interested_in_credit_repair_services_it_will_increase_your_chances_of_getting_a_loan","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes Help me raise my score!","No I\'m happy with my credit"]}'
        ));
        $result = $this->test->fetch('4TpylkzgT6MX2c25ORQU');
        self::assertInstanceOf(CustomFieldObject::class, $result);
        self::assertSame('4TpylkzgT6MX2c25ORQU', $result->id);
    }

    public function testUpdate()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"4TpylkzgT6MX2c25ORQU","name":"Are you Interested in credit repair services? It will increase your chances of getting a loan.","fieldKey":"contact.are_you_interested_in_credit_repair_services_it_will_increase_your_chances_of_getting_a_loan","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes Help me raise my score!","No I\'m happy with my credit"]}'
        ));
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"4TpylkzgT6MX2c25ORQU","name":"Are you Interested in credit repair services? It will increase your chances of getting a loan.","fieldKey":"contact.are_you_interested_in_credit_repair_services_it_will_increase_your_chances_of_getting_a_loan","placeholder":"","dataType":"SINGLE_OPTIONS","position":0,"picklistOptions":["Yes Help me raise my score!","No I\'m happy with my credit","Neither, just stop bothering me."]}'
        ));
        $customField = $this->test->fetch('4TpylkzgT6MX2c25ORQU');
        self::assertCount(2, $customField->picklistOptions);
        $customField->picklistOptions[] = 'Neither, just stop bothering me.';
        $result = $this->test->update($customField);
        self::assertInstanceOf(CustomFieldObject::class, $result);
        self::assertSame($customField->id, $result->id);
        self::assertSame($customField->picklistOptions, $result->picklistOptions);
    }

    public function testDelete()
    {
        $this->expectNotToPerformAssertions();
        $this->stack->append(new Response(200, ['Content-Type' => 'text/plain'], 'OK'));
        $this->test->delete('4TpylkzgT6MX2c25ORQU');
    }
}
