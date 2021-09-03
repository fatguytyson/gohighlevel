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

namespace FGC\GoHighLevel\Object\Contact;

use DateTimeImmutable;

class Contact {
    /** @var string **/
    public string $id;
    /** @var string **/
    public string $locationId;
    /** @var string|null **/
    public ?string $contactName;
    /** @var string|null **/
    public ?string $firstName;
    /** @var string|null **/
    public ?string $firstNameLowerCase;
    /** @var string|null **/
    public ?string $lastName;
    /** @var string|null **/
    public ?string $lastNameLowerCase;
    /** @var string|null **/
    public ?string $fullNameLowerCase;
    /** @var string|null **/
    public ?string $assignedTo;
    /** @var boolean **/
    public bool $dnd;
    /** @var string|null **/
    public ?string $type;
    /** @var string|null **/
    public ?string $source;
    /** @var string[] **/
    public array $tags;
    /** @var DateTimeImmutable **/
    public DateTimeImmutable $dateAdded;
    /** @var DateTimeImmutable **/
    public DateTimeImmutable $dateUpdated;
    /** @var string|null **/
    public ?string $city;
    /** @var string|null */
    public ?string $address1;
    /** @var string|null **/
    public ?string $dateOfBirth;
    /** @var string|null **/
    public ?string $state;
    /** @var string|null **/
    public ?string $email;
    /** @var string|null **/
    public ?string $emailLowerCase;
    /** @var string|null **/
    public ?string $phone;
    /** @var string|null **/
    public ?string $companyName;
    /** @var string|null **/
    public ?string $postalCode;
    /** @var int **/
    public int $lastActivity;
    /** @var CustomFieldValue[] **/
    public array $customField;
}
