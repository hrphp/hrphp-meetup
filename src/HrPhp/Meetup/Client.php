<?php
 
namespace HrPhp\Meetup;

use HrPhp\Meetup\Adapter\AdapterInterface;

class Client
{
    /**@var \HrPhp\Meetup\Adapter\AdapterInterface */
    private $adapter;

    /**
     * @param array $options
     * @return array
     */
    public function getEvents(array $options)
    {
        return $this->getAdapter()->getEvents($options);
    }

    /**
     * @param \HrPhp\Meetup\Adapter\AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return \HrPhp\Meetup\Adapter\AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
