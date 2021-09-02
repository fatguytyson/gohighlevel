<?php

namespace FGC\GoHighLevel\Client;

use FGC\GoHighLevel\Client;
use FGC\GoHighLevel\Object\Contact\Contact as ContactObject;
use FGC\GoHighLevel\Object\Contact\Contacts;
use FGC\GoHighLevel\Object\Contact\Wrapper;
use FGC\GoHighLevel\OptionResolver\Contact\Create;
use FGC\GoHighLevel\OptionResolver\Contact\Get;
use FGC\GoHighLevel\OptionResolver\Contact\Lookup;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class Contact extends Client
{
    /**
     * @see Get
     */
    public function get(array $options = []): Contacts
    {
        return $this->send(
            'get',
            '/v1/contacts/',
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
            '/v1/contacts/',
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
            '/v1/contacts/lookup',
            [RequestOptions::QUERY => Lookup::resolve($options)],
            Contacts::class
        );
    }

    public function fetch(string $id): ContactObject
    {
        $wrapper = $this->send(
            'get',
            sprintf('/v1/contacts/%s', $id),
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
            sprintf('/v1/contacts/%s', $contact->id),
            [RequestOptions::JSON => Create::resolve($options)],
            Wrapper::class
        );

        return $wrapper->contact;
    }

    public function delete(string $id): void
    {
        $this->send(
            'delete',
            sprintf('/v1/contacts/%s', $id),
            [],
            null
        );
    }
}