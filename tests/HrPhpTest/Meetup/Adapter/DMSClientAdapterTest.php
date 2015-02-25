<?php

namespace HrPhpTest\Meetup\Adapter;

use HrPhp\Meetup\Adapter\DMSClientAdapter;
use HrPhpTest\Fixtures\MeetupApiResponseFixture;

class DMSClientAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**@var \DMS\Service\Meetup\MeetupKeyAuthClient */
    private $dmsClient;

    /**@var array */
    private $meetupApiResponse;

    public function testGetEvents()
    {
        $this->dmsClient->expects($this->once())
            ->method('getCommand')
            ->with('GetEvents')
            ->will($this->returnValue($this->meetupApiResponse));
        $adapter = new DMSClientAdapter($this->dmsClient);
        $events = $adapter->getEvents();
        $this->assertEquals('NYC Technologists', $events->results[0]->group->who);
    }

    public function testGetEventsThrowsException()
    {
        $response = 'This is not json';
        $this->dmsClient->expects($this->once())
            ->method('getCommand')
            ->with('GetEvents')
            ->will($this->returnValue($response));
        $adapter = new DMSClientAdapter($this->dmsClient);
        $this->setExpectedException('HrPhp\Exception\HrPhpException');
        $adapter->getEvents();
    }

    protected function setUp()
    {
        $this->dmsClient = $this->getMockBuilder('\DMS\Service\Meetup\MeetupKeyAuthClient')
            ->disableOriginalConstructor()
            ->getMock(array('getCommand'));
        $fixture = new MeetupApiResponseFixture();
        $this->meetupApiResponse = $fixture->getMockUserFeedResponse();
    }
}
