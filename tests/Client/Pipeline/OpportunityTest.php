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

namespace Tests\Client\Pipeline;

use FGC\GoHighLevel\Client\Pipeline\Opportunity;
use FGC\GoHighLevel\Object\Meta;
use FGC\GoHighLevel\Object\Pipeline\Opportunity\Contact;
use FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunities;
use FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunity as OpportunityObject;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\GoHighLevel\Client\Pipeline\Opportunity
 * @covers \FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunities
 * @covers \FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunity
 * @covers \FGC\GoHighLevel\Object\Pipeline\Opportunity\Contact
 */
class OpportunityTest extends TestCase
{
    private Opportunity $test;
    private MockHandler $stack;

    protected function setUp(): void
    {
        $this->stack = new MockHandler();
        $this->test = new Opportunity('fake_api_key', new Client(['handler' => HandlerStack::create($this->stack)]));
    }

    public function testDelete()
    {
        $this->expectNotToPerformAssertions();
        $this->stack->append(new Response(200, ['Content-Type' => 'text/plain'], 'OK'));
        $this->test->delete('pipeline','opportunity');
    }

    public function testSearch()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"opportunities":[{"id":"lePgA6yqJBIt0AvHvnrr","name":"Personal referral","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","pipelineStageUId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"timo-referral","lastStatusChangeAt":"2021-08-30T20:52:27.483Z","createdAt":"2021-08-30T20:45:32.781Z","updatedAt":"2021-08-31T14:25:48.021Z","contact":{"id":"Tx3LPSV9ILzptdZ5SDr3","name":"Durray Soles","companyName":"Reliant Global Transportation","email":"duraysoles@yahoo.com","phone":"+16092096333","tags":["callsconsultrequested","calvin"]}},{"id":"uizyLA8vFA0extSFD9H1","name":"ROBERT L HAMBRIGHT","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","pipelineStageUId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"tycoon","lastStatusChangeAt":"2021-08-30T20:31:08.884Z","createdAt":"2021-08-30T20:31:08.884Z","updatedAt":"2021-08-30T20:38:46.822Z","contact":{"id":"8ClqTqOFHZd9zjWoqkjc","name":"ROBERT L HAMBRIGHT","companyName":"HAMM TRANSPORT LLC","email":"hambrightrobert191@yahoo.com","phone":"+17348298079","tags":["callsconsultrequested","calvin"]}},{"id":"f54ROSSWlHs9UsTAf5pP","name":"Gerald Patterson","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","pipelineStageUId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"tycoon","lastStatusChangeAt":"2021-08-30T18:54:49.756Z","createdAt":"2021-08-30T18:54:49.756Z","updatedAt":"2021-09-03T23:12:34.863Z","contact":{"id":"f8vEOLYcecbq3GVuXQwj","name":"-GDP Logistics Llc-Gerald Patterson","companyName":"GDP Logistics Llc","email":"pattsdispatch@gmail.com","phone":"+17062312525","tags":["callsconsultrequested","calvin"]}},{"id":"EqdzGQeCUVgmCZ2fxzO0","name":"Berace Bennett","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","pipelineStageUId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"tycoon","lastStatusChangeAt":"2021-08-30T18:09:25.004Z","createdAt":"2021-08-30T18:09:25.004Z","updatedAt":"2021-09-06T19:32:54.565Z","contact":{"id":"vxPhc5Bg0emd8Rmgh5cg","name":"Berace Bennett","companyName":"B&P & Sons Flooring, LLC","email":"beracebennett@ymail.com","phone":"+15732012713","tags":["callsconsultrequested","calvin"]}},{"id":"oQS8685p4Vgp9wziAEKl","name":"Pasquale Allegrini","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"0df3fd93-40ca-44f7-a0fb-9982f64442c0","pipelineStageUId":"0df3fd93-40ca-44f7-a0fb-9982f64442c0","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"","lastStatusChangeAt":"2021-08-27T22:46:39.542Z","createdAt":"2021-08-27T22:46:26.773Z","updatedAt":"2021-08-31T21:41:49.000Z","contact":{"id":"aZn3Iphi7wY9102UCdHk","name":"Pasquale Allegrini","companyName":"Allegrini Mozzarella Ltd","email":"pasqualeallegrini@yahoo.com","phone":"+17025130030","tags":["fileimport"]}},{"id":"AG2JgUAWWRLz0eTXY1V6","name":"Holy Ghost Transport Llc","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ac64b2fd-c3e1-4870-991f-a53c6da180bd","pipelineStageUId":"ac64b2fd-c3e1-4870-991f-a53c6da180bd","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"lost","source":"tycoon","lastStatusChangeAt":"2021-09-06T20:23:00.331Z","createdAt":"2021-08-27T21:55:01.532Z","updatedAt":"2021-09-06T20:23:00.331Z","contact":{"id":"a87jGfCAK7b4I6mecbK1","name":"Gregory Stamps","companyName":"Holy Ghost Transport Llc","email":"833gregsup@gmail.com","phone":"+14058335975","tags":["callsconsultrequested","calvin"]}},{"id":"Fj8TsHBK6P913rZQw5aU","name":"Schifano Transport","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","pipelineStageUId":"6d8bb641-d830-4820-8fdf-feb4bbb85708","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","source":"tycoon","lastStatusChangeAt":"2021-08-27T21:42:33.499Z","createdAt":"2021-08-27T21:42:33.499Z","updatedAt":"2021-08-27T22:23:15.730Z","contact":{"id":"LsdZngqYJv7EU8IWovvt","name":"BERNARDO M. SCHIFANO","companyName":"Schifano Transport","email":"bernardo.schifano@verizon.net","phone":"+17167830317","tags":["callsconsultrequested","calvin"]}},{"id":"cLVKX6JGA3WuDyV1fWiR","name":"Raymondos housekeeping service","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"qG1sB0UFExqSeBkLH2O1","status":"lost","source":"","lastStatusChangeAt":"2021-08-31T19:42:54.020Z","createdAt":"2021-08-27T17:46:22.252Z","updatedAt":"2021-08-31T19:42:54.020Z","contact":{"id":"y8mof6A0DDoIs8XaNYb0","name":"Renee Wooten","companyName":"Raymondos housekeeping service","email":"miss.wooten03@gmail.com","phone":"+12097351968","tags":["philsimport"]}},{"id":"BixkPIts02VKY16Rm6tW","name":"Perkins Florist","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"l1h81pUTW2pM5NJr4bNU","status":"open","lastStatusChangeAt":"2021-08-27T17:46:21.651Z","createdAt":"2021-08-27T17:46:21.651Z","updatedAt":"2021-08-27T17:46:22.121Z","contact":{"id":"cgls7HOcnnQTryg9mvZX","name":"Maggie Newsome","companyName":"Perkins Florist","email":"newsome.maggie@yahoo.con","phone":"+16629315816","tags":["philsimport"]}},{"id":"ycWkDyCJqX6Uw7jRqBhd","name":"Good Hands adult home care llc","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","lastStatusChangeAt":"2021-08-27T17:46:21.609Z","createdAt":"2021-08-27T17:46:21.609Z","updatedAt":"2021-08-27T17:46:22.200Z","contact":{"id":"tSGGBMd6v5BdHKNee0sb","name":"Ramona Rau","companyName":"Good Hands adult home care llc","email":"ramycoste@yahoo.com","phone":"+14802522704","tags":["philsimport"]}},{"id":"swJFwddf9Xmzfntf5yPc","name":"Traedell clean house","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"KTp4Pmymgd92oFO6pxNc","status":"open","lastStatusChangeAt":"2021-08-27T17:46:21.601Z","createdAt":"2021-08-27T17:46:21.601Z","updatedAt":"2021-08-27T17:46:22.111Z","contact":{"id":"e1kjcYhP6w1ix0kUZIUK","name":"Traedell Lewis","companyName":"Traedell clean house","email":"traedelllewis@icloud.com","phone":"+14143466750","tags":["philsimport","noanswer"]}},{"id":"JOxbZHlmm4pxdyibGE33","name":"Fines JANITORol","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"qG1sB0UFExqSeBkLH2O1","status":"abandoned","lastStatusChangeAt":"2021-08-30T19:45:20.561Z","createdAt":"2021-08-27T17:46:21.556Z","updatedAt":"2021-08-30T19:45:20.561Z","contact":{"id":"AplZfKsNUugI2QlNpAUf","name":"Jennifer Fine","companyName":"Fines JANITORol","email":"jennifermattfine@gmail.com","phone":"+18702061060","tags":["philsimport"]}},{"id":"xNxh8ArnduZHnpmEcH4U","name":"Martin Art","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","lastStatusChangeAt":"2021-08-27T17:46:21.520Z","createdAt":"2021-08-27T17:46:21.520Z","updatedAt":"2021-08-27T17:46:22.411Z","contact":{"id":"ZS2dQwFooE1TISbaeWLF","name":"Lamon Martin","companyName":"Martin Art","email":"bernoise73martin@gmail.com","phone":"+18505859525","tags":["philsimport"]}},{"id":"VnQhoeSg1wKCW244wdsx","name":"Uspkh","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"l1h81pUTW2pM5NJr4bNU","status":"open","lastStatusChangeAt":"2021-08-27T17:46:15.680Z","createdAt":"2021-08-27T17:46:15.680Z","updatedAt":"2021-08-27T17:46:16.086Z","contact":{"id":"D282c2m5nhsIYrjGD7lx","name":"James Brown","companyName":"Uspkh","email":"ironmandojo17@gmail.com","phone":"+13159359766","tags":["philsimport"]}},{"id":"AF3ktgXB7ilv7PhYZFDV","name":"Oh so silky hair","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"KTp4Pmymgd92oFO6pxNc","status":"open","lastStatusChangeAt":"2021-08-27T17:46:15.556Z","createdAt":"2021-08-27T17:46:15.556Z","updatedAt":"2021-08-27T17:46:16.031Z","contact":{"id":"nO9IqZmgOJDUpTCwYaIV","name":"Zoe Calkins","companyName":"Oh so silky hair","email":"zgc215@gmail.com","phone":"+16147024548","tags":["philsimport","noanswer"]}},{"id":"r88DwTil05ZeyGlsEGQg","name":"Big Sexy Beauty Bar","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"qG1sB0UFExqSeBkLH2O1","status":"open","lastStatusChangeAt":"2021-08-27T17:46:15.424Z","createdAt":"2021-08-27T17:46:15.424Z","updatedAt":"2021-08-27T17:46:15.873Z","contact":{"id":"a4wP6oPC39y4aV1XirhA","name":"LaShaunda Wilson","companyName":"Big Sexy Beauty Bar","email":"lashaundawilson4@gmail.com","phone":"+14147668568","tags":["philsimport"]}},{"id":"X1sjI09jIG0Q3vDymyrX","name":"UNDERRATED DENIM","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"MF9qzJNAZTRP4me3bSP1","status":"open","lastStatusChangeAt":"2021-08-27T17:46:14.553Z","createdAt":"2021-08-27T17:46:14.553Z","updatedAt":"2021-08-27T17:46:15.031Z","contact":{"id":"x5i0UkeGbsEQg26eDt6N","name":"Shatee TABORN","companyName":"UNDERRATED DENIM","email":"lchoppoe@gmail.com","phone":"+13475968822","tags":["philsimport"]}},{"id":"3ufBSUmrtXBDpPS1cgU5","name":"Jennifer Zermeno","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"l1h81pUTW2pM5NJr4bNU","status":"open","lastStatusChangeAt":"2021-08-27T17:46:14.283Z","createdAt":"2021-08-27T17:46:14.283Z","updatedAt":"2021-08-27T17:46:14.769Z","contact":{"id":"LUwl6ZqA4Gk6egaiAMEt","name":"Jennifer Zermeno","companyName":"Jennifer Zermeno","email":"motivation6491@gmail.com","phone":"+18053327650","tags":["philsimport"]}},{"id":"CoyreXJ5QmCmyg1kAsRg","name":"Gorilla Empire APPAREL","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"KTp4Pmymgd92oFO6pxNc","status":"open","lastStatusChangeAt":"2021-08-27T17:46:12.529Z","createdAt":"2021-08-27T17:46:12.529Z","updatedAt":"2021-08-27T17:46:13.024Z","contact":{"id":"ONZfe0bJQJg1iVI0orX0","name":"Michael Whitfield","companyName":"Gorilla Empire APPAREL","email":"michealwhit561@gmail.com","phone":"+18329944839","tags":["philsimport"]}},{"id":"sKcYfkdrLAYFDzWiUiSq","name":"4BLockinc.","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","pipelineStageUId":"ea9bb1f4-4e44-426a-aa38-5ee57db53ecb","assignedTo":"qG1sB0UFExqSeBkLH2O1","status":"open","lastStatusChangeAt":"2021-08-27T17:46:10.256Z","createdAt":"2021-08-27T17:46:10.256Z","updatedAt":"2021-08-27T17:46:36.568Z","contact":{"id":"oJUgrgy7E9AlRhc0M98Z","name":"Travoy Davis Johnson","companyName":"4Block Inc","email":"travoy2023@gmail.com","phone":"+17735120776","tags":["philsimport"]}}],"meta":{"total":7668,"nextPageUrl":"http://rest.gohighlevel.com/v1/pipelines/5pW6z3hDtWuBxm245sPI/opportunities/?startAfterId=sKcYfkdrLAYFDzWiUiSq&startAfter=1630086370256","startAfterId":"sKcYfkdrLAYFDzWiUiSq","startAfter":1630086370256,"currentPage":1,"nextPage":2,"prevPage":null}}'
        ));
        $result = $this->test->search('pipeline');
        self::assertInstanceOf(Opportunities::class, $result);
        self::assertIsArray($result->opportunities);
        self::assertNotEmpty($result->opportunities);
        self::assertInstanceOf(OpportunityObject::class, $result->opportunities[0]);
        self::assertInstanceOf(Meta::class, $result->meta);
    }

    public function testUpdateStatus()
    {
        $this->expectNotToPerformAssertions();
        $this->stack->append(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"id":"Digex7T4y7UWg6jSOjvS","name":"First Opp","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","status":"open","createdAt":"2021-09-07T16:52:39.141Z","updatedAt":"2021-09-07T16:52:39.141Z","contact":{"id":"wvQ3j1kyebggSGaThlcK","name":"TIM WILSON","companyName":"ASAPFUNDR","email":"wilson@gmail.com","phone":"+16235552727","tags":["asap fundr","biz checking 20k+"]}}'
            ),
            new Response(200, ['Content-Type' => 'application/json'], '{}')
        );
        $opportunity = $this->test->get('5pW6z3hDtWuBxm245sPI', 'Digex7T4y7UWg6jSOjvS');
        $opportunity->status = 'won';
        $this->test->updateStatus($opportunity);
    }

    public function testUpdate()
    {
        $this->stack->append(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"id":"Digex7T4y7UWg6jSOjvS","name":"First Opp","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","status":"open","createdAt":"2021-09-07T16:52:39.141Z","updatedAt":"2021-09-07T16:52:39.141Z","contact":{"id":"wvQ3j1kyebggSGaThlcK","name":"TIM WILSON","companyName":"ASAPFUNDR","email":"wilson@gmail.com","phone":"+16235552727","tags":["asap fundr","biz checking 20k+"]}}'
            ),
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                '{"id":"Digex7T4y7UWg6jSOjvS","name":"TIM WILSON (ASAPFUNDR)","monetaryValue":2000,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","status":"open","createdAt":"2021-09-07T16:52:39.141Z","updatedAt":"2021-09-07T16:52:39.141Z","contact":{"id":"wvQ3j1kyebggSGaThlcK","name":"TIM WILSON","companyName":"ASAPFUNDR","email":"wilson@gmail.com","phone":"+16235552727","tags":["asap fundr","biz checking 20k+"]}}'
            ),
        );
        $opportunity = $this->test->get('5pW6z3hDtWuBxm245sPI', 'Digex7T4y7UWg6jSOjvS');
        $opportunity->name = sprintf('%s (%s)', $opportunity->contact->name, $opportunity->contact->companyName);
        $opportunity->monetaryValue = 2000;
        $result = $this->test->update($opportunity);
        self::assertInstanceOf(OpportunityObject::class, $result);
        self::assertSame($opportunity->name, $result->name);
    }

    public function testGet()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"Digex7T4y7UWg6jSOjvS","name":"First Opp","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","status":"open","createdAt":"2021-09-07T16:52:39.141Z","updatedAt":"2021-09-07T16:52:39.141Z","contact":{"id":"wvQ3j1kyebggSGaThlcK","name":"TIM WILSON","companyName":"ASAPFUNDR","email":"wilson@gmail.com","phone":"+16235552727","tags":["asap fundr","biz checking 20k+"]}}'
        ));
        $result = $this->test->get('5pW6z3hDtWuBxm245sPI', 'Digex7T4y7UWg6jSOjvS');
        self::assertInstanceOf(OpportunityObject::class, $result);
        self::assertInstanceOf(Contact::class, $result->contact);
    }

    public function testCreate()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id":"Digex7T4y7UWg6jSOjvS","name":"First Opp","monetaryValue":0,"pipelineId":"5pW6z3hDtWuBxm245sPI","pipelineStageId":"c6245d9b-4b4e-4236-ac41-b0cc55e63f97","status":"open","createdAt":"2021-09-07T16:52:39.141Z","updatedAt":"2021-09-07T16:52:39.141Z","contact":{"id":"wvQ3j1kyebggSGaThlcK","name":"TIM WILSON","companyName":"ASAPFUNDR","email":"wilson@gmail.com","phone":"+16235552727","tags":["asap fundr","biz checking 20k+"]}}'
        ));
        $result = $this->test->create('5pW6z3hDtWuBxm245sPI', [
            'title' => 'First Opp',
            'stageId' => 'c6245d9b-4b4e-4236-ac41-b0cc55e63f97',
            'status' => 'open',
            'contactId' => 'wvQ3j1kyebggSGaThlcK',
        ]);
        self::assertInstanceOf(OpportunityObject::class, $result);
        self::assertInstanceOf(Contact::class, $result->contact);
    }
}
