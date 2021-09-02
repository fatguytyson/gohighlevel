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

namespace FGC\GoHighLevel;

use FGC\GoHighLevel\Client\Contact;
use FGC\GoHighLevel\Exception\RestException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class Client
{
    /** @var string */
    protected string $apiKey;
    /** @var ClientInterface */
    protected $client;
    /** @var SerializerInterface */
    protected $serializer;

    public function __construct(string $apiKey, ClientInterface $client = null, SerializerInterface $serializer = null)
    {
        $this->apiKey = $apiKey;
        $this->client = $client ?? new GuzzleClient([
            'base_uri' => 'https://rest.gohighlevel.com',
            RequestOptions::HEADERS => [
                'Authorization' => sprintf('Bearer %s', $apiKey),
            ],
        ]);
        $this->serializer = $serializer ?? new Serializer([
                new DateTimeNormalizer(),
                new ObjectNormalizer(null, null, null, new PhpDocExtractor()),
                new ArrayDenormalizer(),
            ], [
                new JsonEncoder(),
            ]);
    }

    public function Contact(): Contact
    {
        return new Contact($this->apiKey, $this->client, $this->serializer);
    }

    /**
     * @throws ExceptionInterface
     * @throws RestException
     * @template ReturnClass of object
     * @psalm-param class-string<ReturnClass> $returnClass
     * @psalm-return ReturnClass
     */
    protected function send(string $method, string $url, array $options, ?string $returnClass)
    {
        if (isset($options['json']) && is_object($options['json'])) {
            $options['json'] = $this->serializer->normalize($options['json'], 'json');
        }
        if (isset($options['query']) && is_object($options['query'])) {
            $options['query'] = $this->serializer->normalize($options['query'], 'json');
        }
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleException $e) {
            throw new RestException($e);
        }
        if (null === $returnClass) {
            return null;
        }

        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $returnClass,
            'json'
        );
    }
}