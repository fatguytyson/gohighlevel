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

namespace FGC\GoHighLevel\Object\Pipeline\Opportunity;

use DateTimeImmutable;

class Opportunity
{
    /** @var string */
    public string $id;
    /** @var string */
    public string $name;
    /** @var float */
    public float $monetaryValue;
    /** @var string */
    public string $pipelineId;
    /** @var string */
    public string $pipelineStageId;
    /** @var string */
    public ?string $pipelineStageUId = null;
    /** @var string */
    public string $assignedTo;
    /** @var string */
    public string $status;
    /** @var string */
    public string $source;
    /** @var DateTimeImmutable */
    public DateTimeImmutable $lastStatusChangeAt;
    /** @var DateTimeImmutable */
    public DateTimeImmutable $createdAt;
    /** @var DateTimeImmutable */
    public DateTimeImmutable $updatedAt;
    /** @var Contact */
    public Contact $contact;
}