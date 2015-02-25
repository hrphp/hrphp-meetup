<?php

namespace HrPhp\Meetup;

use HrPhp\Meetup\Adapter\DMSClientAdapter;
use Zend\Mvc\MvcEvent;
use DMS\Service\Meetup\MeetupKeyAuthClient;

class Module
{

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $mvcEvent)
    {
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DMSClient' => function ($sm) {
                    $settings = array(
                        'key' => $sm->get('config')['meetup']['api_key'],
                    );
                    return MeetupKeyAuthClient::factory($settings);
                },
                'DMSClientAdapter' => function ($sm) {
                    $adaptee = $sm->get('DMSClient');
                    return new DMSClientAdapter($adaptee);
                },
                'HrPhpMeetupClient' => function ($sm) {
                    $adapter = $sm->get('DMSClientAdapter');
                    $service = new Client();
                    $service->setAdapter($adapter);
                    return $service;
                }
            )
        );
    }
}
