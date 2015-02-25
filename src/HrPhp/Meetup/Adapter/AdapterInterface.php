<?php

namespace HrPhp\Meetup\Adapter;

interface AdapterInterface
{
    /**
     * @return array
     * @throws \HrPhp\Exception\Exception
     */
    public function getEvents();

    /**
     * @return mixed
     */
    public function getClient();
}
