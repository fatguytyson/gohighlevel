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

use FGC\GoHighLevel\Client\Contact;
use FGC\GoHighLevel\Object\Contact\Contact as ContactObject;
use FGC\GoHighLevel\Object\Contact\Contacts;
use FGC\GoHighLevel\Object\Meta;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \FGC\GoHighLevel\Client\Contact
 */
class ContactTest extends TestCase
{
    private Contact $test;
    private MockHandler $stack;

    protected function setUp(): void
    {
        $this->stack = new MockHandler();
        $this->test = new Contact('fake_api_key', new Client(['handler' => HandlerStack::create($this->stack)]));
    }

    public function testGet()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contacts":[{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":null,"phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]},{"id":"sN5yF07FLQmlCstz8X8Y","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(915) 555-1366","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+19155551366","dnd":false,"type":"lead","source":null,"assignedTo":null,"city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T23:55:25.968Z","dateUpdated":"2021-08-31T23:55:25.968Z","dateOfBirth":null,"tags":[],"lastActivity":1630454126036,"customField":[]},{"id":"FqfQmHqtJor7wCpO6RS4","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(773) 555-4266","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+17735554266","dnd":false,"type":"lead","source":null,"assignedTo":null,"city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T23:43:49.788Z","dateUpdated":"2021-08-31T23:43:49.788Z","dateOfBirth":null,"tags":[],"lastActivity":1630453429880,"customField":[]},{"id":"6uOmMVAj08Xk6DNejwS3","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"derek gidson","firstName":"derek","lastName":"gidson","companyName":"GIDSON HAULING LLC","email":"derekgidson@gmail.com","phone":"+13015555309","dnd":false,"type":"lead","source":"calvin","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T22:33:21.843Z","dateUpdated":"2021-08-31T22:42:53.208Z","dateOfBirth":null,"tags":["consultsrequested"],"lastActivity":1630449635867,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"SsNykfORFaWf4tOceAi5","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"shola a souza","firstName":"shola","lastName":"a souza","companyName":"BLACK STAR ENTERPRISES INC","email":"epson@yahoo.com","phone":"+14045550407","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T21:58:34.246Z","dateUpdated":"2021-08-31T22:11:02.884Z","dateOfBirth":null,"tags":["consultsrequested"],"lastActivity":1630447754843,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"UcOrOVDxUreNg8DWKKbK","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"snirpem llc-soluce charles","firstName":"snirpem","lastName":"llc-soluce charles","companyName":"SNIRPEM LLC","email":"soluce@gmail.com","phone":"+16785556892","dnd":false,"type":"lead","source":"tycoon.","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Atlanta","state":"Georgia","postalCode":null,"address1":null,"dateAdded":"2021-08-31T14:47:10.955Z","dateUpdated":"2021-08-31T19:57:13.097Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630439992028,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"oWoDUCRcEYmCITcNRtSD","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"cass transport llc-cassandra fike","firstName":"cass","lastName":"transport llc-cassandra fike","companyName":"CASS TRANSPORT LLC","email":"cass@gmail.com","phone":"+12605550991","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T13:24:36.540Z","dateUpdated":"2021-08-31T14:22:29.135Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630443918408,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"rjfYyw8hCdxOVZpvt9gS","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(720) 555-0500","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+17205550500","dnd":true,"type":"lead","source":null,"assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":"CO","postalCode":null,"address1":null,"dateAdded":"2021-08-30T21:14:56.003Z","dateUpdated":"2021-08-31T23:41:38.215Z","dateOfBirth":null,"tags":[],"lastActivity":1630358096092,"customField":[]},{"id":"Tx3LPSV9ILzptdZ5SDr3","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"durray soles","firstName":"durray","lastName":"soles","phone":"+16095556333","assignedTo":"MF9qzJNAZTRP4me3bSP1","dnd":false,"type":"lead","source":"timo-referral","tags":["callsconsultrequested","calvin"],"dateAdded":"2021-08-30T20:52:26.371Z","dateUpdated":"2021-08-31T14:25:47.890Z","lastActivity":1630450337705,"city":"Las Vegas","address1":null,"dateOfBirth":null,"state":"NV","email":"duray@yahoo.com","companyName":"Reliant Global Transportation","postalCode":"12345","customField":[]},{"id":"8ClqTqOFHZd9zjWoqkjc","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robert l hambright","firstName":"robert","lastName":"l hambright","companyName":"HAMM TRANSPORT LLC","email":"hambright@yahoo.com","phone":"+17345558079","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"tuscaloosa","state":"Alabama","postalCode":"12345","address1":"450 OLD WAY RD","dateAdded":"2021-08-30T20:31:07.918Z","dateUpdated":"2021-08-30T20:42:29.067Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630451241280,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"f8vEOLYcecbq3GVuXQwj","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"-gdp logistics llc-gerald patterson","firstName":"-gdp","lastName":"logistics llc-gerald patterson","companyName":"GDP Logistics Llc","email":"gerald@gmail.com","phone":"+17065552525","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Covington","state":null,"postalCode":"12345","address1":"12345 Black Dog Lane","dateAdded":"2021-08-30T18:54:48.675Z","dateUpdated":"2021-08-30T22:19:54.797Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630452218585,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"vxPhc5Bg0emd8Rmgh5cg","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"berace bennett","firstName":"berace","lastName":"bennett","companyName":"B&P & Sons Flooring, LLC","email":"bennett@ymail.com","phone":"+15735552713","dnd":false,"type":"lead","source":"calvin","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Florissant","state":"Missouri","postalCode":"12345","address1":"1234 Pacific Park Ave","dateAdded":"2021-08-30T18:09:23.478Z","dateUpdated":"2021-08-30T18:21:42.464Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630453816736,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"a87jGfCAK7b4I6mecbK1","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"gregory stamps","firstName":"gregory","lastName":"stamps","companyName":"Holy Ghost Transport Llc","email":"holyghost@gmail.com","phone":"+14055555975","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":"OK","postalCode":"12345","address1":"123 CZECH MATE PL","dateAdded":"2021-08-27T21:55:00.435Z","dateUpdated":"2021-08-30T20:12:12.347Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630438587767,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"LsdZngqYJv7EU8IWovvt","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"bernardo m. schifano","firstName":"bernardo","lastName":"m. schifano","companyName":"Schifano Transport","email":"schifano@gmail.com","phone":"+17165550317","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-27T21:42:32.732Z","dateUpdated":"2021-08-27T22:23:14.909Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630451611928,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"Dl9uXVSWzsayU3T3sr9R","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"willius serchion","firstName":"willius","lastName":"serchion","companyName":"Hollywood boutique,LLC","email":"boutique@gmail.com","phone":"+14045557078","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-31T19:24:43.294Z","lastActivity":1630437968086,"city":null,"address1":null,"dateOfBirth":null,"source":null,"state":"GA","assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$50,000 - $100,000 per month"}]},{"id":"IGh8QIUcrMeCwTWVtqgZ","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"tonisha monford","firstName":"tonisha","lastName":"monford","companyName":"BlazingTreAndJ\'s","email":"blazingtrails@gmail.com","phone":"+17065551242","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:45.011Z","lastActivity":1630438184479,"city":null,"address1":null,"dateOfBirth":null,"source":null,"state":null,"assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"M8E66HNuMzs2bYbWUhb6","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"charismia anderson","firstName":"charismia","lastName":"anderson","companyName":"Boujie Brat","email":"boujie@gmail.com","phone":"+13525551832","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-31T19:33:22.987Z","city":null,"address1":null,"dateOfBirth":null,"source":null,"state":"FL","assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"lastActivity":1630438783823,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$50,000 - $100,000 per month"}]},{"id":"iQ1dLucSyNKJoMDFvZLC","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"special perry","firstName":"special","lastName":"perry","companyName":"BLesseD by me lashes","email":"blessed@gmail.com","phone":"+17045559660","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:44.092Z","lastActivity":1630086345697,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"laLaXozEY7tDVDz4pFFk","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"julia ben","firstName":"julia","lastName":"ben","companyName":"Lola\'s Spa","email":"lolas@gmail.com","phone":"+16015559431","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:44.092Z","lastActivity":1630086345935,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"q8WU04mwwOuCbvjcGlGE","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"cassandra dargin","firstName":"cassandra","lastName":"dargin","companyName":"Best Janitorial","email":"best@gmail.com","phone":"+12255556906","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:45.016Z","city":null,"address1":null,"dateOfBirth":null,"source":null,"state":null,"assignedTo":"l1h81pUTW2pM5NJr4bNU","postalCode":null,"lastActivity":5901630101098180,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]}],"meta":{"total":21,"nextPageUrl":"http://rest.gohighlevel.com/v1/contacts/?limit=20&startAfter=1630086344092&startAfterId=q8WU04mwwOuCbvjcGlGE","startAfterId":"q8WU04mwwOuCbvjcGlGE","startAfter":1630086344092,"currentPage":1,"nextPage":2,"prevPage":null}}'
        ));
        $result = $this->test->get();
        self::assertInstanceOf(Contacts::class, $result);
        self::assertIsArray($result->contacts);
        self::assertCount(20, $result->contacts);
        self::assertInstanceOf(ContactObject::class, $result->contacts[0]);
        self::assertInstanceOf(Meta::class, $result->meta);
    }

    public function testCreate()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contact":{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":null,"phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]}}'
        ));
        $result = $this->test->create([
            'firstName' => 'robuam',
            'lastName' => 'bocancea',
            'dnd' => false,
            'source' => 'ring central',
            'tags' => ['alvin', 'consultsrequested'],
            'phone' => '+13128040999',
        ]);
        self::assertInstanceOf(ContactObject::class, $result);
        self::assertSame('Smya1Z92jOPtwIFqfqIi', $result->id);
    }

    public function testLookup()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contacts":[{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":null,"phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]},{"id":"sN5yF07FLQmlCstz8X8Y","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(915) 555-1366","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+19155551366","dnd":false,"type":"lead","source":null,"assignedTo":null,"city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T23:55:25.968Z","dateUpdated":"2021-08-31T23:55:25.968Z","dateOfBirth":null,"tags":[],"lastActivity":1630454126036,"customField":[]},{"id":"FqfQmHqtJor7wCpO6RS4","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(773) 555-4266","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+17735554266","dnd":false,"type":"lead","source":null,"assignedTo":null,"city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T23:43:49.788Z","dateUpdated":"2021-08-31T23:43:49.788Z","dateOfBirth":null,"tags":[],"lastActivity":1630453429880,"customField":[]},{"id":"6uOmMVAj08Xk6DNejwS3","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"derek gidson","firstName":"derek","lastName":"gidson","companyName":"GIDSON HAULING LLC","email":"derekgidson@gmail.com","phone":"+13015555309","dnd":false,"type":"lead","source":"calvin","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T22:33:21.843Z","dateUpdated":"2021-08-31T22:42:53.208Z","dateOfBirth":null,"tags":["consultsrequested"],"lastActivity":1630449635867,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"SsNykfORFaWf4tOceAi5","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"shola a souza","firstName":"shola","lastName":"a souza","companyName":"BLACK STAR ENTERPRISES INC","email":"epson@yahoo.com","phone":"+14045550407","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T21:58:34.246Z","dateUpdated":"2021-08-31T22:11:02.884Z","dateOfBirth":null,"tags":["consultsrequested"],"lastActivity":1630447754843,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"UcOrOVDxUreNg8DWKKbK","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"snirpem llc-soluce charles","firstName":"snirpem","lastName":"llc-soluce charles","companyName":"SNIRPEM LLC","email":"soluce@gmail.com","phone":"+16785556892","dnd":false,"type":"lead","source":"tycoon.","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Atlanta","state":"Georgia","postalCode":null,"address1":null,"dateAdded":"2021-08-31T14:47:10.955Z","dateUpdated":"2021-08-31T19:57:13.097Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630439992028,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"oWoDUCRcEYmCITcNRtSD","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"cass transport llc-cassandra fike","firstName":"cass","lastName":"transport llc-cassandra fike","companyName":"CASS TRANSPORT LLC","email":"cass@gmail.com","phone":"+12605550991","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-31T13:24:36.540Z","dateUpdated":"2021-08-31T14:22:29.135Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630443918408,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"rjfYyw8hCdxOVZpvt9gS","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"(720) 555-0500","firstName":null,"lastName":null,"companyName":null,"email":null,"phone":"+17205550500","dnd":true,"type":"lead","source":null,"assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":"CO","postalCode":null,"address1":null,"dateAdded":"2021-08-30T21:14:56.003Z","dateUpdated":"2021-08-31T23:41:38.215Z","dateOfBirth":null,"tags":[],"lastActivity":1630358096092,"customField":[]},{"id":"Tx3LPSV9ILzptdZ5SDr3","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"durray soles","firstName":"durray","lastName":"soles","phone":"+16095556333","assignedTo":"MF9qzJNAZTRP4me3bSP1","dnd":false,"type":"lead","source":"timo-referral","tags":["callsconsultrequested","calvin"],"dateAdded":"2021-08-30T20:52:26.371Z","dateUpdated":"2021-08-31T14:25:47.890Z","lastActivity":1630450337705,"city":"Las Vegas","address1":null,"dateOfBirth":null,"state":"NV","email":"duray@yahoo.com","companyName":"Reliant Global Transportation","postalCode":"12345","customField":[]},{"id":"8ClqTqOFHZd9zjWoqkjc","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robert l hambright","firstName":"robert","lastName":"l hambright","companyName":"HAMM TRANSPORT LLC","email":"hambright@yahoo.com","phone":"+17345558079","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"tuscaloosa","state":"Alabama","postalCode":"12345","address1":"450 OLD WAY RD","dateAdded":"2021-08-30T20:31:07.918Z","dateUpdated":"2021-08-30T20:42:29.067Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630451241280,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"f8vEOLYcecbq3GVuXQwj","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"-gdp logistics llc-gerald patterson","firstName":"-gdp","lastName":"logistics llc-gerald patterson","companyName":"GDP Logistics Llc","email":"gerald@gmail.com","phone":"+17065552525","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Covington","state":null,"postalCode":"12345","address1":"12345 Black Dog Lane","dateAdded":"2021-08-30T18:54:48.675Z","dateUpdated":"2021-08-30T22:19:54.797Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630452218585,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"vxPhc5Bg0emd8Rmgh5cg","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"berace bennett","firstName":"berace","lastName":"bennett","companyName":"B&P & Sons Flooring, LLC","email":"bennett@ymail.com","phone":"+15735552713","dnd":false,"type":"lead","source":"calvin","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":"Florissant","state":"Missouri","postalCode":"12345","address1":"1234 Pacific Park Ave","dateAdded":"2021-08-30T18:09:23.478Z","dateUpdated":"2021-08-30T18:21:42.464Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630453816736,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"a87jGfCAK7b4I6mecbK1","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"gregory stamps","firstName":"gregory","lastName":"stamps","companyName":"Holy Ghost Transport Llc","email":"holyghost@gmail.com","phone":"+14055555975","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":"OK","postalCode":"12345","address1":"123 CZECH MATE PL","dateAdded":"2021-08-27T21:55:00.435Z","dateUpdated":"2021-08-30T20:12:12.347Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630438587767,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"LsdZngqYJv7EU8IWovvt","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"bernardo m. schifano","firstName":"bernardo","lastName":"m. schifano","companyName":"Schifano Transport","email":"schifano@gmail.com","phone":"+17165550317","dnd":false,"type":"lead","source":"tycoon","assignedTo":"MF9qzJNAZTRP4me3bSP1","city":null,"state":null,"postalCode":null,"address1":null,"dateAdded":"2021-08-27T21:42:32.732Z","dateUpdated":"2021-08-27T22:23:14.909Z","dateOfBirth":null,"tags":["callsconsultrequested","calvin"],"lastActivity":1630451611928,"customField":[{"id":"chQVHGrWlrRB7VA251gv","value":"Funding Director"}]},{"id":"Dl9uXVSWzsayU3T3sr9R","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"willius serchion","firstName":"willius","lastName":"serchion","companyName":"Hollywood boutique,LLC","email":"boutique@gmail.com","phone":"+14045557078","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-31T19:24:43.294Z","lastActivity":1630437968086,"city":null,"address1":null,"dateOfBirth":null,"source":null,"state":"GA","assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$50,000 - $100,000 per month"}]},{"id":"IGh8QIUcrMeCwTWVtqgZ","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"tonisha monford","firstName":"tonisha","lastName":"monford","companyName":"BlazingTreAndJ\'s","email":"blazingtrails@gmail.com","phone":"+17065551242","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:45.011Z","lastActivity":1630438184479,"city":null,"address1":null,"dateOfBirth":null,"source":null,"state":null,"assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"M8E66HNuMzs2bYbWUhb6","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"charismia anderson","firstName":"charismia","lastName":"anderson","companyName":"Boujie Brat","email":"boujie@gmail.com","phone":"+13525551832","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-31T19:33:22.987Z","city":null,"address1":null,"dateOfBirth":null,"source":null,"state":"FL","assignedTo":"qG1sB0UFExqSeBkLH2O1","postalCode":null,"lastActivity":1630438783823,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$50,000 - $100,000 per month"}]},{"id":"iQ1dLucSyNKJoMDFvZLC","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"special perry","firstName":"special","lastName":"perry","companyName":"BLesseD by me lashes","email":"blessed@gmail.com","phone":"+17045559660","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:44.092Z","lastActivity":1630086345697,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"laLaXozEY7tDVDz4pFFk","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"julia ben","firstName":"julia","lastName":"ben","companyName":"Lola\'s Spa","email":"lolas@gmail.com","phone":"+16015559431","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:44.092Z","lastActivity":1630086345935,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]},{"id":"q8WU04mwwOuCbvjcGlGE","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"cassandra dargin","firstName":"cassandra","lastName":"dargin","companyName":"Best Janitorial","email":"best@gmail.com","phone":"+12255556906","dnd":false,"type":"lead","tags":["philsimport"],"dateAdded":"2021-08-27T17:45:44.092Z","dateUpdated":"2021-08-27T17:45:45.016Z","city":null,"address1":null,"dateOfBirth":null,"source":null,"state":null,"assignedTo":"l1h81pUTW2pM5NJr4bNU","postalCode":null,"lastActivity":5901630101098180,"customField":[{"id":"ZH0SPfRC01JxMXlyTOgy","value":"$10,000 - $20,000 per month"}]}]}'
        ));
        $result = $this->test->lookup(['phone' => '555']);
        self::assertInstanceOf(Contacts::class, $result);
        self::assertIsArray($result->contacts);
        self::assertCount(20, $result->contacts);
        self::assertInstanceOf(ContactObject::class, $result->contacts[0]);
        self::assertNull($result->meta);
    }

    public function testFetch()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contact":{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":null,"phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]}}'
        ));
        $result = $this->test->fetch('Smya1Z92jOPtwIFqfqIi');
        self::assertInstanceOf(ContactObject::class, $result);
        self::assertSame('Smya1Z92jOPtwIFqfqIi', $result->id);
    }

    public function testUpdate()
    {
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contact":{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":null,"phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]}}'
        ));
        $this->stack->append(new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"contact":{"id":"Smya1Z92jOPtwIFqfqIi","locationId":"IfbKIgadZ0OF7opUv3XZ","contactName":"robuam bocancea","firstName":"robuam","lastName":"bocancea","assignedTo":"KTp4Pmymgd92oFO6pxNc","dnd":false,"type":"lead","source":"ring central","tags":["alvin","consultsrequested"],"dateAdded":"2021-09-01T00:03:49.291Z","dateUpdated":"2021-09-01T00:17:10.474Z","city":null,"address1":null,"dateOfBirth":null,"state":null,"email":"new@email.com","phone":"+11234567890","companyName":null,"postalCode":null,"lastActivity":1630455433995,"customField":[]}}'
        ));
        $contact = $this->test->fetch('Smya1Z92jOPtwIFqfqIi');
        self::assertNull($contact->email);
        $contact->email = 'new@email.com';
        $result = $this->test->update($contact);
        self::assertInstanceOf(ContactObject::class, $result);
        self::assertSame($contact->id, $result->id);
        self::assertSame($contact->email, $result->email);
        self::assertSame($contact->phone, $result->phone);
    }

    public function testDelete()
    {
        $this->expectNotToPerformAssertions();
        $this->stack->append(new Response(200, ['Content-Type' => 'text/plain']));
        $this->test->delete('Smya1Z92jOPtwIFqfqIi');
    }
}
