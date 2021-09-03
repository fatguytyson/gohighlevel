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

namespace FGC\GoHighLevel\Client;

use FGC\GoHighLevel\Object\Contact\Contact as ContactObject;
use FGC\GoHighLevel\Object\Contact\Contacts;
use FGC\GoHighLevel\Object\Contact\Wrapper;
use FGC\GoHighLevel\OptionResolver\Contact\Create;
use FGC\GoHighLevel\OptionResolver\Contact\Get;
use FGC\GoHighLevel\OptionResolver\Contact\Lookup;
use FGC\GoHighLevel\Root;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class Contact extends Root
{
    protected const ROOT_URI = '/v1/contacts/';
    /**
     * @see Get
     */
    public function get(array $options = []): Contacts
    {
        return $this->send(
            'get',
            self::ROOT_URI,
            [RequestOptions::QUERY => Get::resolve($options)],
            Contacts::class
        );
    }

    /**
     * @see Create
     */
    public function create(array $options = []): ContactObject
    {
        $wrapper = $this->send(
            'post',
            self::ROOT_URI,
            [RequestOptions::JSON => Create::resolve($options)],
            Wrapper::class
        );

        return $wrapper->contact;
    }

    /**
     * @see Lookup
     */
    public function lookup(array $options = []): Contacts
    {
        return $this->send(
            'get',
            sprintf('%slookup', self::ROOT_URI),
            [RequestOptions::QUERY => Lookup::resolve($options)],
            Contacts::class
        );
    }

    public function fetch(string $id): ContactObject
    {
        $wrapper = $this->send(
            'get',
            sprintf('%s%s', self::ROOT_URI, $id),
            [],
            Wrapper::class
        );

        return $wrapper->contact;
    }

    public function update(ContactObject $contact): ContactObject
    {
        $options = $this->serializer->normalize(
            $contact,
            'json',
            [
                AbstractNormalizer::ATTRIBUTES => Create::getDefined(),
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            ]
        );
        if (isset($options['customField'])) {
            $customField = [];
            foreach ($options['customField'] as ['id' => $id, 'value' => $value]) {
                $customField[$id] = $value;
            }
            $options['customField'] = $customField;
        }
        $wrapper = $this->send(
            'put',
            sprintf('%s%s', self::ROOT_URI, $contact->id),
            [RequestOptions::JSON => Create::resolve($options)],
            Wrapper::class
        );

        return $wrapper->contact;
    }

    public function delete(string $id): void
    {
        $this->send(
            'delete',
            sprintf('%s%s', self::ROOT_URI, $id),
            [],
            null
        );
    }
}