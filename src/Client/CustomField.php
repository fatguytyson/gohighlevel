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

use FGC\GoHighLevel\Object\CustomField\CustomField as CustomFieldObject;
use FGC\GoHighLevel\Object\CustomField\CustomFields;
use FGC\GoHighLevel\Object\CustomField\Wrapper;
use FGC\GoHighLevel\OptionResolver\CustomField\Create;
use FGC\GoHighLevel\Root;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class CustomField extends Root
{
    protected const ROOT_URI = '/v1/custom-fields/';
    public function get(): CustomFields
    {
        return $this->send(
            'get',
            self::ROOT_URI,
            [],
            CustomFields::class
        );
    }

    /**
     * @see Create
     */
    public function create(array $options = []): CustomFieldObject
    {
        return $this->send(
            'post',
            self::ROOT_URI,
            [RequestOptions::JSON => Create::resolve($options)],
            CustomFieldObject::class
        );
    }

    public function fetch(string $id): CustomFieldObject
    {
        $wrapper = $this->send(
            'get',
            sprintf('%s%s', self::ROOT_URI, $id),
            [],
            Wrapper::class
        );

        return $wrapper->customField;
    }

    public function update(CustomFieldObject $customField): CustomFieldObject
    {
        $options = $this->serializer->normalize(
            $customField,
            'json',
            [
                AbstractNormalizer::ATTRIBUTES => array_merge(
                    Create::getDefined(),
                    ['picklistOptions']
                ),
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            ]
        );
        if (isset($options['picklistOptions'])) {
            $options['options'] = $options['picklistOptions'];
            unset($options['picklistOptions']);
        }
        $wrapper = $this->send(
            'put',
            sprintf('%s%s', self::ROOT_URI, $customField->id),
            [RequestOptions::JSON => Create::resolve($options)],
            Wrapper::class
        );

        return $wrapper->customField;
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