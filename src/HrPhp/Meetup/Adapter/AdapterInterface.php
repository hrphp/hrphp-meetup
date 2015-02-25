<?php

namespace HrPhp\Meetup\Adapter;

interface AdapterInterface
{
    /**
     * @param array $options
     * @return array
     * @throws \HrPhp\Exception\Exception
     */
    public function getEvents(array $options);

    /**
     * @return mixed
     */
    public function getClient();
}
