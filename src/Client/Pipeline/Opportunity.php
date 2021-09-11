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

namespace FGC\GoHighLevel\Client\Pipeline;

use FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunities;
use FGC\GoHighLevel\Object\Pipeline\Opportunity\Opportunity as OpportunityObject;
use FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity\Create;
use FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity\Search;
use FGC\GoHighLevel\OptionResolver\Pipeline\Opportunity\UpdateStatus;
use FGC\GoHighLevel\Root;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class Opportunity extends Root
{
    protected const ROOT_URI = '/v1/pipelines/:pipelineId/opportunities/';
    /**
     * @see Search
     */
    public function search(string $pipelineId, array $options = [])
    {
        return $this->send(
            'get',
            $this->getRootUri($pipelineId),
            [RequestOptions::QUERY => Search::resolve($options)],
            Opportunities::class
        );
    }

    public function get(string $pipelineId, string $opportunityId): OpportunityObject
    {
        return $this->send(
            'get',
            sprintf('%s%s', $this->getRootUri($pipelineId), $opportunityId),
            [],
            OpportunityObject::class
        );
    }

    public function update(OpportunityObject $opportunity): OpportunityObject
    {
        $options = $this->serializer->normalize(
            $opportunity,
            'json',
            [
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
                AbstractNormalizer::ATTRIBUTES => [
                    'name',
                    'pipelineStageId',
                    'status',
                    'monetaryValue',
                    'assignedTo',
                    'contact',
                ],
            ]
        );
        $options['title'] = $options['name'];
        unset($options['name']);
        $options['stageId'] = $options['pipelineStageId'];
        unset($options['pipelineStageId']);
        $options['contactId'] = $options['contact']['id'];
        unset($options['contact']['id']);
        $options = array_merge($options, $options['contact']);
        unset($options['contact']);

        return $this->send(
            'put',
            sprintf('%s%s', $this->getRootUri($opportunity->pipelineId), $opportunity->id),
            [RequestOptions::JSON => Create::resolve($options)],
            OpportunityObject::class
        );
    }

    public function delete(string $pipelineId, string $opportunityId): void
    {
        $this->send(
            'delete',
            sprintf('%s%s', $this->getRootUri($pipelineId), $opportunityId),
            [],
            null
        );
    }

    /**
     * @see Create
     */
    public function create(string $pipelineId, array $options = []): OpportunityObject
    {
        return $this->send(
            'post',
            $this->getRootUri($pipelineId),
            [RequestOptions::JSON => Create::resolve($options)],
            OpportunityObject::class
        );
    }

    public function updateStatus(OpportunityObject $opportunity): void
    {
        $options = $this->serializer->normalize(
            $opportunity,
            'json',
            [
                AbstractNormalizer::ATTRIBUTES => ['pipelineStageId', 'status'],
            ]
        );
        $options['stageId'] = $options['pipelineStageId'];
        unset($options['pipelineStageId']);
        $this->send(
            'put',
            sprintf('%s%s', $this->getRootUri($opportunity->pipelineId), $opportunity->id),
            [RequestOptions::JSON => UpdateStatus::resolve($options)],
            null
        );
    }

    private function getRootUri(string $pipelineId): string
    {
        return str_replace(':pipelineId', $pipelineId, self::ROOT_URI);
    }
}