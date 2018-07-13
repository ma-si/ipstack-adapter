<?php

/**
 * Geolocation Ipstack (http://mateuszsitek.com/projects/geolocation-ipstack)
 *
 * @copyright Copyright (c) 2017-2018 DIGITAL WOLVES LTD (http://digitalwolves.ltd) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

return [
    'service_manager' => [
        'factories' => [
            \Aist\Geolocation\Adapter\AdapterInterface::class => \Aist\Ipstack\Adapter\IpstackAdapterFactory::class,
            \Aist\Ipstack\Client\Client::class => \Aist\Ipstack\Client\ClientFactory::class,
            \Aist\Ipstack\Adapter\IpstackAdapter::class => \Aist\Ipstack\Adapter\IpstackAdapterFactory::class,
        ],
    ],
];
