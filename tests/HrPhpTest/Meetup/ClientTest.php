<?php

namespace HrPhpTest\Meetup;

use HrPhp\Meetup\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**@var \HrPhp\Meetup\Client */
    private $client;

    public function testGetSetAdapter()
    {
        $className = '\HrPhp\Meetup\Adapter\AdapterInterface';
        $adapter = $this->getMockForAbstractClass($className);
        $this->client->setAdapter($adapter);
        $this->assertInstanceOf($className, $this->client->getAdapter());
    }

    public function testGetEvents()
    {
        $expectedValue = ['foo' => 'bar'];
        $className = '\HrPhp\Meetup\Adapter\AdapterInterface';
        $adapter = $this->getMockForAbstractClass($className);
        $adapter->expects($this->once())
            ->method('getEvents')
            ->with(['test'])
            ->will($this->returnValue($expectedValue));
        $this->client->setAdapter($adapter);
        $this->assertSame($expectedValue, $this->client->getEvents(['test']));
    }

    protected function setUp()
    {
        $this->client = new Client();
    }
}
