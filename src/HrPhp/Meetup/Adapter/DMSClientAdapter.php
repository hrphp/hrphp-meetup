<?php

namespace HrPhp\Meetup\Adapter;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Zend\Json\Json;
use HrPhp\Exception\HrPhpException;

class DMSClientAdapter implements AdapterInterface
{
    /** @var \DMS\Service\Meetup\MeetupKeyAuthClient */
    private $client;

    /**
     * @param \DMS\Service\Meetup\MeetupKeyAuthClient $client
     */
    public function __construct(MeetupKeyAuthClient $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents(array $options)
    {
        try {
            $response = $this->getClient()->getEvents($options);
            if (!method_exists($response, 'getBody')) {
                throw new \ErrorException('Could not connect to the Meetup API.');
            }
            $events = $response->getBody(true);
            return Json::decode($events, Json::TYPE_OBJECT);
        } catch (\Exception $ex) {
            throw new HrPhpException('Could not retrieve meetup events');
        }
    }

    /**
     * @return \DMS\Service\Meetup\MeetupKeyAuthClient
     */
    public function getClient()
    {
        return $this->client;
    }
}
