<?php

namespace HrPhpTest\Meetup\Adapter;

use HrPhp\Meetup\Adapter\DMSClientAdapter;
use HrPhpTest\Fixtures\MeetupApiResponseFixture;

class DMSClientAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**@var \DMS\Service\Meetup\MeetupKeyAuthClient */
    private $dmsClient;

    /**@var \HrPhpTest\Fixtures\MeetupApiResponseFixture */
    private $meetupApiResponse;

    public function testGetEvents()
    {
        $response = $this->meetupApiResponse;
        $this->dmsClient->expects($this->once())
            ->method('__call')
            ->with($this->anything())
            ->will($this->returnValue($response));
        $adapter = new DMSClientAdapter($this->dmsClient);
        $events = $adapter->getEvents(['foo' => 'bar']);
        $this->assertEquals('NYC Technologists', $events->results[0]->group->who);
    }

    public function testGetEventsThrowsException()
    {
        $response = 'This is not json';
        $this->dmsClient->expects($this->once())
            ->method('__call')
            ->with($this->anything())
            ->will($this->returnValue($response));
        $adapter = new DMSClientAdapter($this->dmsClient);
        $this->setExpectedException('HrPhp\Exception\HrPhpException');
        $adapter->getEvents(['test']);
    }

    protected function setUp()
    {
        $this->dmsClient = $this->getMockBuilder('\DMS\Service\Meetup\MeetupKeyAuthClient')
            ->disableOriginalConstructor()
            ->getMock(array('__call'));
        $this->meetupApiResponse = new MeetupApiResponseFixture();
    }
}
